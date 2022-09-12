<?php

namespace App\Http\Controllers;

use App\Enums\General\Form;
use App\Models\MatchStudentInstitution;
use App\Enums\General\MatchStudentInstitution as EnumMatch;
use App\Models\User;
use App\Models\UserForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserFormController extends Controller
{
    public function show(string $url) :View
    {
        // TODO: how to handle 419's from these links (or unexpire the links)
        Log::channel('form')->debug('Landed in UserForm Controller');
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
        return view('forms.endofcycle', [
            'matches' => $matches,
            'user' => $user,
            'url' => $userForm->url,
            'userform_id' => $userForm->id,
            'options' => EnumMatch::getStudentChoices(),
            'unknown' => EnumMatch::UNKNOWN(),
        ]);
    }

    public function update(Request $request) :View
    {
        $toStore = $request->toArray();
        Log::channel('form')->debug("UserForm Update received request: " . print_r($toStore, true));
        $userForm = UserForm::where('url', $toStore['userform_url']);
        if (is_null($userForm)) {
            // TODO: log and notify
        } else {
            $userForm = $userForm->first();
        }

        $matches = MatchStudentInstitution::getByUserID($userForm->user_id);
        if (count($matches) == 0) {
            // TODO: log and notify
        }

        foreach ($request['matches'] as $match_id => $status) {
            MatchStudentInstitution::updateMatchStatusByMatchID($match_id, $status, $userForm->user_id);
        }

        return view('forms.thankyou');
    }

    public function thankyou() :View
    {
        return view('forms.thankyou');
    }
}
