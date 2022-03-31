<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LoginAdminNotification extends Notification
{
    use Queueable;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param $notifiable
     * @return string[]
     */

    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * @param $notifiable
     * @return array
     */

    public function toArray($notifiable): array
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];
    }


}
