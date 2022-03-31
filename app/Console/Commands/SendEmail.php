<?php

namespace App\Console\Commands;

use App\Mail\MyTestMail;
use App\Mail\SubscribeMail;
use Illuminate\Console\Command;
use Mail;


class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send test email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        Mail::to('y.litvin@ukr.net')->send(new SubscribeMail());

        $this->info('Success');
    }
}
