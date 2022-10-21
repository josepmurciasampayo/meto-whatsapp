<?php

namespace App\Models;

use App\Enums\EnumGroup;
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
                q.id,
                text,
                q_type.enum_desc as "type",
                `order`,
                if(isnull(u.question_id), "Y", "N") as in_use,
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
            left outer join question_ids_in_use as u on u.question_id = q.id
            left outer join meto_enum as q_type on enum_id = q.type and group_id = ' . EnumGroup::GENERAL_QUESTIONTYPE() . '
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
