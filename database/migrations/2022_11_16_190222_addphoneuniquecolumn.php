<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('users', function(Blueprint $table) {
            $table->unsignedTinyInteger('phone_unique')->nullable()->comment('0 - Not unique, 1 - Unique');
        });

        $numbers = Helpers::dbQueryArray('
            select phone_raw
            from meto_users
            where phone_raw is not null
            group by phone_raw
            having count(*) > 1
        ');
        foreach ($numbers as $number) {
            DB::update('
                update meto_users set phone_unique = 0 where phone_raw = " . $number . ";
            ');

            DB::update('
                update meto_users set phone_unique = 1 where phone_unique is null;
            ');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
