<?php

namespace App\Http\Controllers;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\User\Role;
use App\Helpers;
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
use App\Models\StudentDetailView;
use App\Models\StudentUniversity;
use App\Models\User;
use App\Models\ViewStudentDetail;
use App\Services\UniService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
        $uni->efc = Helpers::stripNonNumeric($request->input('efc'));
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
        return redirect(route('home'));
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
        $request->validate([
            'uniName' => [
                'bail', 'required', 'string',
                'max:100'
            ],

            'type' => [
                'bail', 'required', 'string',
                Rule::in(\App\Enums\Institution\Type::values())
            ],

            'connections' => [
                'bail', 'required', 'numeric'
            ],

            'first' => [
                'bail', 'required', 'string',
                'max:50'
            ],

            'last' => [
                'bail', 'required', 'string',
                'max:50'
            ],

            'title' => [
                'bail', 'required', 'string',
                'max:120'
            ],

            'email' => [
                'bail', 'required', 'email',
                'unique:users,email'
            ],

            'password' => [
                'bail', 'required', 'min:8'
            ]
        ]);

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
        $user->password = Hash::make($request->input('password'));
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
                $uni->undergrad_url = $request->input('undergrad_url');
                $uni->country = $request->input('country');
                $uni->state = $request->input('state');
                $uni->type = $request->input('type');
                $uni->efc = $request->input('efc');
                $uni->min_grade = $request->input('min_grade');
                $uni->min_grade_curriculum = $request->input('min_grade_curriculum');
                $uni->min_grade_equivalency = $request->input('min_grade_equivalency');
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

        $hasConnect = false;
        foreach ($request->all() as $key => $value) {
            if (!$hasConnect && $value === 'connect') $hasConnect = true;
        }

        if (!$hasConnect) {
            return $this->handleMaybeAndArchiveStudents($request);
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
                'max:1000'
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
                    $createdConnection = $this->createStudentInstitutionConnection($student, MatchStudentInstitution::REQUEST, $uniId, $items['application_link'], $items['upcoming_deadline'], $items['upcoming_webinar_events']);
                } else if ($action === 'maybe') {
                    $createdConnection = $this->createStudentInstitutionConnection($student, MatchStudentInstitution::MAYBE, $uniId, $items['application_link'], $items['upcoming_deadline'], $items['upcoming_webinar_events']);
                } else if ($action === 'archive') {
                    $createdConnection = $this->createStudentInstitutionConnection($student, MatchStudentInstitution::ARCHIVED, $uniId, $items['application_link'], $items['upcoming_deadline'], $items['upcoming_webinar_events']);
                }
                $createdConnections[] = $createdConnection;
            }
        }

        $createdConnections = array_filter($createdConnections, function ($connection) {
            return $connection->status === MatchStudentInstitution::REQUEST;
        });

        // Send a request email to the admin
        Mail::to($admin)->send(new SendConnectionRequestToAdmin($student, $createdConnections));

        return back()->with('response', 'Requests sent successfully.');
    }

    public function handleMaybeAndArchiveStudents($request)
    {
        $items = $request->all();

        $uniId = auth()->user()->getUni()->id;

        $decisions = [
            'maybe' => [],
            'archive' => []
        ];

        foreach ($items as $key => $value) {
            if (str_starts_with($key, 'student_')) {
                $decisions[$value][] = trim($key, 'student_');
            }
        }

        $admin = 'abraham@meto-intl.org';

        foreach ($decisions as $action => $studentIds) {
            foreach ($studentIds as $id) {
                $student = Student::find($id);
                // Create a new connection
                if ($action === 'maybe') {
                    $this->createStudentInstitutionConnection(
                        $student,
                        MatchStudentInstitution::MAYBE,
                        $uniId,
                        null,
                        null,
                        null
                    );
                } else if ($action === 'archive') {
                    $this->createStudentInstitutionConnection(
                        $student,
                        MatchStudentInstitution::ARCHIVED,
                        $uniId,
                        null,
                        null,
                        null
                    );
                }
            }
        }

        return true;
    }

    public function createStudentInstitutionConnection(Student $student, MatchStudentInstitution $status, int $institutionId, string|null $link, string|null $deadline, string|null $events)
    {
        return StudentUniversity::create([
            'student_id' => $student->id,
            'institution_id' => $institutionId,
            'requester_id' => auth()->id(),
            'status' => $status(),
            'application_link' => $link,
            'deadline' => $deadline,
            'events' => $events,
        ]);
    }

    public function fetchStudent(Request $request)
    {
        $data = ViewStudentDetail::with('student.user')
            ->where('student_id', $request->route('student'))
            ->first();
        $view = view('_partials.questions.card', [
            'uni' => auth()->user()->getUni(),
            'student' => $data
        ])->render();
        return response([
            'view' => $view,
            'data' => $data
        ]);
    }
}
