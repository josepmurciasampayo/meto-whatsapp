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
            $table->unsignedSmallInteger('question_id')->nullable();
            $table->string('question_ids_json')->nullable();
            $table->unsignedSmallInteger('response_id');
            $table->unsignedSmallInteger('score');
            $table->unsignedTinyInteger('percentile');
            $table->unsignedTinyInteger('band');
            $table->timestamps();
        });

        Schema::table('questions', function (Blueprint $table) {
            
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
