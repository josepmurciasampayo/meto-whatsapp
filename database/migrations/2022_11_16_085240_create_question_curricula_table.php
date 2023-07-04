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
        Schema::create('question_curricula', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('curriculum_id');
            $table->integer('screen')
                ->nullable();
            $table->integer('order')
                ->nullable();
            $table->integer('branching')
                ->nullable();
            $table->integer('destination_screen')
                ->nullable();

            $table->foreign('question_id')
                ->references('id')
                ->on('questions');

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
        Schema::dropIfExists('question_curricula');
    }
};
