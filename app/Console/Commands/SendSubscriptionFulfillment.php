<?php

namespace App\Console\Commands;

use Mail;
use Illuminate\Console\Command;

class SendSubscriptionFulfillment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:fulfillment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email for each monthly subscription that has to ship on this day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::send('emails.test', [], function ($message) {
            $message->from('test@local.com', 'Testing');
            $message->to(env('FULFILL_EMAIL_ONE'))->cc(env('FULFILL_EMAIL_TWO'))->subject('FULFILLMENT REQUEST');
       });
    }
}
