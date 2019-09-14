<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ApiAuth
{
    protected $login_service;
    public function __construct()
    {
        $this->login_service = new LoginController;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->loginByCredentials($request);
        if (!$this->isValidToken($request->header('Authorization'))) {
            return new Response('Forbidden', 403);
        }
        return $next($request);
    }
    protected function loginByCredentials(Request $request) :void
    {
        if($this->login_service->Valid($request)){
            $token = $this->login_service->GetApiToken();
            $request->headers->set('Authorization', $token);
        }
    }
    protected function isValidToken($token)
    {
       return $this->login_service->isValidToken($token);
    }
}
