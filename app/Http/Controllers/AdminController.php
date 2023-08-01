<?php

namespace App\Http\Controllers;

use App\Enums\EnumGroup;
use App\Enums\General\MatchStudentInstitution;
use App\Helpers;
use App\Jobs\SendConnectionApprovalMail;
use App\Jobs\SendConnectionDenialMail;
use App\Models\Chat\MessageState;
use App\Models\LogComms;
use App\Models\LoginEvents;
use App\Models\ResponseBranch;
use App\Models\Connection;
use App\Models\Question;
use App\Models\Student;
use App\Services\UniService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.home');
    }

    public function info(): View
    {
        return view('admin.info');
    }

    public function commsLog(): View
    {
        $data = LogComms::getAdminData();
        $state = MessageState::getState();
        return view('admin.whatsapp', [
            'data' => $data,
            'state' => $state,
        ]);
    }

    public function universities(): View
    {
        $data = (new UniService())->getAdminData();
        return view('admin.universities', ['data' => $data]);
    }

    public function workRequest(): View
    {
        return view('admin.workRequest');
    }

    public function reports(): View
    {
        return view('admin.reports');
    }

    public function logins(): View
    {
        $lastLogins = LoginEvents::getLatestLogins();
        $data = LoginEvents::getAdminData();
        return view('admin.logins', [
            'lastLogins' => $lastLogins,
            'data' => $data,
        ]);
    }

    public function matchData(): View
    {
        $data = Helpers::dbQueryArray('
            select
                m.id as match_id,
                m.student_id,
                institution_id,
                m.status as status_code,
                enum_desc as match_status,
                m.created_at as match_date,
                u.first,
                u.last,
                i.name,
                a.text as "school"
            from meto_connections as m
            join meto_students as s on student_id = s.id
            join meto_users as u on s.user_id = u.id
            join meto_institutions as i on institution_id = i.id
            join meto_enum as match_status on match_status.group_id = ' . EnumGroup::GENERAL_MATCH() . ' and m.status = enum_id
            left outer join meto_answers as a on a.student_id = s.id and a.question_id = 118;
        ');
        return view('admin.match-data', ['data' => $data]);
    }

    public function sendMessage(Request $request): RedirectResponse
    {
        $request = $request->toArray();
        ChatbotController::sendWhatsAppMessage($request['to-phone'], $request['body']);
        return redirect('comms-log');
    }

    public function startChatbot(): View
    {
        ChatbotController::startLoop();
        return self::commsLog();
    }

    public function resetChatbot(): View
    {
        ChatbotController::reset();
        return self::commsLog();
    }

    public function matches(int $student_id): View
    {
        $matches = Connection::getByUserID($student_id);
        return view('admin.match-data', ['data' => $matches]);
    }

    public function answers(int $question_id): View
    {
        $data = Helpers::dbQueryArray('
            select
                   a.id,
                   question_id,
                   text,
                   concat(u.first, " ", u.last) as "name",
                   u.id as "user_id",
                   s.id as "student_id"
            from meto_answers as a
            join meto_students as s on a.student_id = s.id
            join meto_users as u on u.id = s.user_id
            where question_id = '. $question_id . ';
        ');
        return view('admin.answers', [
            'data' => $data,
            'question' => Question::find($question_id),
        ]);
    }

    public function commands(): View
    {
        return view('admin.commands');
    }

    public function command() :View
    {
        Artisan::call('chat:vanderbilt');
        return view('admin.commands');
    }

    public function databases() :View
    {
        $google_db = (App::environment('prod')) ? 'google-prod' : 'google-local';

        $unis = DB::connection($google_db)->select('select count(*) as c from university_info')[0]->c;
        $unis_other = DB::connection($google_db)->select('select count(*) as c from non_uni_inst_info')[0]->c;
        $unis_imported = DB::connection($google_db)->select('select count(*) as c from institutions_table where imported = 1')[0]->c;
        $unis_other_imported = DB::connection($google_db)->select('select count(*) as c from non_uni_inst_info where imported = 1')[0]->c;

        $hs = DB::connection($google_db)->select('select count(*) as c from counselors_table')[0]->c;
        $hs_answer = DB::connection($google_db)->select('select count(distinct response) as c from answers_table where question_id in (2, 165, 517, 343, 435, 233)')[0]->c;

        return view('admin.databases', [
            'student_local' => DB::select('select count(*) as c from meto_students')[0]->c,
            'student_google' => DB::connection($google_db)->select('select count(*) as c from students_table')[0]->c,
            'student_imported' => DB::connection($google_db)->select('select count(*) as c from students_table where imported = 1')[0]->c,

            'uni_local' => DB::select('select count(*) as c from meto_institutions')[0]->c,
            'uni_google' => $unis + $unis_other,
            'uni_imported' => $unis_imported + $unis_other_imported,

            'hs_local' => DB::select('select count(*) as c from meto_high_schools')[0]->c,
            'hs_google' => $hs + $hs_answer,

            'match_local' => DB::select('select count(*) as c from meto_connections')[0]->c,
            'match_google' => DB::connection($google_db)->select('select count(*) as c from inst_student_relationships')[0]->c,
            'match_imported' => DB::connection($google_db)->select('select count(*) as c from inst_student_relationships where imported = 1')[0]->c,

            'question_local' => DB::select('select count(*) as c from meto_questions')[0]->c,
            'question_google' => DB::connection($google_db)->select('select count(distinct question_content) as c from questions_table')[0]->c,

            'answer_local' => DB::select('select count(*) as c from meto_answers')[0]->c,
            'answer_google' => DB::connection($google_db)->select('select count(*) as c from answers_table')[0]->c,
            'answer_imported' => DB::connection($google_db)->select('select count(*) as c from answers_table where imported = 1')[0]->c,
        ]);
    }

    public function deleteStudent(Student $student)
    {
        $user = $student->user;

        DB::transaction(function () use ($student, $user) {
            $student?->answers()->delete();

            $user?->contactForms()->delete();

            $user?->metoFiles()->delete();

            $this->deleteStudentCommunications($student);

            $user?->loginEvents()->delete();

            $user?->messageStates()->delete();

            $student?->connections()->delete();

            $user?->userForms()->delete();

            $user?->highSchool()->delete();

            $student?->delete();

            $user->delete();
        });

        return redirect()
            ->to('/admin/students')
            ->with('response', 'Student data was deleted successfully!');
    }

    public function deleteStudentCommunications($student)
    {
        $phone = $student->user->phone_combined;

        LogComms::query()
            ->where('from', $phone)
            ->orWhere('to', $phone)
            ->delete();
    }
}
