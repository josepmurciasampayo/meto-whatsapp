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
        Schema::create('high_schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('curriculum')->nullable()->comment(\App\Enums\Student\Curriculum::toString());
            $table->unsignedTinyInteger('type')->nullable()->comment(\App\Enums\HighSchool\Type::toString());
            $table->unsignedTinyInteger('school_size')->nullable()->comment(\App\Enums\HighSchool\SchoolSize::toString());
            $table->unsignedTinyInteger('class_size')->nullable()->comment(\App\Enums\HighSchool\ClassSize::toString());
            $table->unsignedTinyInteger('exam')->nullable()->comment(\App\Enums\HighSchool\Exam::toString());
            $table->unsignedTinyInteger('boarding')->nullable()->comment("0 - No, 1 - Yes");
            $table->unsignedTinyInteger('finish_month')->nullable()->comment(\App\Enums\General\Month::toString());
            $table->unsignedTinyInteger('cost')->nullable()->comment(\App\Enums\HighSchool\Cost::toString());
            $table->string('career_email')->nullable();
            $table->string('connection_emails')->nullable();
            $table->string('government_code')->nullable();
            $table->string('program_url')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->unsignedMediumInteger('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('high_schools');
    }
};
