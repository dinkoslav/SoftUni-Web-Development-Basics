<?php


class DB {
    protected static $db = null;

    protected function __construct() {}

    static public function getInstance()
    {
        if (self::$db == null) {
            try {
                self::$db = new PDO('mysql:host=localhost:3306;dbname=translations', 'root', '123456');
            } catch (PDOException $e) {
                die('<h1>Sorry. The Database connection is temporarily unavailable.</h1>');
            }
            return self::$db;
        } else {
            return self::$db;
        }
    }
}