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
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedTinyInteger('format')->comment(\App\Enums\QuestionFormat::toString());
            $table->unsignedTinyInteger('status')->default(\App\Enums\QuestionStatus::ACTIVE())->comment(\App\Enums\QuestionStatus::toString());
            $table->unsignedTinyInteger('required')->comment(\App\Enums\General\YesNo::toString());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
};
