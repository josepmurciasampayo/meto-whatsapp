<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\User\{Role, Status};

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
            $table->string('first');
            $table->string('last');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_raw')->nullable();
            $table->unsignedSmallInteger('phone_country')->nullable();
            $table->unsignedSmallInteger('phone_area')->nullable();
            $table->unsignedBigInteger('phone_local')->nullable();
            $table->unsignedTinyInteger('phone_verified')->nullable()->comment(\App\Enums\Student\Verified::toString());
            $table->unsignedTinyInteger('whatsapp_consent')->nullable()->comment(\App\Enums\Student\Consent::toString());
            $table->unsignedTinyInteger('role')->comment(Role::toString());
            $table->unsignedTinyInteger('status')->comment(Status::toString());
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
