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
            create or replace view meto_view_student_detail as
            select
            u.id as user_id, s.id as student_id,
            s.curriculum_id,
            hs.text as hs,
            hs_city.text as hs_city,
            hs_country.text as hs_country,
            affiliations.text as affiliations,
            birth_country.text as birth_country,
            birth_city.text as birth_city,
            gender.text as gender,
            dob.text as dob,
            grad_american.text as grad_american,
            grad_IB.text as grad_IB,
            grad_cambridge.text as grad_cambridge,
            grad_rwandan.text as grad_rwandan,
            grad_ugandan1.text as grad_ugandan1,
            grad_ugandan2.text as grad_ugandan2,
            grad_kenyan.text as grad_kenyan,
            grad_other.text as grad_other,

            american_freshman.text as american_freshman,
            american_sophomore.text as american_sophomore,
            rwandan_olevel1.text as rwandan_olevel1,
            rwandan_olevel2.text as rwandan_olevel2,
            ugandan_olevel.text as ugandan_olevel,
            kcpe.text as kcpe,

            american_junior.text as american_junior,
            american_senior.text as american_senior,

            which_IB.text as which_IB,
            IB_1.text as IB_1,
            IB_2.text as IB_2,
            IB_3.text as IB_3,
            IB_4.text as IB_4,
            IB_5.text as IB_5,
            IB_6.text as IB_6,
            IB_S1.text as IB_S1,
            IB_L1.text as IB_L1,
            IB_S2.text as IB_S2,
            IB_L2.text as IB_L2,
            IB_S5.text as IB_S5,
            IB_L5.text as IB_L5,
            IB_S3.text as IB_S3,
            IB_L3.text as IB_L3,
            IB_S4.text as IB_S4,
            IB_L4.text as IB_L4,
            IB_S6.text as IB_S6,
            IB_L6.text as IB_L6,

            cambridge_desc.text as cambridge_desc,
            cambridge_A_subj.text as cambridge_A_subj,
            cambridge_A_score.text as cambridge_A_score,
            cambridge_B_subj.text as cambridge_B_subj,
            cambridge_B_score.text as cambridge_B_score,
            cambridge_C_subj.text as cambridge_C_subj,
            cambridge_C_score.text as cambridge_C_score,

            rwandan_mock.text as rwandan_mock,
            rwandan_A.text as rwandan_A,

            uganadan_mock.text as uganadan_mock,
            ugandan_A.text as ugandan_A,

            kenyan_mock.text as kenyan_mock,
            kenyan_exam.text as kenyan_exam,

            other_current.text as other_current,
            other_final1.text as other_final1,
            other_final2.text as other_final2

            from meto_users as u
            join meto_students as s on s.user_id = u.id

            left outer join meto_answers as hs on hs.question_id = 119 and hs.student_id = s.id
            left outer join meto_answers as hs_city on hs_city.question_id = 119 and hs_city.student_id = s.id
            left outer join meto_answers as hs_country on hs_country.question_id = 119 and hs_country.student_id = s.id
            left outer join meto_answers as affiliations on affiliations.question_id = 164 and affiliations.student_id = s.id
            left outer join meto_answers as birth_country on birth_country.question_id = 281 and birth_country.student_id = s.id
            left outer join meto_answers as birth_city on birth_city.question_id = 283 and birth_city.student_id = s.id
            left outer join meto_answers as gender on gender.question_id = 271 and gender.student_id = s.id
            left outer join meto_answers as dob on dob.question_id = 275 and dob.student_id = s.id

            left outer join meto_answers as grad_american on grad_american.question_id = 52 and grad_american.student_id = s.id
            left outer join meto_answers as american_freshman on american_freshman.question_id = 134 and american_freshman.student_id = s.id
            left outer join meto_answers as american_sophomore on american_sophomore.question_id = 154 and american_sophomore.student_id = s.id
            left outer join meto_answers as american_junior on american_junior.question_id = 143 and american_junior.student_id = s.id
            left outer join meto_answers as american_senior on american_senior.question_id = 150 and american_senior.student_id = s.id

            left outer join meto_answers as grad_IB on dob.question_id = 54 and grad_IB.student_id = s.id
            left outer join meto_answers as which_IB on which_IB.question_id = 457 and which_IB.student_id = s.id
            left outer join meto_answers as IB_1 on IB_3.question_id = 34 and IB_3.student_id = s.id
            left outer join meto_answers as IB_2 on IB_2.question_id = 36 and IB_2.student_id = s.id
            left outer join meto_answers as IB_3 on IB_5.question_id = 38 and IB_5.student_id = s.id
            left outer join meto_answers as IB_4 on IB_4.question_id = 35 and IB_4.student_id = s.id
            left outer join meto_answers as IB_5 on IB_1.question_id = 33 and IB_1.student_id = s.id
            left outer join meto_answers as IB_6 on IB_6.question_id = 37 and IB_6.student_id = s.id
            left outer join meto_answers as IB_TOK on IB_TOK.question_id = 459 and IB_L6.student_id = s.id
            left outer join meto_answers as IB_S1 on IB_S1.question_id = 131 and IB_S1.student_id = s.id
            left outer join meto_answers as IB_L1 on IB_L1.question_id = 6 and IB_L1.student_id = s.id
            left outer join meto_answers as IB_S2 on IB_S2.question_id = 149 and IB_S2.student_id = s.id
            left outer join meto_answers as IB_L2 on IB_L2.question_id = 8 and IB_L2.student_id = s.id
            left outer join meto_answers as IB_S3 on IB_S3.question_id = 133 and IB_S3.student_id = s.id
            left outer join meto_answers as IB_L3 on IB_L3.question_id = 7 and IB_L3.student_id = s.id
            left outer join meto_answers as IB_S4 on IB_S4.question_id = 129 and IB_S4.student_id = s.id
            left outer join meto_answers as IB_L4 on IB_L4.question_id = 5 and IB_L4.student_id = s.id
            left outer join meto_answers as IB_S5 on IB_S5.question_id = 156 and IB_S5.student_id = s.id
            left outer join meto_answers as IB_L5 on IB_L5.question_id = 10 and IB_L5.student_id = s.id
            left outer join meto_answers as IB_S6 on IB_S6.question_id = 153 and IB_S6.student_id = s.id
            left outer join meto_answers as IB_L6 on IB_L6.question_id = 9 and IB_L6.student_id = s.id

            left outer join meto_answers as grad_cambridge on dob.question_id = 53 and grad_cambridge.student_id = s.id
            left outer join meto_answers as cambridge_desc on cambridge_desc.question_id = 460 and cambridge_desc.student_id = s.id
            left outer join meto_answers as cambridge_A_subj on cambridge_A_subj.question_id = 399 and cambridge_A_subj.student_id = s.id
            left outer join meto_answers as cambridge_A_score on cambridge_A_score.question_id = 168 and cambridge_A_score.student_id = s.id
            left outer join meto_answers as cambridge_B_subj on cambridge_B_subj.question_id = 400 and cambridge_B_subj.student_id = s.id
            left outer join meto_answers as cambridge_B_score on cambridge_B_score.question_id = 169 and cambridge_B_score.student_id = s.id
            left outer join meto_answers as cambridge_C_subj on cambridge_C_subj.question_id = 402 and cambridge_C_subj.student_id = s.id
            left outer join meto_answers as cambridge_C_score on cambridge_C_score.question_id = 170 and cambridge_C_score.student_id = s.id

            left outer join meto_answers as grad_rwandan on dob.question_id = 339 and grad_rwandan.student_id = s.id
            left outer join meto_answers as rwandan_mock on rwandan_mock.question_id = 341 and rwandan_mock.student_id = s.id
            left outer join meto_answers as rwandan_A on rwandan_A.question_id = 343 and rwandan_A.student_id = s.id
            left outer join meto_answers as rwandan_olevel1 on rwandan_olevel1.question_id = 335 and rwandan_olevel1.student_id = s.id
            left outer join meto_answers as rwandan_olevel2 on rwandan_olevel2.question_id = 336 and rwandan_olevel2.student_id = s.id

            left outer join meto_answers as grad_ugandan1 on dob.question_id = 112 and grad_ugandan1.student_id = s.id
            left outer join meto_answers as grad_ugandan2 on dob.question_id = 377 and grad_ugandan2.student_id = s.id
            left outer join meto_answers as uganadan_mock on uganadan_mock.question_id = 76 and uganadan_mock.student_id = s.id
            left outer join meto_answers as ugandan_A on ugandan_A.question_id = 378 and ugandan_A.student_id = s.id
            left outer join meto_answers as ugandan_olevel on ugandan_olevel.question_id = 126 and ugandan_olevel.student_id = s.id

            left outer join meto_answers as grad_kenyan on dob.question_id = 109 and grad_kenyan.student_id = s.id
            left outer join meto_answers as kenyan_mock on kenyan_mock.question_id = 373 and kenyan_mock.student_id = s.id
            left outer join meto_answers as kenyan_exam on kenyan_exam.question_id = 375 and kenyan_exam.student_id = s.id
            left outer join meto_answers as kcpe on kcpe.question_id = 255 and kcpe.student_id = s.id

            -- left outer join meto_answers as grad_other on dob.question_id = 256 and grad_other.student_id = s.id
            -- left outer join meto_answers as other_current on other_current.question_id = 462 and other_current.student_id = s.id
            -- left outer join meto_answers as other_final1 on other_final1.question_id = 325 and other_final1.student_id = s.id
            -- left outer join meto_answers as other_final2 on other_final2.question_id = 324 and other_final2.student_id = s.id
            where s.curriculum_id is not null
            ;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
