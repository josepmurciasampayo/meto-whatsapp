<?php

namespace App\Http\Controllers;

use App\Enums\General\MatchStudentInstitution;
use App\Jobs\SendConnectionApprovalMail;
use App\Jobs\SendConnectionDenialMail;
use App\Mail\Connections\ConnectionWasApproved;
use App\Mail\SendConnectionRequestToAdmin;
use App\Models\Student;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
            if (!$hasConnect && $value === 'connect') {
                $hasConnect = true;
            }
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

        $uniId = auth()->user()->getUni()->id;

        $decisions = [
            'connect' => [],
            'maybe' => [],
            'archive' => []
        ];

        $items = $request->all();
        foreach ($items as $key => $value) {
            if (str_starts_with($key, 'student_')) {
                $decisions[$value][] = trim($key, 'student_');
            }
        }

        $admin = 'abraham@meto-intl.org';
        $requestCount = 0;

        foreach ($decisions as $action => $studentIds) {
            foreach ($studentIds as $student_id) {
                // Create a new connection
                if ($action === 'connect') {
                    $this->createConnection($student_id, MatchStudentInstitution::REQUEST, $uniId, $items['application_link'], $items['upcoming_deadline'], $items['upcoming_webinar_events']);
                    $requestCount++;
                } else if ($action === 'maybe') {
                    $this->createConnection($student_id, MatchStudentInstitution::MAYBE, $uniId, $items['application_link'], $items['upcoming_deadline'], $items['upcoming_webinar_events']);
                } else if ($action === 'archive') {
                    $this->createConnection($student_id, MatchStudentInstitution::ARCHIVED, $uniId, $items['application_link'], $items['upcoming_deadline'], $items['upcoming_webinar_events']);
                }
            }
        }

        Mail::to($admin)->send(new SendConnectionRequestToAdmin($requestCount));

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
                    $this->createConnection(
                        $student->id,
                        MatchStudentInstitution::MAYBE,
                        $uniId,
                        null,
                        null,
                        null
                    );
                } else if ($action === 'archive') {
                    $this->createConnection(
                        $student->id,
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

    public function createConnection(int $student_id, MatchStudentInstitution $status, int $institutionId, string|null $link, string|null $deadline, string|null $events)
    {
        return Connection::create([
            'student_id' => $student_id,
            'institution_id' => $institutionId,
            'requester_id' => auth()->id(),
            'status' => $status(),
            'application_link' => $link,
            'deadline' => $deadline,
            'events' => $events,
        ]);
    }

    public function approveConnections(Collection $connections)
    {
        $minutesToAdd = 1;
        foreach ($connections as $connection) {
            $this->processApproval($connection, $minutesToAdd);
            $minutesToAdd += 1;
        }
    }

    public function approveConnection(int $id)
    {
        $connection = Connection::find($id);
        $this->processApproval($connection);
    }

    public function processApproval(Connection $connection, int $minutesToAdd = 1)
    {
        $connection->update([
            'status' => MatchStudentInstitution::ACCEPTED
        ]);

        $counselors = $connection->student?->user?->highSchool?->highSchool?->counselors;

        SendConnectionApprovalMail::dispatch($connection, $counselors)->delay(now()->addMinutes($minutesToAdd));
    }

    public function denyConnections(Collection $connections)
    {
        $connections = $connections->pluck('id');
        $minutesToAdd = 1;
        foreach (Connection::whereIn('id', $connections->toArray())->get() as $connection) {
            $this->processDenial($connection, $minutesToAdd);
            $minutesToAdd += 1;
        }
    }

    public function denyConnection(int $id)
    {
        $connection = Connection::find($id);
        $this->processDenial($connection);
    }

    public function processDenial(Connection $connection, $minutesToAdd = 1)
    {
        $connection->update([
            'status' => MatchStudentInstitution::DENIED
        ]);

        SendConnectionDenialMail::dispatch($connection)->delay(now()->addMinutes($minutesToAdd));
    }
}
