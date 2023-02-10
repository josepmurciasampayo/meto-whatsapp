<?php

namespace App\Services;

use App\Enums\QuestionStatus;
use App\Enums\Student\QuestionType;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;


class QuestionService
{
    public function get(QuestionType $type) :Collection
    {
        $questions = Question::
            where('type', $type())
            ->where('status', QuestionStatus::ACTIVE())
            ->orderBy('order', 'asc')
            ->get();
        return $questions;
    }
}
