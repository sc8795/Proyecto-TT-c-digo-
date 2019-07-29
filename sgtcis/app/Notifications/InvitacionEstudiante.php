<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitacionEstudiante extends Notification
{
    use Queueable;
    protected $invita_estudiante;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invita_estudiante)
    {
        $this->invita_estudiante=$invita_estudiante;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'invita_estudiante'=>$this->invita_estudiante,
        ];
    }
}
