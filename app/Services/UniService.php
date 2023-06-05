<?php

namespace App\Services;

use App\Helpers;
use App\Models\Student;
use App\Models\User;
use App\Models\ViewStudentDetail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

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

   public static function studentTableQuery(int $uni_id, array $statuses = null)
   {
       return Student::query();
       return DB::table('users as u')
           ->join('students as s', 's.user_id', '=', 'u.id')

           ->leftJoin('answers as efc', function ($join) {
               $join->on('efc.question_id', '=', DB::raw(244))
                   ->on('efc.student_id', '=', 's.id');
           })

           ->leftJoin('answers as countryHS', function ($join) {
               $join->on('countryHS.question_id', '=', DB::raw(104))
                   ->on('countryHS.student_id', '=', 's.id');
           })

           ->leftJoin('answers as curriculum', function ($join) {
               $join->on('curriculum.question_id', '=', DB::raw(318))
                   ->on('curriculum.student_id', '=', 's.id');
           })

           ->leftJoin('answers as citizenship', function ($join) {
               $join->on('citizenship.question_id', '=', DB::raw(288))
                   ->on('citizenship.student_id', '=', 's.id');
           })

           ->leftJoin('answers as citizenship_extra', function ($join) {
               $join->on('citizenship_extra.question_id', '=', DB::raw(290))
                   ->on('citizenship_extra.student_id', '=', 's.id');
           })

//           ->leftJoin('meto_answers as track', function ($join) {
//               $join->on('track.question_id', '=', DB::raw(13))
//                   ->on('track.student_id', '=', 's.id');
//           })

           ->leftJoin('answers as destination', function ($join) {
               $join->on('destination.question_id', '=', DB::raw(260))
                   ->on('destination.student_id', '=', 's.id');
           })

//           ->leftJoin('meto_answers as track', function ($join) {
//               $join->on('track.question_id', '=', DB::raw(271))
//                   ->on('track.student_id', '=', 's.id');
//           })

           ->leftJoin('answers as gender', function ($join) {
               $join->on('gender.question_id', '=', DB::raw(44))
                   ->on('gender.student_id', '=', 's.id');
           })

           ->leftJoin('answers as det', function ($join) {
               $join->on('det.question_id', '=', DB::raw(69))
                   ->on('det.student_id', '=', 's.id');
           })

           ->leftJoin('answers as act', function ($join) {
               $join->on('act.question_id', '=', DB::raw(67))
                   ->on('act.student_id', '=', 's.id');
           })

           ->leftJoin('answers as toefl', function ($join) {
               $join->on('toefl.question_id', '=', DB::raw(73))
                   ->on('toefl.student_id', '=', 's.id');
           })

           ->leftJoin('answers as ielts', function ($join) {
               $join->on('ielts.question_id', '=', DB::raw(70))
                   ->on('ielts.student_id', '=', 's.id');
           })

           ->leftJoin('answers as affiliations', function ($join) {
               $join->on('affiliations.question_id', '=', DB::raw(164))
                   ->on('affiliations.student_id', '=', 's.id');
           })

           ->leftJoin('answers as refugee', function ($join) {
               $join->on('refugee.question_id', '=', DB::raw(285))
                   ->on('refugee.student_id', '=', 's.id');
           })

           ->leftJoin('answers as disability', function ($join) {
               $join->on('disability.question_id', '=', DB::raw(308))
                   ->on('disability.student_id', '=', 's.id');
           })

           ->leftJoin('student_universities as connection', function ($join) use ($uni_id, $statuses) {
               $join->on('connection.student_id', '=', 's.id')
                   ->on('connection.institution_id', '=', $uni_id);
                   //->whereIn('connection.status', $statuses);
           })

           ->select([
                'u.id as user_id',
                's.id as student_id',
                'efc.text as efc',
                'curriculum.text as curriculum',
                's.equivalency',
//                'track.text as track',
                'destination.text_expanded as destination',
                'gender.text as gender',
                'affiliations.text as affiliations_text',
                'refugee.text as refugee_text',
                'disability.text_expanded as disability',
//                'ranking.text as ranking',
                'det.text as det',
                'act.text as act',
                'connection.institution_id',
                'connection.status_application',
                'connection.status_enrollment',
                'connection.status',
//                DB::raw('if(isnull(citizenship_extra.text), citizenship.text, concat(citizenship.text, ", ", citizenship_extra.text)) as citizenship'),
//                DB::raw('concat("ACT: ", ifnull(act.text, "-"), " TOEFL: ", ifnull(toefl.text, "-"), " iELTS: ", ifnull(ielts.text, "-")) as other_scores')
           ])

//           ->whereNotNull('curiculum.text')
//           ->whereNotNull('efc.text')
           ;

       /*
        $query = '
        select
            u.id as user_id,
            s.id as student_id,
            efc.text as efc,
            curriculum.text as curriculum,
            s.equivalency,
            track.text as track,
            destination.text_expanded as destination,
            gender.text as gender,
            affiliations.text as affiliations_text,
            refugee.text as refugee_text,
            disability.text_expanded as disability,
            ranking.text as ranking,
            det.text as det,
            act.text as act,
            if(isnull(citizenship_extra.text),
            	  citizenship.text,
            	  concat(citizenship.text, ", ", citizenship_extra.text)
            	  ) as citizenship,
            concat("ACT: ", ifnull(act.text, "-"), " TOEFL: ", ifnull(toefl.text, "-"), " iELTS: ", ifnull(ielts.text, "0")) as other_scores,
            connection.institution_id,
            connection.status_application,
            connection.status_enrollment,
            connection.status

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

            left outer join meto_student_universities as connection on connection.student_id = s.id and connection.institution_id = ' . $uni_id . ' and connection.status in (' . implode(",", $statuses) . ')

            where curriculum.text is not null and efc.text is not null;
       */
   }

}
