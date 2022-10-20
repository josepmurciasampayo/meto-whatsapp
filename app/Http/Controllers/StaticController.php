<?php

namespace App\Http\Controllers;

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


}
