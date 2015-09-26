<?php


namespace FRAMEWORK;
class FrontController {
    private static $_instance = null;

    public function __construct(){

    }

    public function dispatch(){
        $a = new \FRAMEWORK\Routers\DefaultRouter();
        $a->parse();
    }

    /**
     * @return \FRAMEWORK\FrontController
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \FRAMEWORK\FrontController();
        }

        return self::$_instance;
    }
}