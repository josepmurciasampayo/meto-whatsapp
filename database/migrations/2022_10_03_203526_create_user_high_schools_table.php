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
        Schema::create('user_high_schools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('highschool_id');
            $table->unsignedTinyInteger('role')->comment(\App\Enums\HighSchool\Role::toString());
            $table->unsignedTinyInteger('status')->default(\App\Enums\User\Status::ACTIVE());
            $table->timestamps();

            $table->index('user_id');
            $table->index('highschool_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_high_schools');
    }
};
