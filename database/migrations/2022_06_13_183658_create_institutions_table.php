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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('google_id')->nullable();
            $table->string('name');
            $table->string('nickname');
            $table->unsignedTinyInteger('type')->nullable()->comment(\App\Enums\Institution\Type::toString());
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('location')->nullable();
            $table->unsignedTinyInteger('size')->nullable()->comment(\App\Enums\Institution\Size::toString());
            $table->unsignedSmallInteger('country');
            $table->string('url')->nullable();
            $table->boolean('is_public')->nullable();
            $table->multiLineString('known_for')->nullable();
            $table->multiLineString('acc_rep')->nullable();
            $table->string('majors_url')->nullable();
            $table->string('apply_url')->nullable();
            $table->multiLineString('extracurriculars')->nullable();
            $table->multiLineString('international')->nullable();
            $table->multiLineString('application_timing')->nullable();
            $table->multiLineString('application_process')->nullable();
            $table->multiLineString('testing_policy')->nullable();
            $table->string('student_life_url')->nullable();
            $table->string('tour_url')->nullable();
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
        Schema::dropIfExists('institutions');
    }
};
