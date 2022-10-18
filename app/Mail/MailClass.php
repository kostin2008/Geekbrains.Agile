<?php

namespace App\Mail;

use App\Models\DbModels\DbPlant;
use App\Models\PlantFull;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailClass extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $plant;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PlantFull $plant)
    {
        $this->plant = $plant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactMail', ['plant' => $this->plant] );
    }
}
