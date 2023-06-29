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
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_school_choice')->default(false);
            $table->timestamps();
        });

        // Moved this from create_question_curricula migration
        Schema::table('question_curricula', function (Blueprint $table) {
            $table->foreign('curriculum_id')
                ->references('id')
                ->on('curricula');
        });

        // Not sure why renaming?
        /*Schema::rename('question_screens', 'question_curricula');

        Schema::table('question_curricula', function (Blueprint $table) {
            $table->renameColumn('curriculum', 'curriculum_id');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curricula');
    }
};
