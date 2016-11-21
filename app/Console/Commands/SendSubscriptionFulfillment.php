<?php

namespace App\Console\Commands;

use Mail;
use DB;
use \Stripe\Stripe as Stripe;
use \Stripe\Plan as Plan;
use \Stripe\Subscription as Subscription;
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
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $subscriptions = DB::table('subscriptions')->orderBy('id')->get();
        $currentDate = getdate(time());

        foreach($subscriptions as $value) {
            if ($value->active == true) {
                $subscription = Subscription::retrieve($value->stripe_id);
                $subscriptionDate = getdate($subscription->current_period_end);

                if ($subscription->status == 'active') {
                    if ($subscriptionDate['year'] == $currentDate['year'] && $subscriptionDate['mon'] == $currentDate['mon'] && $subscriptionDate['mday'] == $currentDate['mday']) {
                        $customerData = json_decode($value->customer_info);
                        $purchased = (object)['fpClub' => (object)['amount' => $value->quantity, 'type' => 'plan', 'name' => 'Femina Plus Club Refill']];
                        $this->fulfillmentEmail($customerData->shipping, $purchased);
                    }
                } else {
                    $endDate = $subscriptionDate['year'] . '-' . $subscriptionDate['mon'] . '-' . $subscriptionDate['mday'] . ' ' . $subscriptionDate['hours'] . ':' . $subscriptionDate['minutes'] . ':' . $subscriptionDate['seconds'];
                    DB::table('subscriptions')->where('id', $value->id)->update(['active' => false, 'ends_at' => $endDate]);
                }
            }
        }
    }

    private function fulfillmentEmail($customerData, $purchased) {
        $data = ['customerData' => $customerData, 'purchased' => $purchased];
        Mail::send('emails.fulfill', $data, function ($message) use ($customerData, $purchased) {
            $message->from('fulfillment@mg.feminaplusmenopause.com', 'Femina Plus');
            $message->to(env('FULFILL_EMAIL_ONE'))->cc(env('FULFILL_EMAIL_TWO'))->subject('FULFILLMENT REQUEST');
       });
    }
}
