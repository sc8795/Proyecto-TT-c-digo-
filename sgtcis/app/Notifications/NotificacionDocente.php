<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificacionDocente extends Notification
{
    use Queueable;
    protected $noti_docente;

    /**
     * Get the array representation of the notification.
     *
     * @return void
     */
    public function __construct($noti_docente){
        $this->noti_docente=$noti_docente;
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
            'noti_docente'=>$this->noti_docente,
        ];
    }
}
