<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\AskQuestionRequest;
use App\Http\Requests\Student\StudentConnectionDecisionRequest;
use App\Mail\SendAskQuestionEmail;
use App\Models\Connection;
use Illuminate\Support\Facades\Mail;

class StudentConnectionController extends Controller
{
    public function ask(Connection $connection, AskQuestionRequest $request)
    {
        $recipients = [$connection->requester->email];

        if (($emailCopy = $request->get('email_me_a_copy')) && $emailCopy === true) {
            $recipients[] = auth()->user()->email;
        }

        Mail::to($recipients)->send(new SendAskQuestionEmail($connection, $request->get('question')));

        return true;
    }

    public function decide(Connection $studentUniversity, StudentConnectionDecisionRequest $request)
    {
        return $studentUniversity->update([
            'student_response' => $request->get('student_decision')
        ]);
    }
}
