<?php

namespace App\Http\Controllers;

use App\Models\Chat\MessageState;
use App\Models\HighSchool;
use App\Models\Institution;
use App\Models\LogComms;
use App\Models\LoginEvents;
use App\Models\MatchStudentInstitution;
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
        return view('admin.commsLog', [
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
        return view('admin.universities');
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
        $match_data = MatchStudentInstitution::getMatchData();
        $data = "";
        foreach ($match_data as $row) {
            $name = $row['first'] . ' ' . $row['last'];
            $data .= '{student:"' .$name. '",school:"' . $row['school'] .'", institution:"' .$row["name"]. '", date:"' .$row["match_date"]. '", status:"' .$row['match_status']. '"},';
        }
        $script = "
            var tabledata = [
            " . $data . "
            ];

        ";
        return view('admin.match-data', ['data' => $script]);
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
}
