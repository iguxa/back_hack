<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function GetApiToken()
    {
            $token = hash('sha256', Str::random(60));
            $this->guard()->user()->forceFill([
                'api_token' => $token,
            ])->save();

        return $token;
    }
    public function isValidToken($token)
    {
        $user =  User::where('api_token', $token)->limit(1)->first();
        if($user){
            Auth::loginUsingId($user->id);
        }
        return $user;
    }
    public function Valid($request)
    {
        return $this->attemptLogin($request);
    }
}
