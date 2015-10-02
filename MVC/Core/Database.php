<?php

namespace SoftUni\Core;


use SoftUni\Core\Drivers\DriverFactory;

class Database
{
    static $inst = [];
    private $db;

    private function __construct($db){
        $this->db = $db;
    }

    public static function getInstance($instanceName = 'default'){
        if(!isset(self::$inst[$instanceName])){
            throw new \Exception('Instance with that name was not set');
        }

        return self::$inst[$instanceName];
    }

    public static function setInstance(
        $instanceName,
        $driver,
        $user,
        $pass,
        $dbName,
        $host = null
    ) {
        $driver = DriverFactory::create($driver, $dbName, $user, $pass, $host);

        $pdo = new \PDO(
            $driver->getDsn(),
            $user,
            $pass
        );

        self::$inst[$instanceName] = new self($pdo);
    }

    /*
     * @param string $statement
     * @param array $driverOptions
     * @return Statement
     */

    public function prepare($statement, array $driverOptions = []){
        return $this->db->prepare($statement, $driverOptions);
    }

    public function query($query){
        $this->db->query($query);
    }

    public function lastId($name = null){
        return $this->db->lastInsertId($name);
    }
}