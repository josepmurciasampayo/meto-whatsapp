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
        Schema::table('meto_users', function (Blueprint $table) {
            $table->unsignedTinyInteger('consent')->default(\App\Enums\General\YesNo::NO());
            $table->unsignedTinyInteger('invite_sent')->default(\App\Enums\General\YesNo::NO());
        });

        Schema::table('meto_answers', function (Blueprint $table) {
            $table->string('text_expanded', 500)->nullable();
        });

        Schema::table('meto_institutions', function (Blueprint $table) {
            $table->unsignedMediumInteger('academic_min')->nullable();
            $table->string('undergrad_url', 500)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
