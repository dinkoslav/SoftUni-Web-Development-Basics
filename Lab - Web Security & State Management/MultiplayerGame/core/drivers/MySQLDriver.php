<?php
namespace Core\Drivers;

class MySQLDriver extends \Core\Drivers\DriverAbstract 
{
    public function getDsn() 
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
        return $dsn;
    }
}
