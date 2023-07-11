<?php

namespace App\Observers;

use App\Models\Answer;
use App\Services\AnswerService;
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
            (new AnswerService())->updateStudent($answer->student, $answer->question_id, $answer->text, $answer->expanded_text);
        }
    }

    public function updated(Answer $answer): void
    {
        if (in_array($answer->question_id, array_keys($this->questions))) {
            (new AnswerService())->updateStudent($answer->student, $answer->question_id, $answer->text, $answer->expanded_text);
        }
    }
}
