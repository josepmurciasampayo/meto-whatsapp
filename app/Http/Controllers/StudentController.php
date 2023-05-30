<?php

namespace App\Http\Controllers;

use App\Enums\General\YesNo;
use App\Enums\Page;
use App\Enums\Student\Gender;
use App\Enums\Student\PhoneOwner;
use App\Enums\Student\QuestionType;
use App\Enums\User\Status;
use App\Mail\Submitted;
use App\Mail\InviteStudent;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\User;
use App\Services\AnswerService;
use App\Services\EquivalencyService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function getStarted(): View
    {
        return view('student.getStarted', [
            'owners' => PhoneOwner::descriptions(),
        ]);
    }

    public function transfer(): View
    {
        return view('student.transfer', [
            'genders' => Gender::descriptions(),
        ]);
    }

    public function edit(QuestionService $questionService): View
    {
        $student_id = Auth::user()->student_id();
        return view('student.edit-info', [
            'user' => Auth::user(),
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
            'owners' => PhoneOwner::descriptions(),
        ]);
    }

    public function renderView(QuestionType $questionType, Page $page, QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {

        $questions = $questionService->get($questionType);
        $responses = $responseService->getForQuestionArray($questions);;
        $answers = $answerService->getForQuestionArray($questions, Auth::user()->student_id());
        //Debugbar::info(print_r($questions, true));
        //Debugbar::info(print_r($answers, true));

        return view('student.form', [
            'questions' => $questions,
            'responses' => $responses,
            'answers' => $answers,
            'page' => $page,
        ]);
    }

    public function renderAcademicView(Page $page, int $curriculum, int $screen, QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        $questions = $questionService->getAcademic($curriculum, $screen);
        $responses = $responseService->getForQuestionArray($questions);
        $answers = $answerService->getForQuestionArray($questions, Auth::user()->student_id());
        return view('student.form', [
            'questions' => $questions,
            'responses' => $responses,
            'answers' => $answers,
            'page' => $page,
            'curriculum' => $curriculum,
            'screen' => $screen,
        ]);
    }

    public function demographic(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        return $this->renderView(QuestionType::DEMOGRAPHIC, Page::DEMO, $questionService, $responseService, $answerService);
    }

    public function highschool(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        return $this->renderView(QuestionType::HIGHSCHOOL, Page::HIGHSCHOOL, $questionService, $responseService, $answerService);
    }

    public function academics(int $screen, QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View|RedirectResponse
    {
        Auth::user()->reminder = YesNo::YES();
        Auth::user()->save();
        $curriculum = $questionService->getCurriculum(Auth::user());
        if (is_null($curriculum)) {
            return redirect(route('student.highschool'));
        }
        $screen = ($screen == 0) ? 1 : $screen;
        return $this->renderAcademicView(Page::ACADEMIC, $curriculum(), $screen, $questionService, $responseService, $answerService);
    }

    public function financial(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        Auth::user()->reminder = YesNo::YES();
        Auth::user()->save();
        return $this->renderView(QuestionType::FINANCIAL, Page::FINANCIAL, $questionService, $responseService, $answerService);
    }

    public function extracurricular(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        return $this->renderView(QuestionType::EXTRACURRICULAR, Page::EXTRA, $questionService, $responseService, $answerService);
    }

    public function university(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        return $this->renderView(QuestionType::UNIVERSITY, Page::UNIPLAN, $questionService, $responseService, $answerService);
    }

    public function testing(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        return $this->renderView(QuestionType::TESTING, Page::TESTING, $questionService, $responseService, $answerService);
    }

    public function general(QuestionService $questionService, ResponseService $responseService, AnswerService $answerService): View
    {
        return $this->renderView(QuestionType::GENERAL, Page::GENERAL, $questionService, $responseService, $answerService);
    }

    public function handle(Request $request, AnswerService $answerService, EquivalencyService $equivalencyService): RedirectResponse
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
            } else {
                Answer::where('question_id', $question->id)->where('student_id', Auth::user()->student_id())->delete();
            }

            if ($question->equivalency == YesNo::YES()) {
                $equivalencyService->update(Auth::user());
            }
        }

        $this->checkStudentCompleteAndEmail(Student::find(Auth::user()->student_id()));

        return redirect(FlowController::next($request));
    }

    public function checkStudentCompleteAndEmail(Student $student): void
    {
        if ($student->hasCompletedForm == YesNo::YES()) {
            return;
        }
        if ((new QuestionService())->getAllProgress($student->id)) {
            Mail::to($student->user)->send(new Submitted($student->user));
            $student->hasCompletedForm = YesNo::YES();
            $student->save();
        }
    }

    public function invite(Request $request): RedirectResponse
    {
        if ($request->input('inviteEmail')) {
            Mail::to($request->input('inviteEmail'))->send(new InviteStudent(Auth::user()));
        }
        return redirect(route('home'));
    }


    public function storeTransfer(Request $request): View
    {
        $request->validate([
            'first' => 'required',
            'last' => 'required',
            'email' => 'required|email',
        ]);

        $user = new User();

        $user->first = $request->input('first');
        $user->middle = $request->input('middle');
        $user->last = $request->input('last');
        $user->email = $request->input('email');
        $user->phone_country = $request->input('phone')['code'];
        $user->phone_local = $request->input('phone')['number'];
        $user->phone_array = json_encode($request->input('phone'));
        $user->phone_combined = $request->input('phone')['code'] . $request->input('phone')['number'];
        $user->interest = $request->input('interest');
        $user->role = \App\Enums\User\Role::STUDENT();
        $user->status = Status::INACTIVE();
        $user->password = bcrypt(Str::random(12));
        $user->save();

        return view('student.transferThankyou');
    }
}
