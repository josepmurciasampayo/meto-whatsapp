<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/*
 * Answers are the actual input from students to the questions on the forms
 */
class Answer extends Model
{
    /*
     * id
     * question_id
     * student_id
     * response_id
     * text
     * expanded text
     */

    public $guarded = [];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    public function updateStudent(): void
    {
        $this->student->updateFromAnswer($this);
    }
}
