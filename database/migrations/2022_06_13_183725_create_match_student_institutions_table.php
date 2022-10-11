<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\General\MatchStudentInstitution;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_student_institutions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('institution_id');
            $table->unsignedTinyInteger('status_application')->nullable();
            $table->unsignedTinyInteger('enrollment_application')->nullable();
            $table->unsignedTinyInteger('status')->default(MatchStudentInstitution::UNKNOWN())->comment(MatchStudentInstitution::toString());
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
        Schema::dropIfExists('match_student_institutions');
    }
};
