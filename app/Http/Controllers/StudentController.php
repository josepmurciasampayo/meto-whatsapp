<?php

namespace App\Http\Controllers;

use App\Enums\Page;
use App\Enums\Student\QuestionType;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function getStarted() :View
    {
        return view('student.getStarted');
    }

    public function transfer() :View
    {
        return view('student.transfer');
    }

    public function home() :View
    {
        return view('student.home');
    }

    public function prep(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::),
            'page' => Page::DEMO(),
        ]);
    }

    public function demographic(QuestionService $questionService) :View
    {
        $questions = Question::where('')->get();
        return view('', [
            'questions' => $questionService->get(QuestionType::DEMOGRAPHIC),
            'page' => Page::DEMO(),
        ]);
    }

    public function highschool(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::),
            'page' => Page::DEMO(),
        ]);
    }

    public function academics(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::ACADEMIC),
            'page' => Page::DEMO(),
        ]);
    }

    public function financial(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::FINANCIAL),
            'page' => Page::DEMO(),
        ]);
    }

    public function extracurricular(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::EXTRACURRICULAR),
            'page' => Page::DEMO(),
        ]);
    }

    public function university(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::UNIVERSITY),
            'page' => Page::DEMO(),
        ]);
    }

    public function testing(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::TESTING),
            'page' => Page::DEMO(),
        ]);
    }

    public function general(QuestionService $questionService) :View
    {
        return view('student.form', [
            'questions' => $questionService->get(QuestionType::GENERAL),
            'page' => Page::GENERAL,
        ]);
    }

    public function hande(Request $request) :RedirectResponse
    {
        return redirect(FlowController::next($request));
    }
}
