<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UniController extends Controller
{
    public function welcome() :View
    {
        return view('uni.welcome');
    }

    public function name() :View
    {
        return view('uni.name');
    }

    public function nameStore(Request $request) :RedirectResponse
    {
        return redirect(route('uni.homepage'));
    }

    public function homepage() :View
    {
        return view('uni.homepage');
    }

    public function homepageStore() :RedirectResponse
    {
        return redirect(route('uni.application'));
    }

    public function application() :View
    {
        return view('uni.application');
    }

    public function applicationStore() :RedirectResponse
    {
        return redirect(route('uni.location'));
    }

    public function location() :View
    {
        return view('uni.location');
    }

    public function locationStore() :RedirectResponse
    {
        return redirect(route('uni.efc'));
    }

    public function efc() :View
    {
        return view('uni.location');
    }

    public function efcStore() :RedirectResponse
    {
        return redirect(route('uni.location'));
    }

    public function mingrade() :View
    {
        return view('uni.mingrade');
    }

    public function mingradeStore() :RedirectResponse
    {
        return redirect(route('uni.location'));
    }

    public function home() :View
    {
        return view('uni.home');
    }

    public function myProfile() :View
    {
        return view('uni.myProfile');
    }

    public function myProfileStore(Request $request) :RedirectResponse
    {
        return redirect(route(''));
    }

    public function uniProfile() :View
    {
        return view('uni.uniProfile');
    }

    public function uniProfileStore(Request $request) :RedirectResponse
    {
        return redirect(route(''));
    }

    public function connections() :View
    {
        return view('uni.connections');
    }

    public function database() :View
    {
        return view('uni.database');
    }

    public function efcGrades() :View
    {
        return view('uni.efcGrades');
    }

    public function efcGradesStore(Request $request) :RedirectResponse
    {
        return redirect(route(''));
    }

    public function newUser() :View
    {
        return view('newUser');
    }

    public function newUserStore(Request $request) :RedirectResponse
    {
        return redirect(route(''));
    }

}