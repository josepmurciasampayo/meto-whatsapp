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
        Schema::table('curricula', function (Blueprint $table) {
            $table->unsignedSmallInteger('enum_id')->nullable();
            $table->unsignedSmallInteger('response_id')->nullable();
        });

        \App\Models\Curriculum::where('name', 'Kenyan')->update(['enum_id' => \App\Enums\Student\Curriculum::KENYAN(), 'response_id' => 50]);
        \App\Models\Curriculum::where('name', 'Ugandan')->update(['enum_id' => \App\Enums\Student\Curriculum::UGANDAN(), 'response_id' => 49]);
        \App\Models\Curriculum::where('name', 'Rwandan')->update(['enum_id' => \App\Enums\Student\Curriculum::RWANDAN(), 'response_id' => 51]);
        \App\Models\Curriculum::where('name', 'American')->update(['enum_id' => \App\Enums\Student\Curriculum::AMERICAN(), 'response_id' => 47]);
        \App\Models\Curriculum::where('name', 'IB')->update(['enum_id' => \App\Enums\Student\Curriculum::IB(), 'response_id' => 48]);
        \App\Models\Curriculum::where('name', 'Cambridge')->update(['enum_id' => \App\Enums\Student\Curriculum::CAMBRIDGE(), 'response_id' => 46]);
        \App\Models\Curriculum::where('name', 'Graduates and Transfers')->update(['enum_id' => \App\Enums\Student\Curriculum::TRANSFER(), 'response_id' => 0]);
        \App\Models\Curriculum::where('name', 'All Others')->update(['enum_id' => \App\Enums\Student\Curriculum::OTHER(), 'response_id' => 0]);
        \App\Models\Curriculum::where('name', 'National')->update(['enum_id' => \App\Enums\Student\Curriculum::NATIONAL(), 'response_id' => 52]);
        \App\Models\Curriculum::where('name', 'Indian')->update(['enum_id' => \App\Enums\Student\Curriculum::INDIA(), 'response_id' => 111044]);
        \App\Models\Curriculum::where('name', 'Vietnamese')->update(['enum_id' => \App\Enums\Student\Curriculum::VIETNAM(), 'response_id' => 111033]);
        \App\Models\Curriculum::where('name', 'Ghanaian')->update(['enum_id' => \App\Enums\Student\Curriculum::GHANA(), 'response_id' => 111045]);
        \App\Models\Curriculum::where('name', 'Mexican')->update(['enum_id' => \App\Enums\Student\Curriculum::MEXICO(), 'response_id' => 111040]);
        \App\Models\Curriculum::where('name', 'Nigerian')->update(['enum_id' => \App\Enums\Student\Curriculum::NIGERIA(), 'response_id' => 111037]);
        \App\Models\Curriculum::where('name', 'Ethiopian')->update(['enum_id' => \App\Enums\Student\Curriculum::ETHIOPIA(), 'response_id' => 111046]);
        \App\Models\Curriculum::where('name', 'Nepalese')->update(['enum_id' => \App\Enums\Student\Curriculum::NEPAL(), 'response_id' => 111038]);
        \App\Models\Curriculum::where('name', 'Saudi Arabian')->update(['enum_id' => \App\Enums\Student\Curriculum::SAUDIARABIA(), 'response_id' => 111036]);
        \App\Models\Curriculum::where('name', 'Iranian')->update(['enum_id' => \App\Enums\Student\Curriculum::IRAN(), 'response_id' => 111042]);
        \App\Models\Curriculum::where('name', 'Kuwaiti')->update(['enum_id' => \App\Enums\Student\Curriculum::KUWAIT(), 'response_id' => 111041]);
        \App\Models\Curriculum::where('name', 'Turkish')->update(['enum_id' => \App\Enums\Student\Curriculum::TURKIYE(), 'response_id' => 111034]);
        \App\Models\Curriculum::where('name', 'Bangladeshi')->update(['enum_id' => \App\Enums\Student\Curriculum::BANGLADESH(), 'response_id' => 111049]);
        \App\Models\Curriculum::where('name', 'Brazillian')->update(['enum_id' => \App\Enums\Student\Curriculum::BRAZIL(), 'response_id' => 111048]);
        \App\Models\Curriculum::where('name', 'Indonesian')->update(['enum_id' => \App\Enums\Student\Curriculum::INDONESIA(), 'response_id' => 111043]);
        \App\Models\Curriculum::where('name', 'South African')->update(['enum_id' => \App\Enums\Student\Curriculum::SOUTHAFRICA(), 'response_id' => 111035]);
        \App\Models\Curriculum::where('name', 'Moroccan')->update(['enum_id' => \App\Enums\Student\Curriculum::MOROCCO(), 'response_id' => 111039]);
        \App\Models\Curriculum::where('name', 'Egyptian')->update(['enum_id' => \App\Enums\Student\Curriculum::EGYPT(), 'response_id' => 111047]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curricula', function (Blueprint $table) {
            //
        });
    }
};
