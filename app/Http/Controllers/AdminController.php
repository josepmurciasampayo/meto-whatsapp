<?php

namespace App\Http\Controllers;

use App\Models\Chat\MessageState;
use App\Models\MatchStudentInstitution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    //
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
        $data = ChatbotController::getAdminData();
        $state = MessageState::getAllState();
        return view('admin.commsLog', [
            'data' => $data,
            'state' => $state,
            ]);
    }

    public function matchData() :View
    {
        $match_data = MatchStudentInstitution::getMatchData();
        $data = "";
        foreach ($match_data as $row) {
            $name = $row['first'] . ' ' . $row['last'];
            $data .= '{student:"' .$name. '", institution:"' .$row["name"]. '", date:"' .$row["match_date"]. '", status:"' .$row['match_status']. '"},';
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
}
