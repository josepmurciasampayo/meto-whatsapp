<?php


/*
 * AB:
 * We could also get rid of both email and phone and just tell them that if they want a reply, to include a method to get in touch in their message.

 *
 * The other broad question to think about is whether contact us submissions should be in their own table all by themselves,
 * or should they be with anything else. We can debate this.
 */
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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedTinyInteger('request_reply')->comment('0 - No, 1 - Yes');
            $table->text('message');
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
        Schema::dropIfExists('contactus');
    }
};
