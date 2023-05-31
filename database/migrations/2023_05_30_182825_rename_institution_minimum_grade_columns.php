<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('institutions', function (Blueprint $table) {
            $table->renameColumn('min_grade_score', 'min_grade');
            $table->unsignedTinyInteger('min_grade_curriculum')->nullable()->comment(\App\Enums\Student\Curriculum::toString());
            $table->unsignedTinyInteger('min_grade_equivalency')->nullable();
        });
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
