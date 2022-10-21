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
        \Database\Seeders\EnumSeeder::loadToTable(\App\Enums\Student\QuestionType::options(), \App\Enums\EnumGroup::GENERAL_QUESTIONTYPE, \App\Enums\Student\QuestionType::descriptions());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
