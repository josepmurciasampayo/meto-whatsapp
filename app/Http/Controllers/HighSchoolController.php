<?php

namespace App\Http\Controllers;

use App\Enums\General\YesNo;
use App\Helpers;
use App\Models\HighSchool;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HighSchoolController extends Controller
{
    public function index(): View
    {
        return view('admin.highschools', [
            'data' => HighSchool::getAdminData(),
        ]);
    }

    public function merge(Request $request) :View|RedirectResponse
    {
        if ($request->input('verifyIDs')) {
            $verifyIDs = explode(",", $request->input('verifyIDs'));
            foreach ($verifyIDs as $id) {
                $hs = HighSchool::find($id);
                $hs->verified = YesNo::YES();
                $hs->save();
            }
        }

        if ($request->input('IDs')) {
            $IDs = explode(",", $request->input('IDs'));
            $highschools = array();
            foreach ($IDs as $id) {
                $highschools[] = HighSchool::find($id);
            }

            return view('admin.highschools-merge', [
                'IDs' => $request->input('IDs'),
                'data' => $highschools,
            ]);
        }

        return redirect(route('highschools'));
    }

    public function mergeConfirm(Request $request) :RedirectResponse
    {
        $oldIDs = $request->input('IDs');
        $IDarray = explode(",", $oldIDs);

        $primaryID = $request->input('primary') ?? $IDarray[0];
        $new = HighSchool::find($primaryID)->replicate();
        $new->save();

        Helpers::dbUpdate('
            update meto_user_high_schools set highschool_id = ' . $new->id . ' where highschool_id in (' . $oldIDs . ');
        ');

        Helpers::dbUpdate('
            delete from meto_high_schools where id in (' . $oldIDs . ');
        ');

        return redirect(route('highschool', [
            'highschool_id' => $new->id,
        ]));
    }
}
