<?php

namespace App\Http\Controllers;

use App\Models\DbModels\DbPlantTag;
use App\Models\PlantFull;
use App\Service\IDbPlantService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PlantsController extends Controller
{

    public function index(Request $request,  IDbPlantService $dbPlant, $search = null)
    {
        $tagsList = DbPlantTag::pluck('tag')->unique();
        $plantList = $dbPlant->getAllPlants($search);
        return view('plants.plantsList',['plantsList' => $plantList, 'tagsList'=>$tagsList, 'search'=>$search]);
//        return view('test.index',['plantsList' => $plantList, 'tagsList'=>$tagsList]);
    }

    public function onePlant($id, IDbPlantService $dbPlant)
    {
        $onePlant = $dbPlant->getPlant($id);
        return view('plants.onePlant', ['onePlant' => $onePlant]);
    }
    public function edit($id, IDbPlantService $dbPlant)
    {
        $plant = $dbPlant->getPlant($id);
        $plant->{"tag1"} = $plant->tags[0];
        $plant->{"tag2"} = $plant->tags[1];
        $plant->{"tag3"} = $plant->tags[2];
        $plant->{"tag4"} = $plant->tags[3];

        return view('plants.edit', ['plants' => $plant]);
    }

    public function update(Request $request, IDbPlantService $dbPlant)
    {

        $plant = new PlantFull();
        $plant->fill($_POST);

        $plant->id =$request->query->get('id');
        $plant->tags = [];
        $plant->tags[] =$_POST['tag1'];
        $plant->tags[] =$_POST['tag2'];
        $plant->tags[] =$_POST['tag3'];
        $plant->tags[] =$_POST['tag4'];

       $dbPlant->updatePlant($plant);

        return redirect('/catalog');
    }
}
