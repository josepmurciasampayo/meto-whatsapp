<?php

namespace App\Http\Controllers;

use App\Enums\General\MatchStudentInstitution;
use App\Jobs\SendConnectionApprovalMail;
use App\Jobs\SendConnectionDenialMail;
use App\Mail\SendConnectionRequestToAdmin;
use App\Models\Student;
use App\Models\StudentUniversity;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ConnectionController extends Controller
{
    public function index(): View
    {
        //$connections = StudentUniversity::get();

        return view('connection.index');
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

    protected function handleMaybeAndArchiveStudents(Request $request)
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

    public function approveConnection($connections)
    {
        if ($connections instanceof Collection) {
            $minutesToAdd = 1;
            foreach (StudentUniversity::whereIn('id', $connections->toArray())->get() as $connection) {
                $this->processApproval($connection, $minutesToAdd);
                $minutesToAdd += 1;
            }
        } else {
            $connection = StudentUniversity::find($connections);
            $this->processApproval($connection);
        }
    }

    public function processApproval($connection, $minutesToAdd = 1)
    {
        $connection->update([
            'status' => MatchStudentInstitution::ACCEPTED
        ]);

        SendConnectionApprovalMail::dispatch($connection)->delay(now()->addMinutes($minutesToAdd));
    }

    public function denyConnection($connections)
    {
        if ($connections instanceof Collection) {
            $connections = $connections->pluck('id');
            $minutesToAdd = 1;
            foreach (StudentUniversity::whereIn('id', $connections->toArray())->get() as $connection) {
                $this->processDenial($connection, $minutesToAdd);
                $minutesToAdd += 1;
            }
        } else {
            $connection = StudentUniversity::find($connections);
            $this->processDenial($connection);
        }
    }

    public function processDenial($connection, $minutesToAdd = 1)
    {
        $connection->update([
            'status' => MatchStudentInstitution::DENIED
        ]);

        SendConnectionDenialMail::dispatch($connection)
            ->delay(now()->addMinutes($minutesToAdd));
    }
}
