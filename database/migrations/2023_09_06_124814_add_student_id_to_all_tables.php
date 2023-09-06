<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * List of all the tables
     */
    public array $tables;

    public function __construct()
    {
        $this->tables = DB::select('SHOW TABLES');

        foreach ($this->tables as $key => $table) {
            $table = collect($table)->first();

            if (str_contains($table, 'meto_')) {
                $this->tables[$key] = str_replace('meto_', '', $table);
            } else {
                $this->tables[$key] = $table;
            }
        }

        $this->tables = array_filter($this->tables, fn ($table) => !(str_contains($table, 'view_') || str_contains($table, '_view')));
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) || (($table = 'meto_' . $table) && Schema::hasTable($table))) {
                if (!Schema::hasColumn($table, 'student_id')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->unsignedBigInteger('student_id')
                            ->nullable();
                    });
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasColumn($table, 'student_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('student_id');
                });
            }
        }
    }
};
