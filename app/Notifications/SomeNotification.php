<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

 
class SomeNotification extends Notification
{
    use Queueable;
    public $data;
    /**  
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
         return ['fcm'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
    }


    public function toFcm($notifiable) 
{
    $message = new FcmMessage();
    $message->to()->setHeaders([
        'project_id'    =>  "37644761165"   // FCM sender_id
    ])->content([
        'title'        => 'Foo', 
        'body'         => 'Bar', 
        'sound'        => '', // Optional 
        'icon'         => '', // Optional
        'click_action' => '' // Optional
    ])->data([
        'param1' => 'baz' // Optional
    ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
    
    return $message;
}  

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->data;
    }
}
