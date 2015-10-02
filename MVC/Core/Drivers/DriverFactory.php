<?php

namespace SoftUni\Core\Drivers;


class DriverFactory
{
    public static function create($dbType, $dbName, $user, $pass, $host = null){
        switch($dbType){
            case 'mysql':
                return new MySQLDriver($user, $pass, $dbName, $host);
        }
    }
}