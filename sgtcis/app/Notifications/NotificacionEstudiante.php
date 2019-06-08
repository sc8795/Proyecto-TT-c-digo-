<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificacionEstudiante extends Notification
{
    use Queueable;
    protected $noti_estudiante;

    /**
     * Get the array representation of the notification.
     *
     * @return void
     */
    public function __construct($noti_estudiante){
        $this->noti_estudiante=$noti_estudiante;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(){
        return[
            'noti_estudiante'=>$this->noti_estudiante,
        ];
    }
}
