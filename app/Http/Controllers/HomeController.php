<?php

namespace App\Http\Controllers;

use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Services\UniService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HomeController extends Controller
{
    //
    public function index(): RedirectResponse|View
    {
        $user = Auth()->user();
        if (is_null($user)) {
            return redirect('login');
        }

        if ($user->isAdmin()) {
            return view('admin.home');
        }

        if (!$user->consent()) {
            return redirect('consent');
        }

        if ($user->isCounselor()) {
            $school = HighSchool::getByCounselorID(Auth()->user()->id);
            $summaryCounts = HighSchool::getSummaryCounts($school->id);
            $notes = UserHighSchool::getNotes(Auth()->user()->id);
            return view('counselor.home', [
                'school' => $school,
                'summaryCounts' => $summaryCounts,
                'notes' => $notes,
            ]);
        }

        if ($user->isInstitution()) {
            $uni = Auth::user()->getUni();
            if (is_null($uni->min_grade_equivalency)) {
                return redirect(route('uni.welcome'));
            }
            //$rawData = UniService::getStudentTableData($uni->id);
            return view('uni.students', [
                //'data' => $rawData,
                'user' => $user,
                'uni' => $uni
            ]);
        }

        if ($user->isStudent()) {
            return view('student.home', [
                'user' => Auth::user(),
            ]);
        }

        Log::error("Home Controller with no home found");
    }
}
