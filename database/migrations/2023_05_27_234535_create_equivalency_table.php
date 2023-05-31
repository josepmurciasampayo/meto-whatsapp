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
        Schema::create('equivalency', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('curriculum_id');
            $table->unsignedTinyInteger('score_type')->comment(\App\Enums\ScoreType::toString());
            $table->string('score', 10);
            $table->unsignedTinyInteger('percentile');
            $table->timestamps();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedTinyInteger('equivalency')->default(\App\Enums\General\YesNo::NO())->comment(\App\Enums\General\YesNo::toString());
        });

        Schema::table('students', function (Blueprint $table) {
            $table->unsignedSmallInteger('equivalency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equivalency');
    }
};
