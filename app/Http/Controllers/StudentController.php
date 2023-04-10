<?php

namespace App\Http\Controllers;

use App\Enums\General\YesNo;
use App\Enums\Page;
use App\Enums\Student\QuestionType;
use App\Mail\InviteStudent;
use App\Models\Question;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'profileProgress' => 0,
            'demoProgress' => $questionService->getProgress(QuestionType::DEMOGRAPHIC),
            'hsProgress' => $questionService->getProgress(QuestionType::HIGHSCHOOL),
            'academicProgress' => 0,
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

    public function academics(int $screen, QuestionService $questionService): View|RedirectResponse
    {
        Auth::user()->reminder = YesNo::YES();
        Auth::user()->save();
        $curriculum = $questionService->getCurriculum(Auth::user());
        if (is_null($curriculum)) {
            return redirect(route('student.highschool'));
        }
        $screen = ($screen == 0) ? 1 : $screen;
        return $this->renderAcademicView( Page::ACADEMIC, $curriculum(), $screen, $questionService);
    }

    public function financial(QuestionService $questionService): View
    {
        Auth::user()->reminder = YesNo::YES();
        Auth::user()->save();
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

    public function invite(Request $request) :RedirectResponse
    {
        Mail::to($request->input('inviteEmail'))->send(new InviteStudent(Auth::user()));
        return redirect(route('home'));
    }
}
