<?php

namespace App\Http\Controllers;

use App\Enums\User\Role;
use App\Mail\ContactMail;
use App\Models\ContactForm;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class StaticController extends Controller
{
    public function terms() :View
    {
        return view('static.terms');
    }

    public function consent() :View
    {
        switch (Auth::user()->role) {
            case Role::INSTITUTION():
                return view('static.consent-uni');
            case Role::STUDENT():
                return view('static.consent-student');
            case Role::COUNSELOR():
                return view('static.consent-counselor');
        }
    }

    public function privacy() :View
    {
        return view('static.privacy-policy');
    }

    public function saveTerms(Request $request) :RedirectResponse
    {
        $user = Auth()->user();
        $user->terms = $request->terms;
        $user->save();
        return redirect(route('student.intro'));
    }

    public function saveConsent(Request $request) :RedirectResponse
    {
        $user = Auth()->user();
        $user->consent = $request->consent;
        $user->save();
        return redirect(route('student.intro'));
    }

    public function contact() :View
    {
        return view('forms.contact', [
            'user' => Auth()->user(),
        ]);
    }

    public function contactStore(Request $request) :RedirectResponse
    {
        if ($request->user_id == 0) {
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
        } else {
            $user = User::find($request->user_id);
            $name = $user->first . " " . $user->last;
            $email = $user->email;
            $phone = $user->phone_raw;
        }

        ContactForm::create([
            'user_id' => $request->user_id,
            'name' => $name,
            'email' => $email,
            'message' => $request->text,
            'phone' => $phone,
        ]);

        Mail::to(config('mail.contact.address'))->send(new ContactMail(
            $name,
            $email,
            $phone,
            $request->text,
            $request->user_id,
        ));

        return redirect(route('contact.thankyou'));
    }

    public function contactThanks() :View
    {
        return view('forms.thankyou-contact');
    }
}
