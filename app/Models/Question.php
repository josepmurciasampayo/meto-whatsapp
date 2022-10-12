<?php

namespace App\Models;

use App\Enums\Student\Curriculum;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static function findByText(string $text) :?Question
    {
        $existing = Question::where('text', $text);
        if ($existing->count() == 0) {
            return null;
        } else {
            return $existing->first();
        }
    }

    public static function getAdminData() :array
    {
        return Helpers::dbQueryArray('
            select
                id,
                text,
                type,
                order,
                ' . Curriculum::TRANSFER() . ',
                ' . Curriculum::KENYAN() . ',
                ' . Curriculum::RWANDAN() . ',
                ' . Curriculum::IB() . ',
                ' . Curriculum::OTHER() . ',
                ' . Curriculum::CAMBRIDGE() . ',
                ' . Curriculum::UGANDAN() . ',
                ' . Curriculum::AMERICAN() . '
            from meto_questions;
        ');
    }
}
