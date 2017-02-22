<?php

namespace App\Jobs;

use Mail;
use App\Contact;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $contact;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct(Contact $contact)
     {
         $this->contact = $contact;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
     public function handle()
     {
         $contact = $this->contact;
         Mail::send('emails.contact', ['contact' => $contact], function ($m) use ($contact) {
             $m->from('contact@feminaplusmenopause.com', 'Femina Plus Menopause');
             $m->sender('contact@feminaplusmenopause.com', 'Femina Plus Menopause');
             $m->replyTo($contact->email, $contact->name);
             $m->subject("Femina Plus Contact $contact->name");
             $m->to(env('ADMIN_EMAIL'), env('ADMIN_NAME'));
         });
     }
}
