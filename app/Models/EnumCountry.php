<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class EnumCountry extends Model
{
    public static function getArray(bool $idFirst = true) :array
    {
        $toReturn = Helpers::dbQueryArray('
            select id,name from meto_enum_countries
        ');

        if ($idFirst) {
            return $toReturn;
        }
        return array_flip($toReturn);
    }
}
