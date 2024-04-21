<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }
}
