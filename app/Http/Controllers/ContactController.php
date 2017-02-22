<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Jobs\SendContactEmail;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\Request;
use App\Http\Requests;

class ContactController extends Controller
{
    public function create(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->ip_address = $request->ip();
        $contact->save();

        $this->dispatch((new SendContactEmail($contact))->onQueue('emails'));

        return \Redirect::back()->with('status', 'Your message has been sent successfully.');
    }
}
