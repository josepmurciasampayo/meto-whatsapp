<?php

namespace App\Http\Controllers;

use App\Enums\General\ConnectionStatus;
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
        return view('connection.index', [
            'connections' => Connection::with('student', 'institution')
                ->where('status', ConnectionStatus::REQUEST())
                ->orderBy('institution_id')
                ->get()
        ]);
    }

    public function requests(): View
    {
        return view('connection.requests');
    }

    public function decide(Request $request)
    {
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

        if (count($decisions['connect']) > 0) {
            $request->validate([
                'application_link' => [
                    'bail', 'required', 'url'
                ],
                'upcoming_deadline' => [
                    'bail', 'required', 'date',
                    'after:now'
                ],
                'cc_emails' => [
                    'bail', 'nullable', 'array'
                ],
                'cc_emails.*' => [
                    'email'
                ]
            ], [
                'cc_emails.*' => 'CC emails are not valid.'
            ]);
        }

        $uniId = auth()->user()->getUni()->id;

        $admin = 'abraham@meto-intl.org';
        $requestCount = 0;

        foreach ($decisions as $action => $studentIds) {
            foreach ($studentIds as $student_id) {
                // Create a new connection
                if ($action === 'connect') {
                    $this->createConnection($student_id, ConnectionStatus::REQUEST, $uniId, $items['application_link'], $items['upcoming_deadline'], ccEmails: $request->get('cc_emails'));
                    $requestCount++;
                } else if ($action === 'maybe') {
                    $this->createConnection($student_id, ConnectionStatus::MAYBE, $uniId, ccEmails: $request->get('cc_emails'));
                } else if ($action === 'archive') {
                    $this->createConnection($student_id, ConnectionStatus::ARCHIVED, $uniId, ccEmails: $request->get('cc_emails'));
                }
            }
        }

        Mail::to($admin)->send(new SendConnectionRequestToAdmin($requestCount));

        return back()->with('response', 'Requests sent successfully.');
    }

    public function createConnection(int $student_id, ConnectionStatus $status, int $institutionId, string $link = null, string $deadline = null, string $events = null, $ccEmails = [])
    {
        return Connection::create([
            'student_id' => $student_id,
            'institution_id' => $institutionId,
            'requester_id' => auth()->id(),
            'status' => $status(),
            'application_link' => $link,
            'deadline' => $deadline,
            'events' => $events,
            'cc_emails' => implode(',', $ccEmails ?? [])
        ]);
    }

    public function approveConnections(Collection $connections)
    {
        foreach ($connections as $connection) {
            $this->processApproval($connection);
        }
    }

    public function approveConnection(int $id)
    {
        $this->processApproval(Connection::with('student.user.highSchool.counselors')->find($id));
    }

    public function processApproval(Connection $connection)
    {
        $highschool = $connection->student->user->highSchool;
        $counselors = $highschool?->counselors;

        $connection->update([
            'status' => ConnectionStatus::ACCEPTED
        ]);

        SendConnectionApprovalMail::dispatch($connection, $counselors);
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
            'status' => ConnectionStatus::DENIED
        ]);

        // SendConnectionDenialMail::dispatch($connection)->delay(now()->addMinutes($minutesToAdd));
    }
}
