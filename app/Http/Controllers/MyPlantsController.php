<?php

namespace App\Http\Controllers;

use App\Service\IDbPlantService;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MyPlantsController extends Controller
{
    public function favorPlants(Request $request, IDbPlantService $dbPlant)
    {
        $userId = Auth::user()->id;
        $plants = $dbPlant->getFavorPlants($userId);
        return view('plants.chosenTable',['plants' => $plants]);
    }
    public function addFavor($userId, $plantId, Request $request, IDbPlantService $dbPlant)
    {
        $dbPlant->addPlantToFavor($userId, $plantId);
        echo('$userId = ' . $userId);
        echo('$plantId = ' . $plantId);
    }

    public function removeFavor($userId, $plantId, Request $request, IDbPlantService $dbPlant)
    {
        $dbPlant->removePlantFromFavor($userId, $plantId);
    }
    public function setUserPlantDone(int $userId, int $plantId, int  $actionId, string $date, Request $request, IDbPlantService $dbPlant)
    {
        $dbPlant->setUserPlantDone($userId, $plantId, $actionId, $date);
    }
    public function resetUserPlantDone(int $userId, int $plantId, int  $actionId, string $date, Request $request, IDbPlantService $dbPlant)
    {
        $dbPlant->resetUserPlantDone($userId, $plantId, $actionId, $date);
    }
    public function calendar(Request $request, IDbPlantService $dbPlant)
    {
        $calendar = $dbPlant->getFavorCalendar(Auth::user()->id);
        return view('plants.calendarTable', ['dates' => $calendar]);
    }
    public function getNotifications(Request $request, IDbPlantService $dbPlant) : JsonResponse
    {
        $calendar = $dbPlant->getFavorCalendar(Auth::user()->id);
        $notifications = [];
        foreach ($calendar as $item){
            if($item->dayNum == date('d')){
                foreach ($item->plantsToDo as $row){
                    if(!$row->done)
                        $notifications[] = "Необходимо произвести {$row->action->name} с растением {$row->plant->name}";
                }
            }
        }
        return response()->json($notifications);
    }

}
