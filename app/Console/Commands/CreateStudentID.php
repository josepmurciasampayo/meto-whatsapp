<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;

class CreateStudentID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-student-i-d';

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
        $startingID = 100000;
        $students = Student::all();
        foreach ($students as $student) {
            $student->display_id = $startingID++;
            $student->save();
        }
    }
}
