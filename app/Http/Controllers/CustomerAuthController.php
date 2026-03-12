<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function forgetpassword()
    {
        return view('forgetpassword');
    }
}
