<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Student;
use Illuminate\Console\Command;

class UpdateStudentDataFromAnswers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-student-data-from-answers';

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
        $students = Student::all();
        foreach ($students as $student) {
            echo "\nUpdating student " . $student->id;
            $student->updateFromAnswers();
        }
    }
}
