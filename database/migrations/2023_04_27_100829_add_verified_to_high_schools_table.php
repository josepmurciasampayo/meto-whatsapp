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
        Schema::table('high_schools', function (Blueprint $table) {
            $table->unsignedTinyInteger('verified')->nullable()->comment(\App\Enums\General\YesNo::toString());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('high_schools', function (Blueprint $table) {
            //
        });
    }
};
