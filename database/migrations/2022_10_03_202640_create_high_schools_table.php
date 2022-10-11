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
            $table->unsignedTinyInteger('size')->nullable()->comment(\App\Enums\HighSchool\Size::toString());
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
