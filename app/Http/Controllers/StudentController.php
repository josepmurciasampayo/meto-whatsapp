<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    //
    public function index() :View
    {
        return view('studnet.home');
    }
}