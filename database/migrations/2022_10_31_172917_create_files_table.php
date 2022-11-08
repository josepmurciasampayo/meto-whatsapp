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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('owner_id')->comment('Could be users or institutions, depending on file type');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('path');
            $table->string('disk')->default('local');
            $table->string('file_hash', 64)->unique();
            $table->unsignedTinyInteger('type')->comment(\App\Enums\General\FileType::toString());
            $table->timestamps();
        });

        \Database\Seeders\EnumSeeder::loadToTable(\App\Enums\General\FileType::options(), \App\Enums\EnumGroup::GENERAL_FILETYPE, \App\Enums\General\FileType::descriptions());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
