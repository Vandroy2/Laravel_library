<?php

namespace App\Console\Commands;

use App\Mail\SubscribeMail;
use App\Models\Subscribe;
use App\Models\User;
use App\Notifications\SubscribeEndsWarningNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CheckSubscribe extends Command
{
    /**
     * @var string
     */
    protected $signature = 'check:subscribe';
    /**
     * @var string
     */
    protected $description = 'Checking subscribe date';

    public function handle()
        {
            $users = User::all();

            $users->each(function ($user) use($users)
            {
                $user->subscribes->each(function ($subscribe) use ($user, $users)
                {
                    /**
                     * @var Subscribe $subscribe
                     */

                    if ($subscribe->dateEnd <= Carbon::now())
                    {

                        if ($user->balance >= $subscribe->subscribe_price)
                        {
                            $user->balance -= $subscribe->subscribe_price;
                            $user->save();
                        }
                        else
                        {
                            $user->subscribes()->detach($subscribe);
                        }
                    }
                    if ($subscribe->dateEnd->between(Carbon::now()->addDay(), Carbon::now()->addDays(2)))
                    {
                        Mail::to($user->email)->send(new SubscribeMail($subscribe));

                        Notification::send($user, new SubscribeEndsWarningNotification($subscribe));
                    }
                });
            });
            $this->info('Success');
        }
}
