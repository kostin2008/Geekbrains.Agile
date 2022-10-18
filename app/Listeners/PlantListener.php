<?php

namespace App\Listeners;

use App\Mail\MailClass;
use App\Models\PlantFull;
use App\Models\User;
use App\Service\IDbPlantService;
use App\Service\Real\DbPlantService;
use App\Service\Real\SendEmailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PlantListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    public function handle($event)
    {
        if(isset($event->plant) && $event->plant instanceof PlantFull) {
            $usersemail = User::select('email')->get();
            foreach($usersemail as $email)
            Mail::to($email)->send(new MailClass($event->plant));
        }
    }
}
