<?php

namespace App;

use App\Enums\General\Channel;
use App\Models\LogComms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class Helpers
{
    public static function dbQueryArray(string $query) :array
    {
        $start = now();
        $toReturn = array();
        $initialSet = DB::select($query);

        foreach ($initialSet as $index => $value) {
            $toReturn[$index] = (array) $value;
        }

        $end = now();
        Log::channel('db')->debug('Query took ' . $end->diffInMilliseconds($start) . ' ms: ' . $query . "<br/><br/>" . print_r($toReturn, true));
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
     * @return array initial array without removed elements
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

    public static function log($channel, $from, $to, $body)
    {
        $log = new LogComms([
            'channel' => $channel,
            'from' => $from,
            'to' => $to,
            'body' => $body,
        ]);
        $log->save();
        Log::channel('chat')->debug($log);
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
