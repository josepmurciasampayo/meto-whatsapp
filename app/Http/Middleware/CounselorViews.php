<?php

namespace App\Http\Middleware;

use App\Models\HighSchool;
use App\Models\Student;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CounselorViews
{
    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        if (Auth()->user()->isAdmin()) {
            return $next($request);
        }
        if (Auth()->user()->isCounselor()) {
            $params = $request->route()->parameters();
            if (isset($params['highschool_id'])) {
                $this->checkSchool($params['highschool_id']);
            }
            if (isset($request->highschool_id)) {
                $this->checkSchool($request->highschool_id);
            }
            if (isset($params['student_id'])) {
                $this->checkStudent($params['student_id']);
            }

            return $next($request);
        }
    }

    private function checkSchool(int $highschool_id) :void
    {
        $homeSchool = HighSchool::getByCounselorID(Auth()->user()->id);
        if ($homeSchool->id != $highschool_id) {
            abort(403);
        }
    }

    private function checkStudent(int $student_id) :void
    {
        if (Auth()->user()->isCounselorAtAP()) {
            $ap_id = HighSchool::getByCounselorID(Auth()->user()->id)->id;
            if (!HighSchool::isStudentEnrolled($student_id, $ap_id)) {
                abort(403);
            }
        } else {
            $studentSchool = HighSchool::getByStudentID($student_id);
            $homeSchool = HighSchool::getByCounselorID(Auth()->user()->id);

            if (is_null($studentSchool) || is_null($homeSchool)) {
                abort(403);
            }

            if ($homeSchool->id != $studentSchool->id) {
                abort(403);
            }
        }
    }
}
