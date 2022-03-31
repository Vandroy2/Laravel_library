<?php

namespace App\Listeners;


use App\Models\User;
use App\Notifications\SubscribeEndsWarningNotification;
use Illuminate\Support\Facades\Notification;


class SendSubscribeEndsWarningNotification
{
    /**
     * @param object $event
     */
    public function handle(object $event)
    {

    }
}
