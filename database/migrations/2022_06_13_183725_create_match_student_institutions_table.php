<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\General\ConnectionStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('institution_id');
            $table->unsignedTinyInteger('status_application')->nullable();
            $table->unsignedTinyInteger('enrollment_application')->nullable();
            $table->unsignedTinyInteger('status')->default(ConnectionStatus::UNKNOWN())->comment(ConnectionStatus::toString());
            $table->timestamps();

            $table->index('student_id');
            $table->index('institution_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
