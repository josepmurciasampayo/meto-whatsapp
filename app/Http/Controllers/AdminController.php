<?php

namespace App\Http\Controllers;

use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Enums\Student\Curriculum;
use App\Enums\Student\QuestionType;
use App\Helpers;
use App\Models\Chat\MessageState;
use App\Models\HighSchool;
use App\Models\Institution;
use App\Models\LogComms;
use App\Models\LoginEvents;
use App\Models\QuestionScreen;
use App\Models\Response;
use App\Models\ResponseBranch;
use App\Models\StudentUniversity;
use App\Models\Question;
use App\Models\Student;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $data = Institution::getAdminData();
        return view('admin.universities', ['data' => $data]);
    }

    public function students(int $highschool_id = null) :View
    {
        if ($highschool_id) {
            $data = Student::getStudentsAtSchool($highschool_id);
        } else {
            $data = Student::getAdminData();
        }
        return view('admin.students', ['data' => $data]);
    }

    public function workRequest(): View
    {
        return view('admin.workRequest');
    }

    public function reports(): View
    {
        return view('admin.reports');
    }

    public function highschools(): View
    {
        $data = HighSchool::getAdminData();
        return view('admin.highschools', ['data' => $data]);
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
        $data = StudentUniversity::getMatchData();
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
        $matches = StudentUniversity::getByUserID($student_id);
        return view('admin.match-data', ['data' => $matches]);
    }

    public function questions(): View
    {
        $data = Question::getAdminData();
        return view('admin.questions', [
            'data' => $data,
        ]);
    }

    public function question(int $id = null) :View
    {
        $question = ($id) ? Question::find($id) : new Question();
        $responses = ($id) ? Response::where('question_id', $id)->get() : null;
        $screens = ($question->type == QuestionType::ACADEMIC()) ? QuestionScreen::get($id) : null;
        $branches = ($question->type == QuestionType::ACADEMIC()) ? ResponseBranch::get($id) : null;

        return view('admin.question', [
            'question' => $question,
            'responses' => $responses,
            'screens' => $screens,
            'branches' => $branches,
        ]);
    }

    public function questionStore(Request $request, QuestionService $questionService) :RedirectResponse
    {
        $question = $questionService->store($request);
        return redirect(route('question', ['id' => $question->id]));
    }

    public function curricula() :View
    {
        return view('admin.curricula', [
            'curricula' => Curriculum::descriptions(),
        ]);
    }

    public function curriculum(int $curriculum, QuestionService $questionService) :View
    {
        $questions = $screens = array(); // arrays to be filled and sent to the view

        $q = $questionService->getAcademic($curriculum); // get all questions for curriculum and fill in text, format
        foreach ($q as $id => $question) {
            $questions[$id]['text'] = $question['text'];
            $questions[$id]['format'] = QuestionFormat::descriptions()[$question['format']];
        }

        $s = QuestionScreen::where('curriculum', $curriculum)->get(); // get all

        foreach ($s as $screen) {
            $questions[$screen->question_id]['screen'] = $screen->screen;
            $questions[$screen->question_id]['order'] = $screen->order;
            $questions[$screen->question_id]['destination'] = $screen->destination_screen ?? false;

            $screens[$screen->screen] = ($screen->branch == YesNo::YES()) || $screen->destination_screen || (isset($screens[$screen->screen]) && $screens[$screen->screen]);

            $b = ResponseBranch::where('curriculum', $curriculum)->where('question_id', $screen->question_id)->get();
            if (count($b) > 0) {
                $questions[$screen->question_id]['branch'] = array();
                foreach ($b as $branch) {
                    $questions[$branch->question_id]['branch'][] = $branch->to_screen;
                }
                $branches = array_unique($questions[$branch->question_id]['branch']);
                $questions[$branch->question_id]['branch'] = implode(',', $branches);
            } else {
                $questions[$screen->question_id]['branch'] = null;
            }
        }

        return view('admin.curriculum', [
            'questions' => $questions,
            'screens' => $screens,
            'curriculum' => Curriculum::descriptions()[$curriculum],
        ]);
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

    public function mergeHS(Request $request) :View
    {
        $IDs = explode(",", $request->input('IDs'));
        $highschools = array();
        foreach ($IDs as $id) {
            $highschools[] = HighSchool::find($id);
        }

        return view('admin.highschools-merge', [
            'IDs' => $request->input('IDs'),
            'data' => $highschools,
        ]);
    }

    public function mergeHSconfirm(Request $request) :RedirectResponse
    {
        $oldIDs = $request->input('IDs');
        $IDarray = explode(",", $oldIDs);

        if ($request->input('primary') == '') {
            $primaryID = $IDarray[0];
        } else {
            $primaryID = $request->input('primary');
        }

        $highschools = array();
        foreach ($IDarray as $id) {
            $highschools[] = HighSchool::find($id);
            if ($id == $primaryID) {
                $new = HighSchool::find($id)->replicate();
            }
        }

        $new->save();

        Helpers::dbUpdate('
            update meto_user_high_schools set highschool_id = ' . $new->id . ' where highschool_id in (' . $oldIDs . ');
        ');

        Helpers::dbUpdate('
            delete from meto_high_schools where id in (' . $oldIDs . ');
        ');

        return redirect(route('highschool', [
            'highschool_id' => $new->id,
        ]));
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

            'match_local' => DB::select('select count(*) as c from meto_student_universities')[0]->c,
            'match_google' => DB::connection($google_db)->select('select count(*) as c from inst_student_relationships')[0]->c,
            'match_imported' => DB::connection($google_db)->select('select count(*) as c from inst_student_relationships where imported = 1')[0]->c,

            'question_local' => DB::select('select count(*) as c from meto_questions')[0]->c,
            'question_google' => DB::connection($google_db)->select('select count(distinct question_content) as c from questions_table')[0]->c,

            'answer_local' => DB::select('select count(*) as c from meto_answers')[0]->c,
            'answer_google' => DB::connection($google_db)->select('select count(*) as c from answers_table')[0]->c,
            'answer_imported' => DB::connection($google_db)->select('select count(*) as c from answers_table where imported = 1')[0]->c,
        ]);
    }
}
