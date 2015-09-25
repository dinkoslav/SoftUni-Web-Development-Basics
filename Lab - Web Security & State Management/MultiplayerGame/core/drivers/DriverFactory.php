<?php
namespace Core\Drivers;

class DriverFactory 
{
    public static function create($driver, $user, $pass, $dbName, $host) 
    {
        if ($driver == 'mysql') {
            return new \Core\Drivers\MySQLDriver($user, $pass, $dbName, $host);
        } else {
            throw new \Exception('No valid driver.');
        }
    }
}