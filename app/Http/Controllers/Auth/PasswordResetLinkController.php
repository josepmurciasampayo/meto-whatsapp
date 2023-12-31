<?php

namespace App\Http\Controllers\Auth;

use App\Enums\General\LoginEventType;
use App\Events\LoginEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) :RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            $email = $request->only('email');
            $user = User::where('email', $email)->first();
            if ($user) {
                event(new LoginEvent($user, LoginEventType::RESETPWREQUEST));
            }
            return redirect()->route('login')->with('status', __($status));
            //TODO: fix going back
        } else {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        }
    }
}
