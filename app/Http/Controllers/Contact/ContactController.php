<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct($method,array $data)
    {
        if(method_exists($this,$method)){
            $this->$method($data);
        }
    }
    protected function contactSms(array $data)
    {
        $client = new Client(env('TWILIO_ACCOUNT', ''), env('TWILIO_TOKEN', ''));
        foreach ($data as $contact){
            $client->messages->create(
                $contact['to'],
                array(
                    'from' => env('TWILIO_NUMBER', ''),
                    'body' => $contact['message']
                )
            );
        }
    }
    protected function contactMail(array $data)
    {
        foreach ($data as $contact) {
            Mail::raw($contact['message'], function ($message,$contact) {
                $message->to( $contact['to'])
                    ->subject($contact['title']);
            });
        }
    }
}
