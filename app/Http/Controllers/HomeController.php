<?php

namespace App\Http\Controllers;

use App\Enums\Student\QuestionType;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\Student;
use App\Models\ViewStudentDetail;
use App\Services\QuestionService;
use App\Services\UniService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HomeController extends Controller
{
    //
    public function index(QuestionService $questionService): RedirectResponse|View
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

        $user = Auth::user();

        if ($user->isInstitution()) {
            $uni = $user->getUni();
            if (is_null($uni->min_grade_equivalency)) {
                return redirect(route('uni.welcome'));
            }

            return view('uni.students', [
                'uni' => $uni,
                'user' => $user
            ]);
        }

        if ($user->isStudent()) {
            $student_id = Auth::user()->student_id();
            return view('student.home', [
                'user' => $user,
                'profileProgress' => 0,
                'demoProgress' => $questionService->getProgress(QuestionType::DEMOGRAPHIC, $student_id),
                'hsProgress' => $questionService->getProgress(QuestionType::HIGHSCHOOL, $student_id),
                'academicProgress' => 0,
                'financialProgress' => $questionService->getProgress(QuestionType::FINANCIAL, $student_id),
                'extraProgress' => $questionService->getProgress(QuestionType::EXTRACURRICULAR, $student_id),
                'uniProgress' => $questionService->getProgress(QuestionType::UNIVERSITY, $student_id),
                'testingProgress' => $questionService->getProgress(QuestionType::TESTING, $student_id),
                'generalProgress' => $questionService->getProgress(QuestionType::GENERAL, $student_id),
            ]);
        }

        Log::error("Home Controller with no home found");
    }
}
