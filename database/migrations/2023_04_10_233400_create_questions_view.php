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
        create or replace view view_questions as
            select
            q.id as "question_id",
            q.text,
            q.type,
            q.order as "question_order",
            q.1,
            q.2,
            q.3,
            q.4,
            q.5,
            q.6,
            q.7,
            q.8,
            q.format,
            q.status,
            q.required,
            q.help,
            s.curriculum,
            s.screen,
            s.order as "order",
            s.branch
            from meto_questions as q
            left outer join meto_question_screens as s on s.question_id = q.id;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_view');
    }
};
