<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\User\{Role, Status, Verified, Consent};

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('google_id')->unique()->nullable();
            $table->string('first');
            $table->string('last');
            $table->string('title')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_raw')->nullable();
            $table->unsignedTinyInteger('phone_owner')->nullable()->comment(\App\Enums\Student\Owner::toString());
            $table->unsignedSmallInteger('phone_country')->nullable();
            $table->unsignedSmallInteger('phone_area')->nullable();
            $table->unsignedBigInteger('phone_local')->nullable();
            $table->unsignedBigInteger('phone_combined')->nullable();
            $table->unsignedTinyInteger('phone_verified')->default(Verified::UNKNOWN())->comment(Verified::toString());
            $table->unsignedTinyInteger('whatsapp_consent')->default(Consent::UNKNOWN())->comment(Consent::toString());
            $table->unsignedTinyInteger('role')->comment(Role::toString());
            $table->unsignedTinyInteger('status')->comment(Status::toString());
            $table->string('linkedin_url')->nullable();
            $table->unsignedTinyInteger('sub_email')->default(1)->comment("0 - Not Subscribed, 1 - Subscribed");
            $table->rememberToken();
            $table->timestamps();

            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
