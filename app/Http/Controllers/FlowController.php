<?php

namespace App\Http\Controllers;

use App\Enums\Page;
use Illuminate\Http\Request;

class FlowController extends Controller
{
    public static function next(Request $request) :string
    {
        $flow = [
            Page::GETSTARTED() => route(''),
        ];
        if (isset($flow[$request->input('page')])) {
            return $flow[$request->input('page')];
        }
        return route('student.home');
    }
}
