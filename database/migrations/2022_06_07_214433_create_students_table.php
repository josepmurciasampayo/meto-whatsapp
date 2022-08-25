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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment();
            $table->unsignedMediumInteger('google_db_id')->nullable();
            $table->unsignedMediumInteger('google_sheets_id')->nullable();
            $table->unsignedTinyInteger('gender')->nullable()->comment(\App\Enums\Student\Gender::toString());
            $table->date('dob')->nullable()->comment("Date of Birth");
            $table->unsignedSmallInteger('birth_country')->nullable()->comment("Country of Birth");
            $table->string('birth_city')->nullable();
            $table->unsignedTinyInteger('refugee')->nullable()->comment(\App\Enums\Student\Refugee::toString());
            $table->string('email_2')->nullable();
            $table->unsignedTinyInteger('email_owner')->nullable()->comment();
            $table->unsignedTinyInteger('email2_owner')->nullable()->comment(\App\Enums\Student\Owner::toString());
            $table->unsignedTinyInteger('phone_owner')->nullable()->comment(\App\Enums\Student\Owner::toString());
            $table->string('government_id')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->unsignedTinyInteger('disability')->nullable()->comment(\App\Enums\Student\Disability::toString());
            $table->unsignedTinyInteger('curriculum')->nullable()->comment(\App\Enums\Student\Curriculum::toString());
            $table->unsignedTinyInteger('submission_device')->nullable()->comment(\App\Enums\Student\SubmissionDevice::toString());
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
        Schema::dropIfExists('students');
    }
};
