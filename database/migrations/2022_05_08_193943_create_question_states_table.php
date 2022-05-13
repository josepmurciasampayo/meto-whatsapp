<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_states', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unsigned();
            $table->string('question_id')->unsigned();
            $table->string('state')->unsigned();
            $table->mediumText('response');
            $table->dateTime('last_changed');
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
        Schema::dropIfExists('question_states');
    }
}
