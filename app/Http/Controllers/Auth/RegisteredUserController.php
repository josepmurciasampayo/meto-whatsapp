<?php

namespace App\Http\Controllers\Auth;

use App\Enums\General\YesNo;
use App\Enums\User\Consent;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FlowController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Welcome;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'first' => $request->first,
            'middle' => $request->middle,
            'last' => $request->last,
            'email' => $request->email,
            'phone_country' => $request->input('phone')['code'],
            'phone_local' => $request->input('phone')['number'],
            'phone_array' => json_encode($request->input('phone')),
            'phone_combined' => $request->input('phone')['code'] . $request->input('phone')['number'],
            'phone_owner' => $request->input('owner'),
            'whatsapp_used' => ($request->has('whatsapp')) ? YesNo::YES() : YesNo::NO(),
            'whatsapp_consent' => ($request->has('consent')) ? Consent::CONSENT() : Consent::NOCONSENT(),
            'password' => Hash::make($request->password),
            'reminder' => YesNo::YES(), // so popup does not appear on first home page visit
            'role' => Role::STUDENT(),
            'status' => Status::ACTIVE(),
        ]);
        $user->save();

        if ($request->has('terms') && $request->has('privacy')) {
            $user->consent = YesNo::YES();
            $user->save();
        }

        $student = new Student();
        $student->user_id = $user->id;
        $student->save();

        event(new Registered($user));
        Auth::login($user);
        Mail::to($user)->send(new Welcome($user));
        return redirect(FlowController::next($request));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user->phone_array = json_encode($request->input('phone'));
        $user->phone_country = $request->input('phone')['code'];
        $user->phone_local = $request->input('phone')['number'];
        $user->phone_combined = $request->input('phone')['code'] . $request->input('phone')['number'];
        $user->phone_owner = $request->input('owner');
        $user->whatsapp_used = ($request->has('whatsapp')) ? YesNo::YES() : YesNo::NO();
        $user->whatsapp_consent = ($request->has('consent')) ? Consent::CONSENT() : Consent::NOCONSENT();

        $user->save();
        return redirect(route('home'));
    }
}
