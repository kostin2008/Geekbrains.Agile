<?php


namespace App\Http\Controllers;


use App\Models\User;
use App\Notifications\PlantsActionsNotification;
use App\Service\IDbPlantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return view('test.index', ['list' => ["1","2","3"]]);
    }

    public function deletePlant(Request $request)
    {
        $dbPlant = App::make(IDbPlantService::class);
        $dbPlant->deletePlant(1);
        //copied
    }

    public function addPlantToFavor($userId, $plantId, Request $request, IDbPlantService $dbPlant)
    {
        $plant = $dbPlant->addPlantToFavor($userId, $plantId);
        if ($plant) {
            return Redirect::route('catalog')->with('success', 'Растение успешно добавлено');
        }
        return Redirect::route('catalog')->with('error', 'Такое растение уже добавлено в Избранное');
    }

    public function removePlantFromFavor($userId, $plantId, Request $request, IDbPlantService $dbPlant)
    {
        $dbPlant->removePlantFromFavor($userId, $plantId);
        return Redirect::route('favorPlants')->with('success', "Растение успешно удалено из Избранного");
    }

    public function getFavorPlants(Request $request, IDbPlantService $dbPlant)
    {
        foreach ($dbPlant->getFavorPlants(1) as $item)
            echo "{$item->id}  ; {$item->name}  ; {$item->addDate}  ; {$item->photoSmallPath}  ; {$item->shortInfo}  ; {$item->wateringDays}  ; {$item->tags}  <BR>";
    }

    public function testCalendar(IDbPlantService $dbPlant)
    {
        $calendar = $dbPlant->getFavorCalendar(Auth::user()->id);
        return view('plants.calendarTable', ['dates' => $calendar]);
    }
}
