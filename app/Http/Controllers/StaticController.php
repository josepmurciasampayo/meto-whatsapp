<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaticController extends Controller
{
    public function terms() :View
    {
        return view('static.terms');
    }

    public function privacy() :View
    {
        return view('static.privacy-policy');
    }

    public function saveTerms(Request $request) :RedirectResponse
    {
        $user = Auth()->user();
        $user->terms = $request->terms;
        $user->save();
        return redirect(route('home'));
    }
}
