<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class PlantsActionsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @param $data
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $url = url('/calendar');

        return TelegramMessage::create()
            // Markdown supported.
            ->content($this->message)

            // (Optional) Blade template for the content.
//             ->view('PlantActionNotification', ['data' => $this->data])

            // (Optional) Inline Buttons
            ->button('В календарь', $url);
    }
}
