<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_states', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('message_id')->comment(\App\Enums\Chat\Campaign::toString());
            $table->unsignedTinyInteger('priority')->default(3)->comment('Higher number corresponds to higher priority');
            $table->unsignedTinyInteger('state')->comment(\App\Enums\Chat\State::toString());
            $table->mediumText('response')->nullable()->comment('Stores user response to campaign message');
            $table->timestamps();

            $table->index('user_id');
            $table->index('priority');
            $table->index('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_states');
    }
}
