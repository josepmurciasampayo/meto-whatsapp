<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class updatePassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (Hash::check($request->input('existing_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return redirect(route('student.profile'));
        }
        return back()->with('error', 'Your existing password did not match');
    }
}
