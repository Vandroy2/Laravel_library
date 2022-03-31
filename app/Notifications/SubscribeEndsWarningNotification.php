<?php

namespace App\Notifications;

use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribeEndsWarningNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * @return string[]
     */

    public function via(): array
    {
        return ['database'];
    }

    /**
     * @return MailMessage
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * @return array
     */

    public function toArray(): array
    {
        return [
            'subscribe_type' => $this->subscribe->subscribe_type,
            'monthQuantity' => $this->subscribe->monthQuantity,
        ];
    }
}
