<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Services\EquivalencyService;
use Illuminate\Console\Command;

class CalculateEquivalencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-equivalencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "\nProcessing equivalencies";
        $students = Student::all();
        //$students = Student::find([3741,1063]);

        foreach ($students as $student) {
            (new EquivalencyService())->update($student);
        }
        echo "\nEquivalencies are processed";
    }
}
