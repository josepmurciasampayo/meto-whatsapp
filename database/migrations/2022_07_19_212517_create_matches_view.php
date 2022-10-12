<?php

use Illuminate\Database\Migrations\Migration;
use App\Enums\EnumGroup;

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
            create or replace view view_matches as
            select
                users.id as user_id,
                students.id as student_id,
                institutions.id as institution_id,
                matches.id as match_id,
                matches.status as match_status,
                users.first,
                users.last,
                institutions.name,
                enum_match_status.enum_desc
            from meto_users as users
            join meto_students as students on students.user_id = users.id
            join meto_matches as matches on matches.student_id = students.id
            join meto_institutions as institutions on matches.institution_id = institutions.id
            join meto_enum as enum_match_status on enum_match_status.enum_id = 'meto_matches.status' and enum_match_status.group_id = " . EnumGroup::GENERAL_MATCH() . "
         ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_matches');
    }

};
