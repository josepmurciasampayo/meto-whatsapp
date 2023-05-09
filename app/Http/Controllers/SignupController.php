<?php

namespace App\Http\Controllers;

use App\Mail\UniSignup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function uniStore(Request $request) :View
    {
        Mail::to('abraham@meto-intl.org')->send(new UniSignup(
            $request->input('name'),
            $request->input('institution'),
            $request->input('email'),
            $request->input('title'),
            $request->input('how')
        ));
        return view('uni.thankyou');
    }

    public function counselor() :View
    {
        return view('counselor.signup');
    }
}
