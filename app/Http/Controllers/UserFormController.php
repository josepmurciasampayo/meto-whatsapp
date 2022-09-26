<?php

namespace App\Http\Controllers;

use App\Enums\General\Form;
use App\Models\MatchStudentInstitution;
use App\Enums\General\MatchStudentInstitution as EnumMatch;
use App\Models\User;
use App\Models\UserForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class UserFormController extends Controller
{
    public function show(string $url) :View
    {
        // TODO: how to handle 419's from these links (or unexpire the links)
        $userForm = UserForm::where('url', $url)->first();
        if (is_null($userForm)) {
            Log::error('Could not find form URL: ' . $url);
        }
        switch ($userForm->form_id) {
            case (Form::ENDOFCYCLE()):
                return $this->showEndOfCycle($userForm);
            default:
                Log::error("Found a Form ID that we don't have a handler for: " . $userForm->form_id);
                break;
        }
    }

    public function showEndOfCycle(UserForm $userForm) :View
    {
        $matches = MatchStudentInstitution::getByUserID($userForm->user_id);
        Log::channel('form')->debug("Found " . count($matches) . " matches");
        $user = User::find($userForm->user_id);
        $data = [
            'matches' => $matches,
            'user' => $user,
            'url' => $userForm->url,
            'userform_id' => $userForm->id,
            'options' => EnumMatch::getStudentChoices(),
            'unknown' => EnumMatch::UNKNOWN(),
        ];
        $agent = new Agent;
        if ($agent->isDesktop()) {
            return view('forms.endofcycle', $data);
        } else {
            return view('forms.mobile-endofcycle', $data);
        }

    }

    public function update(Request $request) :View
    {
        $toStore = $request->toArray();
        Log::channel('form')->debug("UserForm Update received request: " . print_r($toStore, true));
        $userForm = UserForm::where('url', $toStore['userform_url']);
        if (is_null($userForm)) {
            return view ('errors.404');
            // TODO: log and notify
        } else {
            $userForm = $userForm->first();
        }

        $matches = MatchStudentInstitution::getByUserID($userForm->user_id);
        if (count($matches) == 0) {
            return view('errors.404');
            // TODO: log and notify
        }

        foreach ($request['matches'] as $match_id => $status) {
            MatchStudentInstitution::updateMatchStatusByMatchID($match_id, $status, $userForm->user_id);
        }

        return view('forms.thankyou');
    }

    public static function createForms(Collection $students, Form $form) :void
    {
        foreach ($students as $student) {
            UserForm::createForm($student->id, $form);
        }
    }

    public function thankyou() :View
    {
        return view('forms.thankyou');
    }
}
