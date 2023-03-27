<?php

namespace ArchTech\Enums;

use BackedEnum;

trait Strings
{
    /** Get a string from an array in the form: index => element, etc */
    public static function toString(bool $nameFirst = true): string
    {
        $cases = static::cases();

        $array = array_column($cases, 'value', 'name');

        if ($nameFirst) {
            $array = array_flip($array);
        }

        $toReturn = "";
        foreach ($array as $index => $element) {
            $toReturn .= $index . " => " . $element . ", ";
        }
        $toReturn = substr($toReturn, 0, -2);
        return $toReturn;
    }

    public static function descriptions($includeBlank = false) :array
    {
        $cases = static::cases();

        $toReturn = array();
        foreach ($cases as $index => $value) {
            $toReturn[$value()] = self::getText($value);
        }
        if ($includeBlank) {
            $toReturn[''] = '';
        }

        return $toReturn;
    }
}

