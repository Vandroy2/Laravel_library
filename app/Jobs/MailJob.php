<?php

namespace App\Jobs;

use App\Console\Commands\CheckSubscribe;
use App\Mail\SubscribeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        $users->each(function ($user)
        {
            $user->subscribes->each(function($subscribe) use($user){
                if ($subscribe->dateEnd->between(Carbon::now()->addDay(), Carbon::now()->addDays(2)))
                {
                    Mail::to($user->email)->send(new SubscribeMail($subscribe));
                }
            });


        });
    }
}
