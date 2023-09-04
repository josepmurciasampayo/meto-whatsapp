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
        DB::statement("

            create or replace view meto_view_student_cambridge as
                select
                s.id as 'cambridge_student_id',
                s.equivalency as cambridge_equivalency,
                cambridge_active.text as cambridge_active,
                cambridge_active.response_id as cambridge_active_id,
                grad_cambridge.text as grad_cambridge,
                cambridge_desc.text as cambridge_desc,
                cambridge_A_subj.text as cambridge_A_subj,
                cambridge_A_score.text as cambridge_A_score,
                cambridge_B_subj.text as cambridge_B_subj,
                cambridge_B_score.text as cambridge_B_score,
                cambridge_C_subj.text as cambridge_C_subj,
                cambridge_C_score.text as cambridge_C_score
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 6
                left outer join meto_answers as cambridge_active on cambridge_active.question_id = 61 and cambridge_active.student_id = s.id
                left outer join meto_answers as grad_cambridge on grad_cambridge.question_id = 53 and grad_cambridge.student_id = s.id
                left outer join meto_answers as cambridge_desc on cambridge_desc.question_id = 460 and cambridge_desc.student_id = s.id
                left outer join meto_answers as cambridge_A_subj on cambridge_A_subj.question_id = 399 and cambridge_A_subj.student_id = s.id
                left outer join meto_answers as cambridge_A_score on cambridge_A_score.question_id = 168 and cambridge_A_score.student_id = s.id
                left outer join meto_answers as cambridge_B_subj on cambridge_B_subj.question_id = 400 and cambridge_B_subj.student_id = s.id
                left outer join meto_answers as cambridge_B_score on cambridge_B_score.question_id = 169 and cambridge_B_score.student_id = s.id
                left outer join meto_answers as cambridge_C_subj on cambridge_C_subj.question_id = 402 and cambridge_C_subj.student_id = s.id
                left outer join meto_answers as cambridge_C_score on cambridge_C_score.question_id = 170 and cambridge_C_score.student_id = s.id
                ;

            create or replace view meto_view_student_american as
                select
                s.id as american_student_id,
                s.equivalency as american_equivalency,
                american_active.text as american_active,
                american_active.response_id as american_active_id,
                grad_american.text as grad_american,
                american_freshman.text as american_freshman,
                american_sophomore.text as american_sophomore,
                american_junior.text as american_junior,
                american_senior.text as american_senior
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 4
                left outer join meto_answers as american_active on american_active.question_id = 61 and american_active.student_id = s.id
                left outer join meto_answers as grad_american on grad_american.question_id = 52 and grad_american.student_id = s.id
                left outer join meto_answers as american_freshman on american_freshman.question_id = 134 and american_freshman.student_id = s.id
                left outer join meto_answers as american_sophomore on american_sophomore.question_id = 154 and american_sophomore.student_id = s.id
                left outer join meto_answers as american_junior on american_junior.question_id = 143 and american_junior.student_id = s.id
                left outer join meto_answers as american_senior on american_senior.question_id = 150 and american_senior.student_id = s.id
                ;

            create or replace view meto_view_student_ib as
                select
                s.id as ib_student_id,
                IB_active.text as IB_active,
                IB_active.response_id as IB_active_id,
                s.equivalency as ib_equivalency,
                which_IB.text as which_IB,
                grad_IB.text as grad_IB,
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
                IB_L6.text as IB_L6
                from meto_users as u
                join meto_students as s on s.user_id = u.id and curriculum_id = 5
                left outer join meto_answers as IB_active on IB_active.question_id = 61 and IB_active.student_id = s.id
                left outer join meto_answers as grad_IB on grad_IB.question_id = 54 and grad_IB.student_id = s.id
                left outer join meto_answers as which_IB on which_IB.question_id = 457 and which_IB.student_id = s.id
                left outer join meto_answers as IB_1 on IB_1.question_id = 34 and IB_1.student_id = s.id
                left outer join meto_answers as IB_2 on IB_2.question_id = 36 and IB_2.student_id = s.id
                left outer join meto_answers as IB_3 on IB_3.question_id = 38 and IB_3.student_id = s.id
                left outer join meto_answers as IB_4 on IB_4.question_id = 35 and IB_4.student_id = s.id
                left outer join meto_answers as IB_5 on IB_5.question_id = 33 and IB_5.student_id = s.id
                left outer join meto_answers as IB_6 on IB_6.question_id = 37 and IB_6.student_id = s.id
                left outer join meto_answers as IB_TOK on IB_TOK.question_id = 459 and IB_TOK.student_id = s.id
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
                ;

            create or replace view meto_view_student_ugandan as
                select
                s.id as ugandan_student_id,
                s.equivalency as ugandan_equivalency,
                grad_ugandan1.text as grad_ugandan1,
                grad_ugandan2.text as grad_ugandan2,
                uganadan_mock.text as uganadan_mock,
                ugandan_A.text as ugandan_A,
                ugandan_olevel.text as ugandan_olevel
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 2
                left outer join meto_answers as grad_ugandan1 on grad_ugandan1.question_id = 112 and grad_ugandan1.student_id = s.id
                left outer join meto_answers as grad_ugandan2 on grad_ugandan2.question_id = 377 and grad_ugandan2.student_id = s.id
                left outer join meto_answers as ugandan_olevel on ugandan_olevel.question_id = 126 and ugandan_olevel.student_id = s.id
                left outer join meto_answers as uganadan_mock on uganadan_mock.question_id = 76 and uganadan_mock.student_id = s.id
                left outer join meto_answers as ugandan_A on ugandan_A.question_id = 378 and ugandan_A.student_id = s.id
                ;

            create or replace view meto_view_student_kenyan as
                select
                s.id as kenyan_student_id,
                s.equivalency as kenyan_equivalency,
                grad_kenyan.text as grad_kenyan,
                kenyan_mock.text as kenyan_mock,
                kenyan_exam.text as kenyan_exam,
                kcpe.text as kcpe
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 1
                left outer join meto_answers as grad_kenyan on grad_kenyan.question_id = 109 and grad_kenyan.student_id = s.id
                left outer join meto_answers as kcpe on kcpe.question_id = 255 and kcpe.student_id = s.id
                left outer join meto_answers as kenyan_mock on kenyan_mock.question_id = 373 and kenyan_mock.student_id = s.id
                left outer join meto_answers as kenyan_exam on kenyan_exam.question_id = 375 and kenyan_exam.student_id = s.id
                ;

            create or replace view meto_view_student_newnational as
                select
                s.id as newnational_student_id,
                newnational_numerator.text as newnational_numerator,
                newnational_denominator.text as newnational_denominator,
                newnational_curriculum.text as newnational_curriculum,
                newnational_scoretype.text as newnational_scoretype,
                newnational_scorelevel.text as newnational_scorelevel
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 27
                left outer join meto_answers as newnational_numerator on newnational_numerator.question_id = 325 and newnational_numerator.student_id = s.id
                left outer join meto_answers as newnational_denominator on newnational_denominator.question_id = 324 and newnational_denominator.student_id = s.id
                left outer join meto_answers as newnational_curriculum on newnational_curriculum.question_id = 461 and newnational_curriculum.student_id = s.id
                left outer join meto_answers as newnational_scoretype on newnational_scoretype.question_id = 185 and newnational_scoretype.student_id = s.id
                left outer join meto_answers as newnational_scorelevel on newnational_scorelevel.question_id = 462 and newnational_scorelevel.student_id = s.id
                ;

            create or replace view meto_view_student_rwandan as
                select
                s.id as rwandan_student_id,
                s.equivalency as rwandan_equivalency,
                grad_rwandan.text as grad_rwandan,
                rwandan_olevel1.text as rwandan_olevel1,
                rwandan_olevel2.text as rwandan_olevel2,
                rwandan_mock.text as rwandan_mock,
                rwandan_A1.text as rwandan_A1,
                rwandan_A2.text as rwandan_A2
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 3
                left outer join meto_answers as grad_rwandan on grad_rwandan.question_id = 339 and grad_rwandan.student_id = s.id
                left outer join meto_answers as rwandan_olevel1 on rwandan_olevel1.question_id = 335 and rwandan_olevel1.student_id = s.id
                left outer join meto_answers as rwandan_olevel2 on rwandan_olevel2.question_id = 336 and rwandan_olevel2.student_id = s.id
                left outer join meto_answers as rwandan_mock on rwandan_mock.question_id = 341 and rwandan_mock.student_id = s.id
                left outer join meto_answers as rwandan_A1 on rwandan_A1.question_id = 346 and rwandan_A1.student_id = s.id
                left outer join meto_answers as rwandan_A2 on rwandan_A2.question_id = 343 and rwandan_A2.student_id = s.id
                ;

            create or replace view meto_view_student_indian as
                select
                s.id as indian_student_id,
                s.equivalency as indian_equivalency,
                score.*
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 10
                left outer join meto_answers as score on score.question_id = 839 and score.student_id = s.id
                ;

            create or replace view meto_view_student_ghanian as
                select
                s.id as ghanian_student_id,
                s.equivalency as ghanian_equivalency,
                score.*
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 12
                left outer join meto_answers as score on score.question_id = 560 and score.student_id = s.id
                ;

            create or replace view meto_view_student_brazillian as
                select
                s.id as brazillian_student_id,
                s.equivalency as brazillian_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 22
                left outer join meto_answers as score1 on score1.question_id = 738 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 633 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_saudi as
                select
                s.id as saudi_student_id,
                s.equivalency as saudi_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 17
                left outer join meto_answers as score1 on score1.question_id = 656 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 657 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_indonesian as
                select
                s.id as indonesian_student_id,
                s.equivalency as indonesian_equivalency,
                score.*

                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 23
                left outer join meto_answers as score on score.question_id = 760 and score.student_id = s.id
                ;

            create or replace view meto_view_student_iranian as
                select
                s.id as iranian_student_id,
                s.equivalency as iranian_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 18
                left outer join meto_answers as score1 on score1.question_id = 845 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 846 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_ethiopian as
                select
                s.id as ethiopian_student_id,
                s.equivalency as ethiopian_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 15
                left outer join meto_answers as score1 on score1.question_id = 618 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 842 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_moroccan as
                select
                s.id as moroccan_student_id,
                s.equivalency as moroccan_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 25
                left outer join meto_answers as score1 on score1.question_id = 794 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 795 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_egyptian as
                select
                s.id as egyptian_student_id,
                s.equivalency as egyptian_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 26
                left outer join meto_answers as score1 on score1.question_id = 811 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 823 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_southafrican as
                select
                s.id as southafrican_student_id,
                s.equivalency as southafrican_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id,
                score2.text,
                score2.text_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 26
                left outer join meto_answers as score1 on score1.question_id = 778 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 779 and score2.student_id = s.id
                ;

            create or replace view meto_view_student_bangladeshi as
                select
                s.id as bangladeshi_student_id,
                s.equivalency as bangladeshi_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 21
                left outer join meto_answers as score1 on score1.question_id = 683 and score1.student_id = s.id
                ;

            create or replace view meto_view_student_nigerian as
                select
                s.id as nigerian_student_id,
                s.equivalency as nigerian_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 14
                left outer join meto_answers as score1 on score1.question_id = 560 and score1.student_id = s.id
                ;

            create or replace view meto_view_student_mexican as
                select
                s.id as mexican_student_id,
                s.equivalency as mexican_equivalency,
                score.*
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 13
                left outer join meto_answers as score on score.question_id = 487 and score.student_id = s.id
                ;

            create or replace view meto_view_student_nigerian as
                select
                s.id as nigerian_student_id,
                s.equivalency as nigerian_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 14
                left outer join meto_answers as score1 on score1.question_id = 560 and score1.student_id = s.id
                ;

            create or replace view meto_view_student_turkish as
                select
                s.id as turkish_student_id,
                s.equivalency as turkish_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 20
                left outer join meto_answers as score1 on score1.question_id = 662 and score1.student_id = s.id
                ;

            create or replace view meto_view_student_nepalese as
                select
                s.id as nepalese_student_id,
                s.equivalency as nepalese_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id as score2_response_id,
                score2.text as score2_text,
                score2.text_expanded as score2_expanded,
                score3.response_id as score3_response_id,
                score3.text as score3_text,
                score3.text_expanded as score3_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 16
                left outer join meto_answers as score1 on score1.question_id = 636 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 638 and score2.student_id = s.id
                left outer join meto_answers as score3 on score3.question_id = 641 and score3.student_id = s.id
                ;

            create or replace view meto_view_student_vietnamese as
                select
                s.id as vietnamese_student_id,
                s.equivalency as vietnamese_equivalency,
                score1.response_id as score1_response_id,
                score1.text as score1_text,
                score1.text_expanded as score1_expanded,
                score2.response_id as score2_response_id,
                score2.text as score2_text,
                score2.text_expanded as score2_expanded,
                score3.response_id as score3_response_id,
                score3.text as score3_text,
                score3.text_expanded as score3_expanded
                from meto_users as u
                join meto_students as s on s.user_id = u.id and s.curriculum_id = 11
                left outer join meto_answers as score1 on score1.question_id = 490 and score1.student_id = s.id
                left outer join meto_answers as score2 on score2.question_id = 491 and score2.student_id = s.id
                left outer join meto_answers as score3 on score3.question_id = 502 and score3.student_id = s.id
                ;

            create or replace view meto_view_student_zdetail as
                select
                s.id as student_id,
                s.google_id as google_id,
                s.equivalency,
                s.efc as efc,
                u.id as user_id,
                active.text as actively_applying,
                active.response_id as actively_applying_id,
                s.curriculum,
                s.curriculum_id,
                hs.text as hs,
                hs_city.text as hs_city,
                hs_country.text as hs_country,
                affiliations.text as affiliations,
                birth_country.text as birth_country,
                birth_city.text as birth_city,
                gender.text as gender,
                dob.text as dob,

                american.*,
                kenyan.*,
                ugandan.*,
                rwandan.*,
                ib.*,
                cambridge.*,
                newnational.*

                from meto_users as u
                join meto_students as s on s.user_id = u.id

                left outer join meto_answers as hs on hs.question_id = 119 and hs.student_id = s.id
                left outer join meto_answers as hs_city on hs_city.question_id = 102 and hs_city.student_id = s.id
                left outer join meto_answers as hs_country on hs_country.question_id = 104 and hs_country.student_id = s.id
                left outer join meto_answers as affiliations on affiliations.question_id = 164 and affiliations.student_id = s.id
                left outer join meto_answers as birth_country on birth_country.question_id = 281 and birth_country.student_id = s.id
                left outer join meto_answers as birth_city on birth_city.question_id = 283 and birth_city.student_id = s.id
                left outer join meto_answers as gender on gender.question_id = 271 and gender.student_id = s.id
                left outer join meto_answers as dob on dob.question_id = 275 and dob.student_id = s.id

                left outer join meto_view_student_newnational as newnational on newnational.newnational_student_id = s.id
                left outer join meto_view_student_cambridge as cambridge on cambridge.cambridge_student_id = s.id
                left outer join meto_view_student_american as american on american.american_student_id = s.id
                left outer join meto_view_student_ugandan as ugandan on ugandan.ugandan_student_id = s.id
                left outer join meto_view_student_rwandan as rwandan on rwandan.rwandan_student_id = s.id
                left outer join meto_view_student_ib as ib on ib.ib_student_id = s.id
                left outer join meto_view_student_kenyan as kenyan on kenyan.kenyan_student_id = s.id

                left outer join meto_answers as active on active.question_id = 61 and active.student_id = s.id
            ;
        ");
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
