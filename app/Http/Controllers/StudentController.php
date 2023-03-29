<?php

namespace App\Http\Controllers;

use App\Enums\Page;
use App\Enums\Student\Curriculum;
use App\Enums\Student\QuestionType;
use App\Models\Question;
use App\Models\QuestionScreen;
use App\Models\User;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function edit(QuestionService $questionService): View
    {
        return view('student.edit-info', [
            'user' => Auth::user(),
            'profileProgress' => $questionService->getProgress(),
            'demoProgress' => $questionService->getProgress(QuestionType::DEMOGRAPHIC),
            'hsProgress' => $questionService->getProgress(QuestionType::HIGHSCHOOL),
            'academicProgress' => $questionService->getProgress(QuestionType::ACADEMIC),
            'financialProgress' => $questionService->getProgress(QuestionType::FINANCIAL),
            'extraProgress' => $questionService->getProgress(QuestionType::EXTRACURRICULAR),
            'uniProgress' => $questionService->getProgress(QuestionType::UNIVERSITY),
            'testingProgress' => $questionService->getProgress(QuestionType::TESTING),
            'generalProgress' => $questionService->getProgress(QuestionType::GENERAL),
        ]);
    }

    public function intro(): View
    {
        return view('student.intro', [
            'user' => Auth::user(),
        ]);
    }

    public function profile(): View
    {
        return view('student.profile', [
            'user' => Auth::user(),
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
            'curricula' => Curriculum::descriptions(),
        ]);
    }

    public function renderAcademicView(Page $page, int $curriculum, int $screen, QuestionService $questionService) :View
    {
        $questions = $questionService->getAcademic($curriculum, $screen);
        $responses = $questionService->responses($questions);
        $answers = $questionService->answers($questions);
        return view('student.form', [
            'questions' => $questions,
            'responses' => $responses,
            'answers' => $answers,
            'page' => $page,
            'curriculum' => $curriculum,
            'screen' => $screen,
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

    public function academics(int $screen = 0, int $curriculum = 0): View
    {
        if ($curriculum == 0) {
            $questionService = new QuestionService();
            $curriculum = $questionService->getCurriculum(Auth::user());
            $screen = 1;
        }

        return $this->renderAcademicView( Page::ACADEMIC, $curriculum, $screen, $questionService);
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
