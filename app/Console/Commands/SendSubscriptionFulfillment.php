<?php

namespace App\Console\Commands;

use DB;
use App\Fulfillment;
use \Stripe\Stripe as Stripe;
use \Stripe\Plan as Plan;
use \Stripe\Subscription as Subscription;
use App\Jobs\SendFulfillmentEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Console\Command;

class SendSubscriptionFulfillment extends Command
{
    use DispatchesJobs;

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

        foreach($subscriptions as $sub) {
            if ($sub->active == true) {
                $subscription = Subscription::retrieve($sub->stripe_id);
                $subscriptionDate = getdate($subscription->current_period_end);

                if ($subscription->status == 'active') {
                    // Fulfills day before end date because the end date moves to next month the day of
                    if ($subscriptionDate['year'] == $currentDate['year'] && $subscriptionDate['mon'] == $currentDate['mon'] && ($subscriptionDate['mday']-1) == $currentDate['mday']) {
                        $customerData = json_decode($sub->customer_info);
                        $purchased = (object)['fpClub' => (object)['amount' => $sub->quantity, 'type' => 'plan', 'name' => 'Femina Plus Club Refill']];
                        $this->fulfillmentEmail($customerData->shipping, $purchased, $sub->id);
                    }
                } else {
                    $endDate = $subscriptionDate['year'] . '-' . $subscriptionDate['mon'] . '-' . $subscriptionDate['mday'] . ' ' . $subscriptionDate['hours'] . ':' . $subscriptionDate['minutes'] . ':' . $subscriptionDate['seconds'];
                    DB::table('subscriptions')->where('id', $sub->id)->update(['active' => false, 'ends_at' => $endDate]);
                }
            }
        }
    }

    private function fulfillmentEmail($customerData, $purchased, $subscriptionId) {
        $fulfillment = new Fulfillment();
        $fulfillment->subscription_id = $subscriptionId;
        $fulfillment->name = $customerData->firstName . " " . $customerData->lastName;
        $fulfillment->email = $customerData->email;
        $fulfillment->message = "Subscription fulfillment";
        $fulfillment->save();

        $this->dispatch((new SendFulfillmentEmail($customerData, $purchased))->onQueue('emails'));
    }
}
