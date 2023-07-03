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
       /* Schema::rename('question_screens', 'question_curricula');*/

        Schema::table('question_curricula', function (Blueprint $table) {
            /*$table->renameColumn('curriculum', 'curriculum_id');*/
            $table->unsignedTinyInteger('equivalency')->default(\App\Enums\General\YesNo::NO())->comment(\App\Enums\General\YesNo::toString());
            $table->unsignedTinyInteger('required')->default(\App\Enums\General\YesNo::NO())->comment(\App\Enums\General\YesNo::toString());
        });

        Schema::table('response_branches', function (Blueprint $table) {
            $table->renameColumn('curriculum', 'curriculum_id');
        });

        Schema::table('response_branches', function (Blueprint $table) {
            $table->unsignedBigInteger('curriculum_id')->change();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('1');
            $table->dropColumn('2');
            $table->dropColumn('3');
            $table->dropColumn('4');
            $table->dropColumn('5');
            $table->dropColumn('6');
            $table->dropColumn('7');
            $table->dropColumn('8');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curricula');
        Schema::dropIfExists('question_curricula');
        Schema::table('response_branches', function (Blueprint $table) {
            $table->renameColumn('curriculum_id', 'curriculum');
        });
    }
};
