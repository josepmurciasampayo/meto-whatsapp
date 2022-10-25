<?php

namespace App\Http\Controllers;

use App\Models\HighSchool;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    //
    public function index()
    {
        $user = Auth()->user();
        if (is_null($user)) {
            return redirect('login');
        }
        if ($user->isAdmin()) {
            return view('admin.home');
        }
        if (!$user->terms) {
            return redirect('terms');
        }
        if ($user->isCounselor()) {
            $c = new CounselorController();
            return $c->home();
        }
        if ($user->isInstitution()) {
            return view('institution.home');
        }
        if ($user->isStudent()) {
            return view('student.home');
        }
        Log::error("Home Controller with no home found");

    }
}
