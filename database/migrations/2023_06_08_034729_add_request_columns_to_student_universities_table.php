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
        Schema::table('student_universities', function (Blueprint $table) {
            $table->string('application_link', 250)->nullable();
            $table->timestamp('deadline')->nullable();
            $table->string('events', 1000)->nullable();
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
            //
        });
    }
};
