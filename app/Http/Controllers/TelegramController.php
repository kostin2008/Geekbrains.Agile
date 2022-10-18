<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PlantsActionsNotification;
use App\Service\IDbPlantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    public function register()
    {
        return view('telegram.register');
    }

    public function testMessage()
    {
        $getUpdates = file_get_contents("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/getUpdates");
        $json = json_decode($getUpdates, true);
        $telegramId = $json["result"][count($json["result"]) - 1]["message"]["from"]["id"];
        $user = \Auth::user();
        $user->telegram_user_id = $telegramId;
        $user->save();
        //Здесь происходит добавление в базу данных поля telegramId для пользователя 513318812
        $user->notify((new PlantsActionsNotification('Вы успешно подписались на уведомления')));
        return redirect()->back();
    }

    public function notifyMe(Request $request, IDbPlantService $dbPlant)
    {
        $calendar = $dbPlant->getFavorCalendar(Auth::user()->id);
        $user = \Auth::user();
        $notified = 0;
        if($calendar) {
            foreach ($calendar as $item) {
                if ($item->dayNum == date('d')) {
                    foreach ($item->plantsToDo as $row) {
                        if (!$row->done)
                        $user->notify((new PlantsActionsNotification("Необходимо произвести {$row->action->name} с растением {$row->plant->name}")));
                        $notified = 1;
                    }
                }
            }
            if($notified == 0) {
                $user->notify((new PlantsActionsNotification("На сегодня всё сделано, ваши питомцы в порядке")));
            }
        } else {
            $user->notify((new PlantsActionsNotification("У вас пока нет избранных растений")));
        }
        return redirect()->back();
    }


    public function notifyAll()
    {
    }
}
