<?php

namespace App\Services;

use App\Helpers;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UniService
{
    public static function getAdminData() :array
    {
        $universities = Helpers::dbQueryArray('
            select i.id, i.name, i.connections, count(j.id) as user_count
            from meto_institutions as i
            left outer join meto_user_institutions as j on j.institution_id = i.id
            group by i.id;
        ');

        $counts = Helpers::dbQueryArray('
            select institution_id, count(institution_id) as match_count
			from meto_student_universities
            group by institution_id
        ');
        $countsToReturn = array();
        foreach ($counts as $count) {
            $countsToReturn[$count['institution_id']] = $count['match_count'];
        }

        return ['universities' => $universities, 'counts' => $countsToReturn];
    }

    public function getUsersForUni(int $uni_id): Collection
    {
        $ids = Helpers::dbQueryArray('
            select user_id from meto_user_institutions where institution_id = ' . $uni_id . ';
        ');
        return User::whereIn('id', array_column($ids, 'user_id'))->get();
   }

   public static function getStudentTableData(int $uni_id, array $statuses = null): Builder|Collection
   {
       //TODO: make builder object from query

        $data = Helpers::dbQueryArray('
            select
            u.id as user_id, s.id as student_id,
            efc.text as efc,
            curriculum.text as curriculum,
            citizenship.text as citizenship,
            citizenship_extra.text as citizenship_extra,
            track.text as track,
            destination.text as destination,
            gender.text as gender,
            ranking.text as ranking,
            det.text as det,
            act.text as act,
            concat("ACT: ", ifnull(act.text, "-"), " TOEFL: ", ifnull(toefl.text, "-"), " iELTS: ", ifnull(ielts.text, "0")) as other_scores,
            affiliations.text as affiliations_text,
            refugee.text as refugee_text,
            disability.text as disability_text

            from meto_users as u
            join meto_students as s on s.user_id = u.id
            left outer join meto_answers as efc on efc.question_id = 244 and efc.student_id = s.id
            left outer join meto_answers as countryHS on countryHS.question_id = 104 and countryHS.student_id = s.id
            left outer join meto_answers as curriculum on curriculum.question_id = 318 and curriculum.student_id = s.id
            left outer join meto_answers as citizenship on citizenship.question_id = 288 and citizenship.student_id = s.id
            left outer join meto_answers as citizenship_extra on citizenship_extra.question_id = 290 and citizenship_extra.student_id = s.id
            left outer join meto_answers as track on track.question_id = 13 and track.student_id = s.id
            left outer join meto_answers as destination on destination.question_id = 260 and destination.student_id = s.id
            left outer join meto_answers as gender on gender.question_id = 271 and gender.student_id = s.id
            left outer join meto_answers as ranking on ranking.question_id = 44 and ranking.student_id = s.id
            left outer join meto_answers as det on det.question_id = 69 and det.student_id = s.id
            left outer join meto_answers as act on act.question_id = 67 and act.student_id = s.id
            left outer join meto_answers as toefl on toefl.question_id = 73 and toefl.student_id = s.id
            left outer join meto_answers as ielts on det.question_id = 70 and ielts.student_id = s.id
            left outer join meto_answers as affiliations on affiliations.question_id = 164 and affiliations.student_id = s.id
            left outer join meto_answers as refugee on refugee.question_id = 285 and refugee.student_id = s.id
            left outer join meto_answers as disability on disability.question_id = 308 and disability.student_id = s.id

            left outer join meto_students_universities as c on c.institution_id = ' . $uni_id . '

        ');


   }

}
