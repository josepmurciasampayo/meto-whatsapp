<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedTinyInteger('has_validation')
                ->default(2)
                ->nullable();
            $table->unsignedTinyInteger('min')
                ->nullable();
            $table->unsignedTinyInteger('max')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn([
                'has_validation',
                'min',
                'max'
            ]);
        });
    }
};
