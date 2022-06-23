<?php

namespace App;

class Helpers
{
    public static function arrayFromCSV($csvFileName) :array
    {
        $toReturn = array();

        // open csv
        $array = array_map('str_getcsv', file($csvFileName));

        // Get field names from header column and remove the header column
        $fields = array_map('strtolower', $array[0]);
        array_shift($array);


        foreach ($array as $row) {
            $row =  array_map("html_entity_decode", $row);
            $toReturn[] = array_combine($fields, $row);
            //$row = Helpers::clear_encoding_str($row);
        }

        return $toReturn;
    }

    public static function clear_encoding_str(string $str) :string
    {
        return $str;
    }
}
