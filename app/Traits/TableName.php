<?php

namespace App\Traits;

trait TableName
{
    public static function getTableName() :string
    {
        // TODO: figure this out to dynamically get table names from a Model
        $prefix = config('database.connections.mysql.prefix');
        return $prefix ;
    }
}
