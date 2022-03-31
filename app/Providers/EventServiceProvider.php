<?php

namespace App\Providers;

use App\Events\LoginAdminEvent;
use App\Listeners\SendLoginAdminNotification;
use App\Listeners\SendSubscribeEndsWarningNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendSubscribeEndsWarningNotification::class,

        ],

        LoginAdminEvent::class => [
            SendLoginAdminNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
