<?php

namespace App\Http\Controllers;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\User\Role;
use App\Http\Requests\Uni\UniApplicationRequest;
use App\Http\Requests\Uni\UniEfcRequest;
use App\Http\Requests\Uni\UniLocationRequest;
use App\Mail\SendConnectionRequestToAdmin;
use App\Mail\UniInvite;
use App\Models\Institution;
use App\Models\Joins\UserHighSchool;
use App\Models\Joins\UserInstitution;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentUniversity;
use App\Models\User;
use App\Services\UniService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UniController extends Controller
{
    public function welcome(): View
    {
        return view('uni.welcome');
    }

    public function name(): View
    {
        return view('uni.name', [
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function nameStore(Request $request): RedirectResponse
    {
        $uni = Auth::user()->getUni();
        $uni->name = $request->input('name');
        $uni->save();

        return redirect(route('uni.homepage'));
    }

    public function homepage(): View
    {
        return view('uni.homepage',[
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function homepageStore(Request $request): RedirectResponse
    {
        $uni = Auth::user()->getUni();
        $uni->url = $request->input('url');
        $uni->save();

        return redirect(route('uni.application'));
    }

    public function application(): View
    {
        return view('uni.application', [
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function applicationStore(UniApplicationRequest $request): RedirectResponse
    {
        $uni = Auth::user()->getUni();
        $uni->undergrad_url = $request->input('url');
        $uni->save();

        return redirect(route('uni.location'));
    }

    public function location(): View
    {
        return view('uni.location', [
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function locationStore(UniLocationRequest $request): RedirectResponse
    {
        $uni = Auth::user()->getUni();
        $uni->country = $request->input('country');
        $uni->state = $request->input('state');
        $uni->city = $request->input('city');
        $uni->save();

        return redirect(route('uni.efc'));
    }

    public function efc(): View
    {
        return view('uni.efc', [
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function efcStore(UniEfcRequest $request): RedirectResponse
    {
        $uni = Auth::user()->getUni();
        $uni->efc = $request->input('efc');
        $uni->save();

        return redirect(route('uni.mingrade'));
    }

    public function mingrade(): View
    {
        return view('uni.mingrade', [
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function home(): View
    {
        return view('uni.homepage');
    }

    public function myProfile(): View
    {
        return view('uni.myProfile', [
            'uni' => Auth::user()->getUni(),
        ]);
    }

    public function myProfileStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }

    public function uniProfile(): View
    {
        return view('uni.uniProfile', [
            'user' => Auth::user(),
        ]);
    }

    public function uniProfileStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }

    public function connections(): View
    {
        return view('uni.connections');
    }

    public function newUser(): View
    {
        return view('newUser');
    }

    public function newUserStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }

    public function get(int $id): View
    {
        return view('admin.university', [
            'uni' => Institution::find($id),
            'users' => (new UniService())->getUsersForUni($id),
        ]);
    }

    public function create(): View
    {
        return view('admin.uni-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $uni = new Institution();
        $uni->name = $request->input('uniName');
        $uni->type = $request->input('type');
        $uni->efc = $request->input('efc');
        $uni->connections = $request->input('connections');
        $uni->save();

        $user = new User();
        $user->first = $request->input('first');
        $user->last = $request->input('last');
        $user->email = $request->input('email');
        $user->role = Role::INSTITUTION();
        $user->title = $request->input('title');
        $user->save();

        $join = new UserInstitution();
        $join->user_id = $user->id;
        $join->institution_id = $uni->id;
        $join->save();

        $user->sendWelcomeNotification(now()->addDays(3), $uni);

        return redirect(route('universities'));
    }

    public function update(Request $request): RedirectResponse
    {
        switch ($request->input('action')) {
            case 1: // simple store
                $uni = Institution::find($request->input('uni_id'));
                $uni->name = $request->input('uniName');
                $uni->type = $request->input('type');
                $uni->efc = $request->input('efc');
                $uni->min_grade = $request->input('min_grade');
                $uni->min_grade_curriculum = $request->input('min_grade_curriculum');
                $uni->connections = $request->input('connections');
                $uni->save();

                foreach ($request->input('user') as $user_id => $userData) {
                    $user = User::find($user_id);
                    $user->first = $userData['first'];
                    $user->last = $userData['last'];
                    $user->email = $userData['email'];
                    $user->title = $userData['title'];
                    $user->save();
                }

                break;

            case 3: // add user
                $user = new User();
                $user->first = $request->input('first');
                $user->last = $request->input('last');
                $user->email = $request->input('email');
                $user->title = $request->input('title');
                $user->role = Role::INSTITUTION();
                $user->save();

                $uni = Institution::find($request->input('uni_id'));
                $join = new UserInstitution();
                $join->user_id = $user->id;
                $join->institution_id = $uni->id;
                $join->save();

                break;

            case 4: // delete user
                User::destroy($request->input('userToDelete'));
                break;

        }
        return redirect(route('uni', ['id' => $request->input('uni_id')]));
    }

    public static function students(int $highschool_id)
    {
        $rawData = Student::getStudentsAtSchool($highschool_id);
        $data = "";

        foreach ($rawData as $key => $student) {
            $connection = StudentUniversity::where('student_id', $student['student_id'])->first();
            if ($connection && $connection->status === MatchStudentInstitution::ARCHIVED) {
                unset($rawData[$key]);
            }
        }

        foreach ($rawData as $row) {
            $data .= "[";
            foreach ($row as $value) {
                if (is_null($value)) {
                    $value = '';
                }
                $data .= "'" . htmlspecialchars($value) . "',";
            }
            $data .= "],";
        }

//        return $rawData;
    }

    public function decide(Request $request)
    {
        if (count($request->all()) === 1) {
            return redirect()->back();
        }

        $request->validate([
            'application_link' => [
                'bail', 'required', 'url'
            ],
            'upcoming_deadline' => [
                'bail', 'required', 'date',
                'after:now'
            ],
            'upcoming_webinar_events' => [
                'bail', 'nullable', 'string',
                'max:200'
            ]
        ]);

        $items = $request->all();

        $uniId = auth()->user()->getUni()->id;

        $decisions = [
            'connect' => [],
            'maybe' => [],
            'archive' => []
        ];

        foreach ($items as $key => $value) {
            if (str_starts_with($key, 'student_')) {
                $decisions[$value][] = trim($key, 'student_');
            }
        }

        $admin = 'abraham@meto-intl.org';
        $createdConnections = [];

        foreach ($decisions as $action => $studentIds) {
            foreach ($studentIds as $id) {
                $student = Student::find($id);
                // Create a new connection
                if ($action === 'connect') {
                    $createdConnection = $this->createConnection($student, MatchStudentInstitution::REQUEST, $uniId);
                } else if ($action === 'maybe') {
                    $createdConnection = $this->createConnection($student, MatchStudentInstitution::MAYBE, $uniId);
                } else if ($action === 'archive') {
                    $createdConnection = $this->createConnection($student, MatchStudentInstitution::ARCHIVED, $uniId);
                }
                $createdConnections[] = $createdConnection;
            }
        }

        $createdConnections = array_filter($createdConnections, function ($connection) {
            return $connection->status->value === MatchStudentInstitution::REQUEST->value;
        });

        // Send a request email to the admin
        Mail::to($admin)->send(new SendConnectionRequestToAdmin($student, $createdConnections));

        return back()->with('response', 'Changes were made successfully.');
    }

    public function createConnection($student, $status, $institutionId)
    {
        return StudentUniversity::create([
            'student_id' => $student->id,
            'institution_id' => $institutionId,
            'status' => $status
        ]);
    }

    public function fetchStudent(Request $request, Student $student)
    {
        $student->age = Carbon::parse($student->dob)->diffInYears();
        $questionIds = [119, 164, 102, 104, 281, 271, 275, 120, 63, 2, 69, 72, 67, 73, 70, 14, 267, 257, 99, 114, 292, 285, 308];
        $answers = \App\Models\Answer::where('student_id', $student->id)->whereIn('question_id', $questionIds)->get();

        foreach ($answers as $answer) {
            $question = Question::find($answer->question_id);
            $answer->question = $question;
        }

        return response([
            'student' => $student,
            'user' => User::find($student->user_id),
            'qas' => $answers
        ]);
    }
}
