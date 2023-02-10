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
        Schema::table('student_universities', function(Blueprint $table) {
            $table->unsignedTinyInteger('intent')->nullable()->comment('0 - No, 1 - Yes');
            $table->unsignedTinyInteger('heardOf')->nullable()->comment('0 - No, 1 - Yes');
            $table->string('factors')->nullable()->comment('Depends on intent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_universities', function (Blueprint $table) {
            $table->dropColumn('intent');
            $table->dropColumn('heardOf');
        });
    }
};
