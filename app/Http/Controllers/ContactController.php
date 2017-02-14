<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Contact;

use Mail;

class ContactController extends Controller
{
    public function create(\App\Http\Requests\StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->ip_address = $request->ip();
        $contact->save();
        $request->session()->flash('status', 'Your message has been sent successfully.');

        Mail::send('emails.contact', ['contact' => $request], function ($m) use ($request) {
            $m->from('contact@feminaplusmenopause.com', 'Femina Plus Menopause');
            $m->sender('contact@feminaplusmenopause.com', 'Femina Plus Menopause');
            $m->replyTo($request->email, $request->name);
            $m->subject("Femina Plus Contact $request->name");
            $m->to(env('ADMIN_EMAIL'), env('ADMIN_NAME'));
        });

        return redirect('/contact');
    }
}
