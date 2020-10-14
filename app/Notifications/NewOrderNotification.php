<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;


class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['fcm'];
    }

    public function toFcm($notifiable) 
    {
        $message = new FcmMessage();
        $message->content([
            'title'        => 'new order', 
            'body'         => 'test for new order', 
            'sound'        => '', // Optional 
            'icon'         => '', // Optional
            'click_action' => '' // Optional
        ])->data([
            'param1' => 'baz' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
        
        return $message;
    }
}
