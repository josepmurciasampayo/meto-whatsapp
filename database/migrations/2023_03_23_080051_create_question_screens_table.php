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
        Schema::create('question_screens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('question_id');
            $table->unsignedTinyInteger('curriculum')->comment(\App\Enums\Student\Curriculum::toString());
            $table->unsignedTinyInteger('screen');
            $table->unsignedTinyInteger('order');
            $table->unsignedTinyInteger('branch')->comment(\App\Enums\General\YesNo::toString());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_screens');
    }
};
