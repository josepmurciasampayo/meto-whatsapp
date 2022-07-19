<?php

namespace App\Http\Controllers;

use App\Enums\General\Form;
use App\Models\MatchStudentInstitution;
use App\Models\User;
use App\Models\UserForm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserFormController extends Controller
{
    public function show(string $url) :View
    {
        $userForm = UserForm::where('url', $url)->first();
        if (is_null($userForm)) {
            // TODO: log error
        }
        switch ($userForm->form_id) {
            case (Form::ENDOFCYCLE):
                $matches = MatchStudentInstitution::getByUserID($userForm->user_id);
                $user = User::find($userForm->user_id)->first();
                return view('forms.endofcycle', ['matches' => $matches, 'user' => $user]);
                break;
            default:
                // TODO: log error and notify
                break;
        }

        // TODO: log error and notify
    }
}
