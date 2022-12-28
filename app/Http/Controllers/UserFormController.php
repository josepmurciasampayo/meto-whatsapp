<?php

namespace App\Http\Controllers;

use App\Enums\Chat\Surveys\PostMatchApplyOption;
use App\Enums\Chat\Surveys\PostMatchIntentOption;
use App\Enums\Chat\Surveys\PostMatchNotApplyOption;
use App\Enums\Chat\Surveys\PostMatchNotSureOption;
use App\Enums\General\Form;
use App\Models\StudentUniversity;
use App\Enums\General\MatchStudentInstitution as EnumMatch;
use App\Models\User;
use App\Models\UserForm;
use Illuminate\Database\Eloquent\Collection;
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
            case (Form::POSTMATCH()):
                return $this->showPostMatchApply($userForm);
            default:
                Log::error("Found a Form ID that we don't have a handler for: " . $userForm->form_id);
                break;
        }
    }

    public function showEndOfCycle(UserForm $userForm) :View
    {
        $matches = StudentUniversity::getByUserID($userForm->user_id);
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

    public function showPostMatchApply(UserForm $userForm) :View
    {
        $intent = StudentUniversity::getIntentByUserAndUniversity($userForm->user_id, 77);
        switch ($intent) {
            case PostMatchIntentOption::YES():
                return view('forms.postmatchapply', [
                    'options' => PostMatchApplyOption::descriptions(),
                    'url' => $userForm->url,
                ]);
            case PostMatchIntentOption::NO():
                return view('forms.postmatchnotapply', [
                    'options' => PostMatchNotApplyOption::descriptions(),
                    'url' => $userForm->url,
                ]);
            case PostMatchIntentOption::NOTSURE():
                return view('forms.postmatchnotsure', [
                    'options' => PostMatchNotSureOption::descriptions(),
                    'url' => $userForm->url,
                ]);
            default:
                abort(404);
        }
    }

    public function update(Request $request) :View
    {
        $toStore = $request->toArray();
        Log::channel('form')->debug("UserForm Update received request: " . print_r($toStore, true));
        $userForm = UserForm::where('url', $toStore['userform_url']);
        if (is_null($userForm)) {
            Log::channel('form')->error('Form URL not found: ' . $toStore['userform_url']);
            return view ('errors.404');
        } else {
            $userForm = $userForm->first();
        }

        switch($userForm->form_id) {
            case Form::ENDOFCYCLE():
                $matches = StudentUniversity::getByUserID($userForm->user_id);
                if (count($matches) == 0) {
                    Log::channel('form')->error('No matches found for form URL: ' . $userForm->url);
                    return view('errors.404');
                }

                foreach ($request['matches'] as $match_id => $status) {
                    StudentUniversity::updateMatchStatusByMatchID($match_id, $status, $userForm->user_id);
                }
                break;
            case Form::POSTMATCH():
                $factors = array();
                for ($i = 1; $i<8; ++$i) {
                    if ($request->$i) {
                        $factors[] = $i;
                    }
                }
                StudentUniversity::updateFactors($userForm->user_id, $factors);
                break;
        }

        return view('forms.thankyou');
    }

    public static function createForms(Collection $users, Form $form) :void
    {
        foreach ($users as $user) {
            UserForm::createForm($user->id, $form);
        }
    }

    public function thankyou() :View
    {
        return view('forms.thankyou');
    }
}
