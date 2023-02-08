<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SignupController extends Controller
{
    public function home() :View
    {
        return view('auth.signup');
    }

    public function student() :View
    {
        return view('student.signup');
    }

    public function uni() :View
    {
        return view('uni.signup');
    }

    public function counselor() :View
    {
        return view('counselor.signup');
    }
}
