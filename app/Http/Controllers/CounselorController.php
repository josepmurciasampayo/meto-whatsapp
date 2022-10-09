<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CounselorController extends Controller
{
    //
    public function index() :View
    {
        return view('counselor.home');
    }

    public function highschool(int $id) :View
    {
        return view('counselor.highschool');
    }
}
