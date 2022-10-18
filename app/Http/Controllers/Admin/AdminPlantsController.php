<?php

namespace App\Http\Controllers\Admin;

use App\Events\PlantEvent;
use App\Http\Controllers\Controller;
use App\Models\PlantFull;
use App\Service\IDbPlantService;
use App\Service\Real\DbPlantService;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;
use function PHPUnit\Framework\isNull;

class AdminPlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(IDbPlantService $dbPlant, $search = null)
    {
        $plants = $dbPlant->getAllPlants($search);
        return view('admin.plants', ['plants' => $plants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create(Request $request, IDbPlantService $dbPlant)
    {

        $plant = new PlantFull();
        $plant->name = $request['name'];
        $plant->addDate = date("Y-m-d H:i:s");
        $plant->fullInfo = $request['fullInfo'];
//        $plant->photoBigPath = $request['photoBigPath'];
        $plant->shortInfo = $request['shortInfo'];
        $plant->wateringDays = $request['wateringDays'];
        $plant->manuringDays = $request['manuringDays'];
        $plant->pestControlDays = $request['pestControlDays'];
        $plant->tags = [];
        $tagKey = preg_grep("/tag/", array_keys($request->all()));
        foreach ($tagKey as $value) {
            $plant->tags[] = $request[$value];
        }
        if ($request->hasFile('photo')) {
            $plant->photoSmallPath = $this->store($request->file('photo'));
        }
        $dbPlant->insertPlant($plant);
       
        event(new PlantEvent($plant));


        return redirect()->route('admin::plants::createView')
            ->with('success', "Растение добавлено");
    }

    public function createView(DbPlantService $dbPlant)
    {

        $tags = $dbPlant->getTags();
        return view('admin.addPlant', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( $file, $exist = null): string
    {
        if ($exist != null) {
            unlink(public_path('/Images/Small/' . $exist));
        }
        $path = $file->getClientOriginalName();
        $file->move(public_path() . '/Images/Small/', $path);
        return $path;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */

    public function updateView(int $id, DbPlantService $dbPlant)
    {
        $plants = $dbPlant->getPlant($id);
        $tags = $dbPlant->getTags();
        $plantTags = $dbPlant->getTagById($id);
//        dd($plantTags);

        return view('admin.addPlant', [
            'plants' => $plants,
            'tags' => $tags,
            'plantTags' => $plantTags
        ]);
    }

    public function update(Request $request, $id, IDbPlantService $dbPlant)
    {
        $plant = $dbPlant->getPlant($id);
        $plant->name = $request['name'];
        $plant->shortInfo = $request['shortInfo'];
        $plant->fullInfo = $request['fullInfo'];
        $plant->photoSmallPath = $request['photoSmallPath'];
//        $plant->photoBigPath = $request['photoBigPath'];
        $plant->wateringDays = $request['wateringDays'];
        $plant->manuringDays = $request['manuringDays'];
        $plant->pestControlDays = $request['pestControlDays'];
        $plant->tags = [];
        $tagKey = preg_grep("/tag/", array_keys($request->all()));
        foreach ($tagKey as $value) {
            $plant->tags[] = $request[$value];
         }
        if ($request->hasFile('photo')) {
            $plant->photoSmallPath = $this->store($request->file('photo'), $plant->photoSmallPath);
        }
//        dd($plant);
        $dbPlant->updatePlant($plant);
        return redirect()->route('admin::plants::updateView', ['id' => $plant->id])
            ->with('success', "Растение обновлено");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param IDbPlantService $dbPlant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, IDbPlantService $dbPlant)
    {

        $dbPlant->deletePlant($id);
        return redirect()->route('admin::plants::plantList');
    }
}