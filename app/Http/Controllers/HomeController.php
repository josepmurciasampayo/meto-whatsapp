<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (is_null(Auth()->user())) {
            return redirect('login');
        }
        if (Auth()->user()->isAdmin()) {
            return view('admin.home');
        }
        if (Auth()->user()->isCounselor()) {
            return view('counselor.home');
        }
        if (Auth()->user()->isInstitution()) {
            return view('institution.home');
        }
        if (Auth()->user()->isStudent()) {
            return view('student.home');
        }
        Log::error("Home Controller with no home found");

    }
}
