<?php

namespace FRAMEWORK;
include_once 'Loader.php';
class App {
    private static $_instance = null;
    private $_config = null;
    private $_frontController = null;

    public function __construct(){
        \FRAMEWORK\Loader::registerNamespaces('FRAMEWORK', dirname(__FILE__) . DIRECTORY_SEPARATOR);
        \FRAMEWORK\Loader::registerAutoLoad();
        $this->_config = \FRAMEWORK\Config::getInstance();
    }

    public function run(){
        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }

        $this->_frontController = \FRAMEWORK\FrontController::getInstance();
        $this->_frontController->dispatch();
    }

    /**
     * @return \FRAMEWORK\Config
     */
    public function getConfig(){
        return $this->_config;
    }

    public function setConfigFolder($path){
        $this->_config->setConfigFolder($path);
    }

    public function getConfigFolder(){
        return $this->getConfigFolder();
    }

    /**
     * @return \FRAMEWORK\App
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \FRAMEWORK\App();
        }

        return self::$_instance;
    }
}