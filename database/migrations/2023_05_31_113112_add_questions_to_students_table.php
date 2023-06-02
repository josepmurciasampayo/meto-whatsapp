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
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('disability');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('curriculum')->change();
            $table->string('efc')->nullable();
            $table->string('countryHS')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('citizenship_extra')->nullable();
            $table->string('track')->nullable();
            $table->string('destination')->nullable();
            $table->string('gender')->nullable();
            $table->string('ranking')->nullable();
            $table->string('det')->nullable();
            $table->string('act')->nullable();
            $table->string('toefl')->nullable();
            $table->string('ielts')->nullable();
            $table->string('refugee')->change();
            $table->string('affiliations')->nullable();
            $table->renameColumn('disability_raw', 'disability')->nullable();
            $table->string('submission_device')->change();
            $table->string('birth_country')->change();
            $table->string('birth_city')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
