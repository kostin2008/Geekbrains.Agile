<?php

namespace App\Service\Real;

use App\Events\PlantEvent;
use App\Models\Action;
use App\Models\CalendarPlant;
use App\Models\CalendarPlantRow;
use App\Models\DbModels\DbAction;
use App\Models\DbModels\DbPlant;
use App\Models\DbModels\DbPlantTag;
use App\Models\DbModels\DbPlantUserDone;
use App\Models\DbModels\DbUserPlant;
use App\Models\PlantFull;
use App\Models\PlantShort;
use App\Service\IDbPlantService;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class DbPlantService
 * Сервис по работате с растениями в БД
 */
class DbPlantService implements IDbPlantService
{

    public function getAllPlants(?string $search): array
    {
        echo("<script>console.log('getAllPlants');</script>");

        $dbData = $search === null ?
            DbPlant::with('tags')->orderBy('name')->get():
            DbPlant::with('tags')->where('name', 'like',"%$search%")
                ->orwhere('short_info', 'like',"%$search%")->orderBy('name')->get();
        $data = [];
        foreach ($dbData as $dbItem) {
            $data[] = $this->getPlantFromDbPlant($dbItem);
        }
        return $data;
    }

    public function getPlant(int $id): PlantFull
    {
        echo("<script>console.log('getPlant');</script>");

        $dbItem = DbPlant::with('tags')->where('id', $id)->first();
        $item = new PlantFull();
        $item->id = $dbItem['id'];
        $item->name = $dbItem['name'];
        $item->addDate = $dbItem['add_date'];
        $item->shortInfo = $dbItem['short_info'];
        $item->fullInfo = $dbItem['full_info'];
        $item->photoSmallPath = $dbItem['photo_small_path'];
        $item->photoBigPath = $dbItem['photo_big_path'];
        $item->wateringDays = $dbItem['watering_days'];
        $item->manuringDays = $dbItem['manuring_days'];
        $item->pestControlDays = $dbItem['pest_control_days'];
        $item->tags = [];
        foreach ($dbItem['tags'] as $dbTag)
            $item->tags[] = $dbTag['tag'];
        return $item;
    }

    /**
     * @throws \ErrorException
     */
    public function updatePlant(PlantFull $plant)
    {
        echo("<script>console.log('updatePlant');</script>");
//        $exists = DbPlant::where('name', $plant->name)->get();
//        foreach ($exists as $exist) {
//           if ($exist["id"] != $plant->id)
//               throw new \ErrorException('Растение с таким именем уже сущетсвует');
//        }
        $dbPlant = DbPlant::find($plant->id);
        $dbPlant['name'] = $plant->name;
        $dbPlant['short_info'] = $plant->shortInfo;
        unlink(public_path('/Images/Small/' . $dbPlant['photo_small_path']));
        $dbPlant['photo_small_path'] = $plant->photoSmallPath;
        $dbPlant['full_info'] = $plant->fullInfo;
        $dbPlant['watering_days'] = $plant->wateringDays;
        $dbPlant['manuring_days'] = $plant->manuringDays;
        $dbPlant['pest_control_days'] = $plant->pestControlDays;
        $dbPlant->save();

        $dbTags = DbPlantTag::where('plant_id', $plant->id)->get();

        foreach ($plant->tags as $tag) {

            foreach ($dbTags as $dbTag) {
                if ($dbTag['tag'] === $tag)
                    continue 2;
            }
            $newTag = [];
            $newTag["plant_id"] = $plant->id;
            $newTag["tag"] = $tag;
            DbPlantTag::create($newTag);
        }
        foreach ($dbTags as $dbTag) {
            foreach ($plant->tags as $tag) {
                if ($dbTag['tag'] === $tag)
                    continue 2;
            }
            $dbTag->delete();
        }
    }
    public function insertPlant(PlantFull $plant)
    {
        echo("<script>console.log('insertPlant');</script>");
        $dbItem = DbPlant::where('name', $plant->name)->get();
        foreach ($dbItem as $exist) {
           if ($exist["id"] != $plant->id)
               throw new \ErrorException('Растение с таким именем уже сущетсвует');
        }
        $dbPlant = [];
        $dbPlant['name'] = $plant->name;
        $dbPlant['add_date'] = $plant->addDate;
        $dbPlant['short_info'] = $plant->shortInfo;
        $dbPlant['full_info'] = $plant->fullInfo;
        $dbPlant['photo_small_path'] = $plant->photoSmallPath ?? NULL;
        $dbPlant['photo_big_path'] = $plant->photoBigPath ?? NULL;
        $dbPlant['watering_days'] = $plant->wateringDays ?? 0;
        $dbPlant['manuring_days'] = $plant->manuringDays ?? 0;
        $dbPlant['pest_control_days'] = $plant->pestControlDays ?? 0;
        DbPlant::insert($dbPlant);
        $newPlant = DbPlant::where  ('name', $plant->name)->first();

        foreach ($plant->tags as $tag){
            $newTag = [];
            $newTag["plant_id"] = $newPlant->id;
            $newTag["tag"] = $tag;
            DbPlantTag::insert($newTag);
        }

        
    }

    /**
     * @throws \ErrorException
     */
    public function deletePlant(int $plantId)
    {
        echo("<script>console.log('deletePlant');</script>");

        if (DbUserPlant::where('plant_id', $plantId)->count() > 1)
            throw new \ErrorException('Растение используется пользователями');
        $dbTags = DbPlantTag::where('plant_id', $plantId)->get();

        foreach ($dbTags as $dbTag)
            $dbTag->delete();

        $dbPlant = DbPlant::find($plantId);
        unlink(public_path('/Images/Small/' . $dbPlant->photo_small_path));
        $dbPlant->delete();
    }

    public function addPlantToFavor(int $userId, int $plantId)
    {
        echo("<script>console.log('addPlantToFavor');</script>");
        if (DbUserPlant::where('user_id', $userId)->where('plant_id', $plantId)->count() > 0)
            return false;
        $dbUserPlant = [];
        $dbUserPlant['user_id'] = $userId;
        $dbUserPlant['plant_id'] = $plantId;
        $plant = DbUserPlant::create($dbUserPlant);
        return $plant;

    }

    public function removePlantFromFavor(int $userId, int $plantId)
    {
        echo("<script>console.log('removePlantFromFavor');</script>");
        $dbUserPlant = DbUserPlant::where('user_id', $userId)->where('plant_id', $plantId)->first();
        if ($dbUserPlant === null)
            return;
        $dbUserPlant->delete();
    }

    public function getFavorPlants(int $userId): array
    {
        echo("<script>console.log('getFavorPlants');</script>");
        $dbData = DbUserPlant::with("plant")->where('user_id', $userId)->get();
        $data = [];
        foreach ($dbData as $dbItemUserPlant) {
            $data[] = $this->getPlantFromDbPlant($dbItemUserPlant['plant']);
        }
        return $data;
    }

    public function getFavorCalendar(int $userId): ?array
    {
        $dbData = DbUserPlant::with("plant")->where('user_id', $userId)->get();
        if(count($dbData) === 0)
            return null;
        $dataPlant = [];
        foreach ($dbData as $dbItemUserPlant) {
            $dataPlant[] = $this->getPlantFromDbPlant($dbItemUserPlant['plant']);
        }
        $date = [];
        $begin = new DateTime('first day of this month');
        date_time_set($begin,0,0,0);
        $end = new DateTime('last day of this month');
        $totalDays = $end->diff($begin)->d+1;
        $actionWatering = DbAction::where('id', 1)->first();
        $actionManuring = DbAction::where('id', 2)->first();
        $actionPesting = DbAction::where('id', 3)->first();

        for ($day = 1; $day <= $totalDays; $day++) {
            $item = new CalendarPlant();
            $item->dayNum = $day;
            $item->date = date_format($begin,'Y-m-d');
            $item->dayInfo = date_format($begin,'d.m');
            $item->plantsToDo = [];
            $item->doneCount = 0;
            foreach ($dataPlant as $plant){
                if( $plant->wateringDays > 0 && $day % $plant->wateringDays === 0) {
                    $toDo = new CalendarPlantRow();
                    $toDo->plant = $plant;
                    $toDo->action = $actionWatering;
                    $toDo->done = DbPlantUserDone::where('user_id', $userId)->where('plant_id',$plant->id)->where('action_id',1)->where('date',$begin)->first() !== null;
                    if(!$toDo->done && now() > $begin) {
                        $toDo->status = 'fail';
                    }
                    $item->plantsToDo[] = $toDo;
                    if($toDo->done)
                        $item->doneCount++;
                }
                if( $plant->manuringDays > 0 && $day % $plant->manuringDays === 0){
                    $toDo = new CalendarPlantRow();
                    $toDo->plant = $plant;
                    $toDo->action = $actionManuring;
                    $toDo->done = DbPlantUserDone::where('user_id', $userId)->where('plant_id',$plant->id)->where('action_id',2)->where('date',$begin)->first() !== null;
                    if(!$toDo->done && now() > $begin) {
                        $toDo->status = 'fail';
                    }
                    $item->plantsToDo[] = $toDo;
                    if($toDo->done)
                        $item->doneCount++;
                }
                if( $plant->pestControlDays > 0 && $day % $plant->pestControlDays === 0){
                    $toDo = new CalendarPlantRow();
                    $toDo->plant = $plant;
                    $toDo->action = $actionPesting;
                    $toDo->done = DbPlantUserDone::where('user_id', $userId)->where('plant_id',$plant->id)->where('action_id',3)->where('date',$begin)->first() !== null;
                    if(!$toDo->done && now() > $begin) {
                        $toDo->status = 'fail';
                    }
                    if($toDo->done)
                        $item->doneCount++;
                }
            }
            $item->totalCount = count($item->plantsToDo);
            $item->percent = 0;
            if($item->totalCount > 0)
                $item->percent = 100 * $item->doneCount / $item->totalCount;
            $date[] = $item;
            $begin->modify("+1 day");
        }
//        dd($date);
        return $date;
    }

    private function getPlantFromDbPlant(DbPlant $dbPlant): PlantShort
    {
        $userId = Auth::check() ? Auth::user()->id : false;

        $item = new PlantShort();
        $item->id = $dbPlant['id'];
        $item->name = $dbPlant['name'];
        $item->addDate = \DateTime::createFromFormat('Y-m-d', $dbPlant['add_date'])->format('d.m.Y');
        $item->shortInfo = $dbPlant['short_info'];
        $item->photoSmallPath = $dbPlant['photo_small_path'];
        $item->wateringDays = $dbPlant['watering_days'];
        $item->manuringDays = $dbPlant['manuring_days'];
        $item->pestControlDays = $dbPlant['pest_control_days'];
        $tags = [];
        foreach ($dbPlant['tags'] as $dbTag)
            $tags[] = $dbTag['tag'];
        $item->tags = implode(", ", $tags);
        $item->isFavor = DbUserPlant::where('user_id', $userId)
        ->where('plant_id', $item->id)
        ->first() !== null;
        $tagsList = '';
        foreach ($dbPlant['tags'] as $dbTag)
            $tagsList .= $dbTag['tag'] . " ";
        $item->tagsList = $tagsList;
        return $item;
    }

    public function getTags()
    {
        return DbPlantTag::pluck('tag')->unique();
    }

    public function getTagById(int $plantId)
    {
        $dbPlantTag = DbPlantTag::where('plant_id',$plantId)->pluck('tag');
        return $dbPlantTag;
    }

    public function setUserPlantDone(int $userId, int $plantId, int $actionId, string $date) : void
    {
        echo("<script>console.log('setUserPlantDone');</script>");
        if(DbPlantUserDone::where('user_id',$userId)->where('plant_id',$plantId)->where('action_id',$actionId)->where('date',$date)->count() > 0)
            return;
        $dbUserPlantDone = [];
        $dbUserPlantDone['user_id'] = $userId;
        $dbUserPlantDone['plant_id'] = $plantId;
        $dbUserPlantDone['action_id'] = $actionId;
        $dbUserPlantDone['date'] = $date;
        DbPlantUserDone::create($dbUserPlantDone);
    }
    public function resetUserPlantDone(int $userId, int $plantId, int $actionId, string $date): void
    {
        echo("<script>console.log('resetUserPlantDone');</script>");
        $dbUserPlantDone = DbPlantUserDone::where('user_id',$userId)->where('plant_id',$plantId)
        ->where('action_id',$actionId)
        ->where('date',$date)->first();
        if($dbUserPlantDone === null)
            return;
        $dbUserPlantDone->delete();
    }
}
