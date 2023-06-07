<?php

namespace App\Http\Controllers;

use App\Models\StudentUniversity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConnectionController extends Controller
{
    public function index(): View
    {
        $connections = StudentUniversity::get();

        return view('connection.index');
    }
}
