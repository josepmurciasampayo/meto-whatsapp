<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        create or replace view view_student_table as
        select
            u.id as user_id, s.id as student_id,
            efc.text as efc,
            curriculum.text as curriculum,
            s.equivalency,
            if(isnull(citizenship_extra.text),
            	  citizenship.text,
            	  concat(citizenship.text, ", ", citizenship_extra.text)
            	  ) as citizenship,
            track.text as track,
            destination.text_expanded as destination,
            gender.text as gender,
            ranking.text as ranking,
            det.text as det,
            act.text as act,
            concat("ACT: ", ifnull(act.text, "-"), " TOEFL: ", ifnull(toefl.text, "-"), " iELTS: ", ifnull(ielts.text, "0")) as other_scores,
            affiliations.text as affiliations_text,
            refugee.text as refugee_text,
            disability.text_expanded as disability,
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

            left outer join meto_student_universities as connection on connection.student_id = s.id and connection.institution_id = ' . $uni_id . '

            where curriculum.text is not null and efc.text is not null;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
