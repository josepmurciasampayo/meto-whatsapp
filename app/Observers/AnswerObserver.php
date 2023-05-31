<?php

namespace App\Observers;

use App\Models\Answer;
use App\Models\Student;

class AnswerObserver
{
    /**
     * Handle the Answer "created" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function created(Answer $answer)
    {
        //
    }

    /**
     * Handle the Answer "updated" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function updated(Answer $answer)
    {
        $questions = [
            /* question ID => question column in the student table */
            244 => 'efc',
            104 => 'countryHS'
        ];

        $answer->student->update([
            $questions[$answer->question_id] => $answer->text
        ]);
    }

    /**
     * Handle the Answer "deleted" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function deleted(Answer $answer)
    {
        //
    }

    /**
     * Handle the Answer "restored" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function restored(Answer $answer)
    {
        //
    }

    /**
     * Handle the Answer "force deleted" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function forceDeleted(Answer $answer)
    {
        //
    }
}
