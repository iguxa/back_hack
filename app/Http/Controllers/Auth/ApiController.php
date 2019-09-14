<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function __construct()
    {
        //$test = 1;
    }
    public function index()
    {

        return ['token'=>Auth::user()->api_token];
    }

}
