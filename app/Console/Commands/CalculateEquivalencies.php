<?php

namespace App\Console\Commands;

use App\Models\Curriculum;
use App\Models\Student;
use App\Services\EquivalencyService;
use Illuminate\Console\Command;

class CalculateEquivalencies extends Command
{
    protected $signature = 'app:calculate-equivalencies';

    protected $description = 'Command description';

    public function handle()
    {
        echo "\nProcessing equivalencies";
        //$students = Student::all();
        $students = Student::where('curriculum_id', \App\Enums\Student\Curriculum::NEWNATIONAL())->get();
        //$students = Student::find([2,11,16,70]);

        foreach ($students as $student) {
            (new EquivalencyService())->update($student);
        }
        echo "\nEquivalencies are processed";
    }
}
