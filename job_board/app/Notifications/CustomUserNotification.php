<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomUserNotification extends Notification
{
    protected $jobTitle;
    protected $user_id;

    public function __construct($jobTitle, $userId)
    {
        $this->jobTitle = $jobTitle;
        $this->user_id = $userId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Congrates You’ve been hired for the job: {$this->jobTitle}.",
            'type' => 'hired',
            'user_id' => $this->user_id 
        ];
    }


}
