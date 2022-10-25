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
use Illuminate\Support\Facades\DB;
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

    public function databases() :View
    {
        $unis = DB::connection('google-prod')->select('select count(*) as c from university_info')[0]->c;
        $unis_other = DB::connection('google-prod')->select('select count(*) as c from non_uni_inst_info')[0]->c;
        $unis_imported = DB::connection('google-prod')->select('select count(*) as c from university_info where imported = 1')[0]->c;
        $unis_other_imported = DB::connection('google-prod')->select('select count(*) as c from non_uni_inst_info where imported = 1')[0]->c;

        $hs = DB::connection('google-prod')->select('select count(*) as c from counselors_table')[0]->c;
        $hs_answer = DB::connection('google-prod')->select('select count(distinct response) as c from answers_table where question_id in (2, 165, 517, 343, 435, 233)')[0]->c;

        return view('admin.databases', [
            'student_local' => DB::select('select count(*) as c from meto_students')[0]->c,
            'student_google' => DB::connection('google-prod')->select('select count(*) as c from students_table')[0]->c,
            'student_imported' => DB::connection('google-prod')->select('select count(*) as c from students_table where imported = 1')[0]->c,

            'uni_local' => DB::select('select count(*) as c from meto_institutions')[0]->c,
            'uni_google' => $unis + $unis_other,
            'uni_imported' => $unis_imported + $unis_other_imported,

            'hs_local' => DB::select('select count(*) as c from meto_high_schools')[0]->c,
            'hs_google' => $hs + $hs_answer,
            'hs_imported' => '-',

            'match_local' => DB::select('select count(*) as c from meto_student_universities')[0]->c,
            'match_google' => DB::connection('google-prod')->select('select count(*) as c from inst_student_relationships')[0]->c,
            'match_imported' => DB::connection('google-prod')->select('select count(*) as c from inst_student_relationships where imported = 1')[0]->c,

            'answer_local' => DB::select('select count(*) as c from meto_answers')[0]->c,
            'answer_google' => DB::connection('google-prod')->select('select count(*) as c from answers_table')[0]->c,
            'answer_imported' => DB::connection('google-prod')->select('select count(*) as c from answers_table where imported = 1')[0]->c,
        ]);
    }
}
