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

    public function renderView(QuestionType $questionType, Page $page, QuestionService $questionService) :View
    {
        $questions = $questionService->get($questionType);
        $responses = $questionService->responses($questions);
        $answers = $questionService->answers($questions);
        return view('student.form', [
            'questions' => $questions,
            'responses' => $responses,
            'answers' => $answers,
            'page' => $page,
        ]);
    }

    public function demographic(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::DEMOGRAPHIC, Page::DEMO, $questionService);
    }

    public function highschool(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::HIGHSCHOOL, Page::HIGHSCHOOL, $questionService);
    }

    public function academics(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::ACADEMIC, Page::ACADEMIC, $questionService);
    }

    public function financial(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::FINANCIAL, Page::FINANCIAL, $questionService);
    }

    public function extracurricular(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::EXTRACURRICULAR, Page::EXTRA, $questionService);
    }

    public function university(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::UNIVERSITY, Page::UNIPLAN, $questionService);
    }

    public function testing(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::TESTING, Page::TESTING, $questionService);
    }

    public function general(QuestionService $questionService): View
    {
        return $this->renderView(QuestionType::GENERAL, Page::GENERAL, $questionService);
    }

    public function handle(Request $request, AnswerService $answerService): RedirectResponse
    {
        $questionIDs = array();
        foreach ($request->all() as $index => $input) {
            if (is_numeric($index)) {
                $questionIDs[] = $index;
            }
        }
        $questions = Question::whereIn('id', $questionIDs)->get();
        foreach ($questions as $question) {
            if ($request->input($question->id)) {
                $answerService->store($question, $request->input($question->id));
            }
        }
        return redirect(FlowController::next($request));
    }
}
