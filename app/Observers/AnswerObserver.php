<?php

namespace App\Observers;

use App\Models\Answer;
use App\Models\Student;
use Barryvdh\Debugbar\Facades\Debugbar;

class AnswerObserver
{
    public $questions = [
        /* question ID => question column in the student table */
        244 => 'efc',
        104 => 'countryHS',
        318 => 'curriculum',
        288 => 'citizenship',
        290 => 'citizenship_extra',
        13 => 'track',
        260 => 'destination',
        271 => 'gender',
        44 => 'ranking',
        69 => 'det',
        67 => 'act',
        73 => 'toefl',
        70 => 'ielts',
        164 => 'affiliations',
        285 => 'refugee',
        308 => 'disability',
        275 => 'dob',
        296 => 'email_owner',
        312 => 'submission_device',
        283 => 'birth_city',
        281 => 'birth_country',
    ];

    public function created(Answer $answer): void
    {
        if (in_array($answer->question_id, array_keys($this->questions))) {
            $this->updateStudent($answer->student, $answer->question_id, $answer->expanded_text ?? $answer->text);
        }
    }

    public function updated(Answer $answer): void
    {
        if (in_array($answer->question_id, array_keys($this->questions))) {
            $this->updateStudent($answer->student, $answer->question_id, $answer->expanded_text ?? $answer->text);
        }
    }

    public function updateStudent(Student $student, int $question_id, string $answer): void
    {
        switch ($question_id) {
            case 244: $student->efc = $answer;
            case 104: $student->countryHS = $answer;
            case 318: $student->curriculum = $answer;
            case 288: $student->citizenship = $answer;
            case 290: $student->citizenship_extra = $answer;
            case 13: $student->track = $answer;
            case 260: $student->destination = $answer;
            case 271: $student->gender = $answer;
            case 44: $student->ranking = $answer;
            case 69: $student->det = $answer;
            case 67: $student->act = $answer;
            case 73: $student->toefl = $answer;
            case 70: $student->ielts = $answer;
            case 164: $student->affiliations = $answer;
            case 285: $student->refugee = $answer;
            case 308: $student->disability = $answer;
            case 275: $student->dob = $answer;
            case 296: $student->email_owner = $answer;
            case 312: $student->submission_device = $answer;
            case 283: $student->birth_city = $answer;
            case 281: $student->birth_country = $answer;
        }
        $student->save();
    }
}
