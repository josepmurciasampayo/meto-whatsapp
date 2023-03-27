<?php

namespace App\Models;

use App\Enums\EnumGroup;
use App\Enums\General\YesNo;
use App\Enums\Student\Curriculum;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function curriculum(Curriculum $curriculum, bool $inUse = null) :bool
    {
        $value = $curriculum();
        if ($inUse) {
            $this->$value = $inUse;
        } else {
            return $this->$value == YesNo::YES();
        }
    }

    public function academicJoin(Curriculum $curriculum) :QuestionScreen
    {
        return QuestionScreen::where('question_id', $this->id)->where('curriculum', $curriculum())->first();
    }

    public function hasResponses() :bool
    {
        return in_array($this->format, [\App\Enums\QuestionFormat::CHECKBOX(), \App\Enums\QuestionFormat::RADIO(), \App\Enums\QuestionFormat::SELECT()]);
    }

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
                q.id,
                q.text,
                q.type,
                q.format,
                q.required,
                `order`,
                q.status,
                q.' . Curriculum::TRANSFER() . ',
                q.' . Curriculum::KENYAN() . ',
                q.' . Curriculum::RWANDAN() . ',
                q.' . Curriculum::IB() . ',
                q.' . Curriculum::OTHER() . ',
                q.' . Curriculum::CAMBRIDGE() . ',
                q.' . Curriculum::UGANDAN() . ',
                q.' . Curriculum::AMERICAN() . ',
                a.count
            from meto_questions as q
            left outer join (
                select q.id, count(*) as "count"
                from meto_questions as q
                left outer join meto_answers as a on q.id = a.question_id
                group by q.id
                order by q.id
            ) as a on a.id = q.id
            ;
        ');
    }
}
