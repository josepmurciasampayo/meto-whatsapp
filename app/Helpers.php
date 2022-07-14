<?php

namespace App;

use Illuminate\Support\Facades\DB;

/**
 *
 */
class Helpers
{

    public static function dbQueryArray(string $query) :array
    {
        $toReturn = array();
        $initialSet = DB::select($query);

        foreach ($initialSet as $index => $value) {
            $toReturn[$index] = (array) $value;
        }

        return $toReturn;
    }

    /**
     * @param string $csvFileName
     * @return array two-dimensional array generated from CSV
     */
    public static function arrayFromCSV(string $csvFileName) :array
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

    /**
     * @param array $arrayToScan
     * @param array $elementsToRemove
     * @param string $column
     * @return array
     */
    public static function removeElementsInArray(array $arrayToScan, array $elementsToRemove, string $column) :array
    {
        $toReturn = array();
        foreach ($arrayToScan as $element) {
            if (!in_array($element[$column], $elementsToRemove)) {
                $toReturn[] = $element;
            }
        }
        return $toReturn;
    }

    /**
     * @param string $str
     * @return string
     */
    public static function clear_encoding_str(string $str) :string
    {
        return $str;
    }
}
