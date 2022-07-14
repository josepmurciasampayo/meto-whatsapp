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
        Schema::create('student_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('type')->comment(\App\Enums\Student\StuTags::toString());
            $table->bigInteger('data_int')->nullable();
            $table->string('data_str')->nullable();
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
        Schema::dropIfExists('student_tags');
    }
};
