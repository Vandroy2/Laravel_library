<?php

namespace App\Mail;

use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscribe;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscribe)
    {
        $this->subscribe = $subscribe;
    }

    public function getSubscribeParams()
    {
        return $this->subscribe->subscribe_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SubscribeMail
    {
        return $this
            ->subject("Subscribe ends warning")
            ->view('email.testMail', ['subscribe'=>$this->subscribe]);
    }
}
