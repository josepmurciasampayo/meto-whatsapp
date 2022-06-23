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
        Schema::create('enum_countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('two_letter')->nullable();
            $table->string('three_letter')->nullable();
            $table->unsignedSmallInteger('code')->nullable();
            $table->unsignedTinyInteger('region')->nullable();
            $table->unsignedTinyInteger('subregion')->nullable();
            $table->unsignedSmallInteger('region_code')->nullable();
            $table->unsignedSmallInteger('subregion_code')->nullable();
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
        Schema::dropIfExists('enum_countries');
    }
};
