<?php

namespace App\Models;

use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Models\Curriculum;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;

class Question extends Model
{
    /*
     * id
     * text
     * type
     * order
     * format
     * status
     * required
     * help
     * a column for each curriculum
     */

    public function curricula(): HasManyThrough
    {
        // this isn't right
        return $this->HasManyThrough(
            Curriculum::class,
            QuestionCurriculum::class,
            'curriculum_id',
            'id'
        );
    }

    public function curriculum(): BelongsToMany
    {
        return $this->belongsToMany(Curriculum::class)
            ->withPivot([
                'screen',
                'order',
            ]);
    }

    public function academic(): HasMany
    {
        return $this->hasMany(QuestionCurriculum::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function responseCount(): int
    {
        return Response::where('question_id', $this->id)->count();
    }

    public function answerCount(): int
    {
        return Answer::where('question_id', $this->id)->count();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function answersForStudent(int $student_id)
    {
        return $this->answers()->where('student_id', '=', $student_id);
    }

    public function hasResponses() :bool
    {
        return in_array($this->format, QuestionFormat::hasResponses());
    }

    public function requiredString(): string
    {
        if (!$this->exists) { // for admin creating a question
            return false;
        }
        return ($this->required == YesNo::YES()) ? "true" : "false";
    }
}
