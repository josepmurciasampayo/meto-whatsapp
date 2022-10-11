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
        Schema::create('enum', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('group_id')->comment(\App\Enums\EnumGroup::toString());
            $table->unsignedSmallInteger('enum_id');
            $table->string('enum_value');
            $table->string('enum_desc')->nullable();

            $table->index(['group_id', 'enum_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enum');
    }
};
