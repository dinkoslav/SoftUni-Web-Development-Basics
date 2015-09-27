<?php


namespace FRAMEWORK;
class FrontController {
    private static $_instance = null;

    public function __construct(){

    }

    public function dispatch(){
        $a = new \FRAMEWORK\Routers\DefaultRouter();
        $a->parse();
        $controller = $a->getController();
        $method = $a->getMethod();
        if($controller == null){
            $controller = $this->getDefaultController();
        }

        if($method == null){
            $method = $this->getDefaultMethod();
        }

        echo $controller . '<br>' . $method;
    }

    public function getDefaultController(){
        $controller = \FRAMEWORK\App::getInstance()->getConfig()->app['default_controller'];
        if($controller){
            return $controller;
        }

        return 'index';
    }

    public function getDefaultMethod(){
        $method = \FRAMEWORK\App::getInstance()->getConfig()->app['default_method'];
        if($method){
            return $method;
        }

        return 'index';
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