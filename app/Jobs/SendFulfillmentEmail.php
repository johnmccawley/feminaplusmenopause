<?php

namespace App\Jobs;

use Mail;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFulfillmentEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $customerData, $purchased;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customerData, $purchased)
    {
        $this->customerData = $customerData;
        $this->purchased = $purchased;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customerData = $this->customerData;
        $purchased = $this->purchased;
        $data = ['customerData' => $customerData, 'purchased' => $purchased];
        $fullName = $customerData->firstName . " " . $customerData->lastName;

        Mail::send('emails.fulfill', $data, function ($m) use ($customerData, $purchased, $fullName) {
            $m->from('fulfillment@feminaplusmenopause.com', 'Femina Plus Menopause');
            $m->sender('fulfillment@feminaplusmenopause.com', 'Femina Plus Menopause');
            $m->replyTo($customerData->email, $fullName);
            $m->subject('FULFILLMENT REQUEST');
            $m->to(env('FULFILL_EMAIL_ONE'), env('FULFILL_NAME_ONE'));
            $m->to(env('FULFILL_EMAIL_TWO'), env('FULFILL_NAME_TWO'));
            $m->cc(env('ADMIN_EMAIL'), env('ADMIN_NAME'));
        });
    }
}
