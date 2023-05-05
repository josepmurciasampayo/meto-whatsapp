<?php

namespace App\Http\Controllers;

use App\Http\Requests\Uni\UniApplicationRequest;
use App\Http\Requests\Uni\UniEfcRequest;
use App\Http\Requests\Uni\UniLocationRequest;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UniController extends Controller
{
    public function welcome(): View
    {
        return view('uni.welcome');
    }

    public function name(): View
    {
        return view('uni.name');
    }

    public function nameStore(Request $request): RedirectResponse
    {
        return redirect(route('uni.homepage'));
    }

    public function homepage(): View
    {
        return view('uni.homepage');
    }

    public function homepageStore(): RedirectResponse
    {
        return redirect(route('uni.application'));
    }

    public function application(): View
    {
        return view('uni.application');
    }

    public function applicationStore(UniApplicationRequest $request): RedirectResponse
    {
        // TODO: Make sure that this is the right object
        $institution = Institution::first();

        $institution->update([
            'url' => $request->get('institution')
        ]);

        return redirect(route('uni.location'));
    }

    public function location(): View
    {
        return view('uni.location');
    }

    public function locationStore(UniLocationRequest $request): RedirectResponse
    {
        $institution = Institution::first();

        $institution->update([
            'country' => $request->get('country'),
            'state' => $request->get('state'),
            'city' => $request->get('city')
        ]);

        return redirect(route('uni.efc'));
    }

    public function efc(): View
    {
        return view('uni.efc');
    }

    public function efcStore(UniEfcRequest $request): RedirectResponse
    {
        $institution = Institution::first();

        $institution->update([
            'efc' => $request->get('efc')
        ]);

        return redirect(route('uni.efc'));
    }

    public function mingrade(): View
    {
        return view('uni.mingrade');
    }

    public function mingradeStore(): RedirectResponse
    {
        return redirect(route('uni.mingrade'));
    }

    public function home(): View
    {
        return view('uni.home');
    }

    public function myProfile(): View
    {
        return view('uni.myProfile');
    }

    public function myProfileStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }

    public function uniProfile(): View
    {
        return view('uni.uniProfile', [
            'user' => Auth::user(),
        ]);
    }

    public function uniProfileStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }

    public function connections(): View
    {
        return view('uni.connections');
    }

    public function database(): View
    {
        return view('uni.database');
    }

    public function efcGrades(): View
    {
        return view('uni.efcGrades');
    }

    public function efcGradesStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }

    public function newUser(): View
    {
        return view('newUser');
    }

    public function newUserStore(Request $request): RedirectResponse
    {
        return redirect(route(''));
    }
}
