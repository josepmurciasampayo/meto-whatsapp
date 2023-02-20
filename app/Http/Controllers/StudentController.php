<?php

namespace App\Http\Controllers;

use App\Enums\Page;
use App\Enums\Student\QuestionType;
use App\Models\Question;
use App\Models\User;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function getStarted(): View
    {
        return view('student.getStarted');
    }

    public function transfer(): View
    {
        return view('student.transfer');
    }

    public function home(): View
    {
        return view('student.home');
    }

    public function edit(): View
    {
        return view('student.edit-info');
    }

    public function intro(): View
    {
        return view('student.intro');
    }

    public function profile(): View
    {
        return view('student.profile', [
            'user' => new User(),
            'countries' => [],
        ]);
    }

    public function demographic(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::DEMOGRAPHIC),
            'page' => Page::DEMO,
        ]);
    }

    public function highschool(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::HIGHSCHOOL),
            'page' => Page::HIGHSCHOOL,
        ]);
    }

    public function academics(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::ACADEMIC),
            'page' => Page::ACADEMIC,
        ]);
    }

    public function financial(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::FINANCIAL),
            'page' => Page::FINANCIAL,
        ]);
    }

    public function extracurricular(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::EXTRACURRICULAR),
            'page' => Page::EXTRA,
        ]);
    }

    public function university(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::UNIVERSITY),
            'page' => Page::UNIPLAN,
        ]);
    }

    public function testing(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::TESTING),
            'page' => Page::TESTING,
        ]);
    }

    public function general(QuestionService $questionService): View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::GENERAL),
            'page' => Page::GENERAL,
        ]);
    }

    public function handle(Request $request, AnswerService $answerService): RedirectResponse
    {
        $answerService->store($request);
        return redirect(FlowController::next($request));
    }
}
