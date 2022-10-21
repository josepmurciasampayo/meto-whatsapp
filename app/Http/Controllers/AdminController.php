<?php

namespace App\Http\Controllers;

use App\Enums\Student\Curriculum;
use App\Models\Answer;
use App\Models\Chat\MessageState;
use App\Models\HighSchool;
use App\Models\Institution;
use App\Models\LogComms;
use App\Models\LoginEvents;
use App\Models\StudentUniversity;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index() :View
    {
        return view('admin.home');
    }

    public function info() :View
    {
        return view('admin.info');
    }

    public function commsLog() :View
    {
        $data = LogComms::getAdminData();
        $state = MessageState::getState();
        return view('admin.whatsapp', [
            'data' => $data,
            'state' => $state,
            ]);
    }

    public function universities() :View
    {
        $data = Institution::getAdminData();
        return view('admin.universities', ['data' => $data]);
    }

    public function students() :View
    {
        $data = Student::getAdminData();
        return view('admin.students', ['data' => $data]);
    }

    public function highschools() :View
    {
        $data = HighSchool::getAdminData();
        return view('admin.highschools', ['data' => $data]);
    }

    public function logins() :View
    {
        $lastLogins = LoginEvents::getLatestLogins();
        $data = LoginEvents::getAdminData();
        return view('admin.logins', [
            'lastLogins' => $lastLogins,
            'data' => $data,
        ]);
    }

    public function matchData() :View
    {
        $data = StudentUniversity::getMatchData();
        return view('admin.match-data', ['data' => $data]);
    }

    public function sendMessage(Request $request) :RedirectResponse
    {
        $request = $request->toArray();
        ChatbotController::sendWhatsAppMessage($request['to-phone'], $request['body']);
        return redirect('comms-log');
    }

    public function startChatbot() :View
    {
        ChatbotController::startLoop();
        return self::commsLog();
    }

    public function resetChatbot() :View
    {
        ChatbotController::reset();
        return self::commsLog();
    }

    public function matches(int $student_id) :View
    {
        $matches = StudentUniversity::getByUserID();
        return view('', ['data' => $matches]);
    }

    public function questions() :View
    {
        $data = Question::getAdminData();
        return view('admin.questions', [
            'data' => $data,
            ]);
    }

    public function answers(int $question_id) :View
    {
        $data = Answer::getByQuestionID($question_id);
        return view('admin.answers', [
            'data' => $data,
            'question' => Question::find($question_id),
        ]);
    }
}
