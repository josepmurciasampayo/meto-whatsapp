<?php

namespace App\Console\Commands;

use App\Helpers;
use App\Models\Answer;
use App\Models\Student;
use Illuminate\Console\Command;

class ImportFromGoogleStudentTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-from-google-student-table';

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
        $fields = [
             'gender' => 271,
             'dob' => 275,
             'country_of_birth' => 281,
             'city_of_birth' => 283,
             'refugee_status' => 285,
             'citizenships' => 288,
             'disability_status' => 308,
             'submission_device' => 312,
         ];

        $students = Helpers::dbQueryArray('
            select
                student_id,
                gender,
                dob,
                country_of_birth,
                city_of_birth,
                refugee_status,
                citizenships,
                disability_status,
                submission_device
            from students_table;
        ');

        foreach ($students as $student) {
            $student_id = Student::where('google_id', $student['student_id'])->first()?->id;
            if (is_null($student_id)) {
                continue;
            }
            echo "\n$student_id";
            foreach ($fields as $field => $question_id) {
                $existing = Answer::where('student_id', $student_id)->where('question_id', $question_id)->first();
                if ($existing) {
                    continue;
                }
                if (is_null($student[$field])) {
                    continue;
                }
                $answer = new Answer();
                $answer->question_id = $question_id;
                $answer->student_id = $student_id;
                $answer->text = $student[$field];

                switch ($field) {
                    case 'gender':
                        $answer->response_id = match($student[$field]) {
                            'Male' => 1,
                            'Female' => 2,
                            'Other / prefer not to say' => 3,
                        };
                        break;
                }

                $answer->save();
update meto_students set curriculum = "American Curriculum" where curriculum_id = 4;
update meto_students set curriculum = "IB Curriculum" where curriculum_id = 5;
update meto_students set curriculum = "Cambridge Curriculum" where curriculum_id = 6;
update meto_students set curriculum = "Kenyan Curriculum" where curriculum_id = 1;
update meto_students set curriculum = "Ugandan Curriculum" where curriculum_id = 2;
            }
        }
    }
}
