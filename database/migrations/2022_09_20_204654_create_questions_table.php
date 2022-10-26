<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Student\Curriculum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text', 600);
            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('order')->nullable();
            $table->unsignedTinyInteger(Curriculum::AMERICAN())->default(0)->comment('American');
            $table->unsignedTinyInteger(Curriculum::CAMBRIDGE())->default(0)->comment('Cambridge');
            $table->unsignedTinyInteger(Curriculum::IB())->default(0)->comment('IB');
            $table->unsignedTinyInteger(Curriculum::KENYAN())->default(0)->comment('Kenyan');
            $table->unsignedTinyInteger(Curriculum::RWANDAN())->default(0)->comment('Rwandan');
            $table->unsignedTinyInteger(Curriculum::TRANSFER())->default(0)->comment('Transfer');
            $table->unsignedTinyInteger(Curriculum::UGANDAN())->default(0)->comment('Ugandan');
            $table->unsignedTinyInteger(Curriculum::OTHER())->default(0)->comment('All Other');
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
        Schema::dropIfExists('questions');
    }
};
