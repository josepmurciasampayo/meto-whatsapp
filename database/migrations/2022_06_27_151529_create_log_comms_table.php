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
        Schema::create('log_comms', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('channel')->comment(\App\Enums\General\Channel::toString());
            $table->string('from')->comment('Email or number or "Meto"');
            $table->string('to')->comment('Email or number or "Meto"');
            $table->string('body')->comment('Content of communication');
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
        Schema::dropIfExists('log_comms');
    }
};
