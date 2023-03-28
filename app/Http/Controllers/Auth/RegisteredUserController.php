<?php

namespace App\Http\Controllers\Auth;

use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FlowController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first' => ['required', 'string', 'max:255'],
            'last' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first' => $request->first,
            'middle' => $request->middle,
            'last' => $request->last,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => Role::STUDENT(),
            'status' => Status::ACTIVE(),
        ]);
        $user->save();
        event(new Registered($user));
        Auth::login($user);
        return redirect(FlowController::next($request));
    }
}
