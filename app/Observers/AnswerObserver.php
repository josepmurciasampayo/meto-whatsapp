<?php

namespace App\Observers;

use App\Models\Answer;
use App\Models\Student;
use App\Services\AnswerService;
use Barryvdh\Debugbar\Facades\Debugbar;

class AnswerObserver
{
    public function created(Answer $answer): void
    {
        if (in_array($answer->question_id, array_keys(Student::$questions))) {
            $answer->updateStudent();
        }
    }

    public function updated(Answer $answer): void
    {
        if (in_array($answer->question_id, array_keys(Student::$questions))) {
            $answer->updateStudent();
        }
    }
}
