<?php

namespace App\Http\Controllers;

use App\Enums\Country\Country;
use App\Enums\User\Role;
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
            return view('user.profile', [
                'user' => Auth()->user(),
                'countries' => Country::descriptions(),
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
        $elements = $request->toArray();
        if (Auth()->user()->id != $elements['id']) {
            if (Auth()->user()->role != Role::ADMIN())
            abort(403);
        }

        $user = User::find($elements['id']);
        $user->first = $elements['first'];
        $user->last = $elements['last'];
        $user->email = $elements['email'];
        $user->phone_raw = $elements['phone'];
        $user->title = $elements['title'];
        $user->country = $elements['country'];
        $user->save();

        return redirect('profile');
    }
}
