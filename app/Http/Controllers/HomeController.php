<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*Mail::raw('Hi, welcome user!', function ($message) {
            $message->to('tsybykov@bk.ru')
    ->subject('test');
});*/

        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
        $auth_token = 'your_auth_token';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
        $twilio_number = "+15017122661";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
        // Where to send a text message (your cell phone?)
            '+15558675310',
            array(
                'from' => $twilio_number,
                'body' => 'I sent this message in under 10 minutes!'
            )
        );
        return view('home');
    }
}
