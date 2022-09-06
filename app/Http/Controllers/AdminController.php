<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    //
    public function index() :View
    {
        return view('admin.home');
    }

    public function info() :View
    {
        return view('admin.info');
    }
}
