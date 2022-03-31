<?php

namespace App\Listeners;




use App\Models\User;
use App\Notifications\LoginAdminNotification;
use Illuminate\Support\Facades\Notification;

class SendLoginAdminNotification
{
    /**
     * @param $event
     */

    public function handle($event)
    {
        $superAdmin = User::query()->
        where('type', '=', 'admin')
            ->firstOrFail();

        Notification::send($superAdmin, new LoginAdminNotification($event->user));

    }
}
