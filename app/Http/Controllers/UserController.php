<?php

namespace App\Http\Controllers;

use App\Enums\Country\Country;
use App\Enums\User\Role;
use App\Models\Joins\UserHighSchool;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends \Illuminate\Routing\Controller
{
    public function profile(?int $user_id = null) :View
    {
        // Viewing your own profile
        if (is_null($user_id)) {
            if (Auth()->user()->isCounselor()) {
                $join = UserHighSchool::getByCounselorUserID(Auth()->user()->id);
            } else {
                $join = null;
            }
            return view('user.profile', [
                'user' => Auth()->user(),
                'countries' => Country::descriptions(),
                'join' => $join,
            ]);
        }

        // TODO: finish this but think about counselor and uni
        // Viewing someone else's profile
        $loggedInUser = Auth()->user();
        $profileUser = User::find($user_id);
        if (Auth()->user()->role == Role::ADMIN()) {
            return view('user.profile', [
                'user' => $profileUser,
                'countries' => Country::descriptions(),
            ]);
        }

    }

    public function update(Request $request) :RedirectResponse
    {
        if (Auth()->user()->id != $request->id) {
            if (Auth()->user()->role != Role::ADMIN())
            abort(403);
        }

        $user = User::find($request->id);
        $user->first = $request->first;
        $user->last = $request->last;
        $user->email = $request->email;
        $user->phone_raw = $request->phone;
        $user->title = $request->title;
        $user->linkedin_url = $request->linkedin_url;
        // $user->country = $request->country;

        if ($user->isCounselor()) {
            $user->sub_email = $request->subscribe;
        }

        $user->save();

        // send unsubscribe for counselors to abraham

        return redirect('profile');
    }
}
