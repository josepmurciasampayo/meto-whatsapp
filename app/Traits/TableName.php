<?php

namespace App\Traits;

trait TableName
{
    public static function getTableName() :string
    {
        $prefix = config('database.connections.mysql.prefix');
        return $prefix ;
    }
}
