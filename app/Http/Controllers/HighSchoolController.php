<?php

namespace App\Http\Controllers;

use App\Enums\EnumGroup;
use App\Enums\General\YesNo;
use App\Helpers;
use App\Models\HighSchool;
use App\Models\Student;
use App\Services\StudentService;
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

    public function students(int $highschool_id = null) :View
    {
        if ($highschool_id) {
            $data = StudentService::getStudentsAtSchool($highschool_id);
        } else {
            $data = Helpers::dbQueryArray('
            select
                s.id as "student_id",
                u.id as "user_id",
                concat(u.first, " ", u.last) as "name",
                u.email,
                gender.enum_desc as "gender",
                s.dob,
                u.phone_raw,
                h.name as "school",
                ifnull(h.id, 0) as "highschool_id",
                ifnull(sub.matches, 0) as "matches"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            left outer join meto_user_high_schools as j on j.user_id = u.id
            left outer join meto_enum as gender on gender.enum_id = s.gender and group_id = ' . EnumGroup::STUDENT_GENDER() . '
            left outer join meto_high_schools as h on j.highschool_id = h.id
            left outer join (
            	select s1.id, count(*) as "matches" from meto_students as s1 join meto_connections as m on s1.id = m.student_id group by s1.id
            	) as sub on sub.id = s.id
            	limit 2000;
        ');
        }
        return view('admin.students', ['data' => $data]);
    }
}
