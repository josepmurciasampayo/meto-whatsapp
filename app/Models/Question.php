<?php

namespace App\Models;

use App\Enums\EnumGroup;
use App\Enums\General\YesNo;
use App\Enums\Student\Curriculum;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    public function curriculum(int $curriculum, bool $inUse = null) :bool
    {
        if ($inUse) {
            $value = ($inUse) ? YesNo::YES() : YesNo::NO();
            $update = "update meto_questions set `" . $curriculum . "` = " . $value . " where id = " . $this->id . ';';
            DB::update($update);
            return true;
        } else {
            return $this->$curriculum == YesNo::YES();
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
                q.' . Curriculum::TRANSFER() . ',
                q.' . Curriculum::KENYAN() . ',
                q.' . Curriculum::RWANDAN() . ',
                q.' . Curriculum::IB() . ',
                q.' . Curriculum::OTHER() . ',
                q.' . Curriculum::CAMBRIDGE() . ',
                q.' . Curriculum::UGANDAN() . ',
                q.' . Curriculum::AMERICAN() . ',
                q.status,
                ifnull(a.count, 0)
            from meto_questions as q
            left outer join (
                select q.id, count(*) as "count"
                from meto_questions as q
                join meto_answers as a on q.id = a.question_id
                group by q.id
            ) as a on a.id = q.id
            order by q.id;
        ');
    }
}
