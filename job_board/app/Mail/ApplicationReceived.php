<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $job;

    public function __construct($user, $job)
    {
        $this->user = $user;
        $this->job = $job;
    }

    public function build()
    {
        return $this->from('mostafamokna78@gmail.com', 'Mostafa Mokna')
        ->subject('Application Received'); 
    }
}

