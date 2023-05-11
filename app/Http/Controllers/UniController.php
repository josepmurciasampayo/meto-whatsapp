<?php

namespace App\Http\Controllers;

use App\Enums\User\Role;
use App\Http\Requests\Uni\UniApplicationRequest;
use App\Http\Requests\Uni\UniEfcRequest;
use App\Http\Requests\Uni\UniLocationRequest;
use App\Models\Institution;
use App\Models\Joins\UserInstitution;
use App\Models\User;
use App\Services\UniService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

    public function get(int $id): View
    {
        return view('admin.university', [
            'uni' => Institution::find($id),
            'users' => (new UniService())->getUsersForUni($id),
        ]);
    }

    public function create(): View
    {
        return view('admin.uni-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $uni = new Institution();
        $uni->name = $request->input('uniName');
        $uni->type = $request->input('type');
        $uni->connections = $request->input('connections');
        $uni->save();

        $user = new User();
        $user->first = $request->input('first');
        $user->last = $request->input('last');
        $user->email = $request->input('email');
        $user->role = Role::INSTITUTION();
        $user->title = $request->input('title');
        $user->save();

        $join = new UserInstitution();
        $join->user_id = $user->id;
        $join->institution_id = $uni->id;
        $join->save();

        return redirect(route('universities'));
    }

    public function update(Request $request): RedirectResponse
    {
        switch ($request->input('action')) {
            case 0: // simple store
                $uni = Institution::find($request->input('uni_id'));
                $uni->name = $request->input('uniName');
                $uni->type = $request->input('type');
                $uni->connections = $request->input('connections');
                $uni->save();

                foreach ($request->input('user') as $user_id => $userData) {
                    $user = User::find($user_id);
                    $user->first = $userData['first'];
                    $user->last = $userData['last'];
                    $user->email = $userData['email'];
                    $user->title = $userData['title'];
                    $user->save();
                }
                break;

            case 3: // add user
                $user = new User();
                $user->email = Str::random(4);
                $user->save();

                $join = new UserInstitution();
                $join->user_id = $user->id;
                $join->institution_id = $request->input('uni_id');
                $join->save();
                break;

            case 4: // delete user
                User::destroy($request->input('userToDelete'));
                break;

        }
        return redirect(route('uni', ['id' => $request->input('uni_id')]));
    }
}
