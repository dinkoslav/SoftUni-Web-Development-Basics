<?php
require_once 'Autoloader.php';

session_start();

$uri = $_SERVER['REQUEST_URI'];
$self = $_SERVER['PHP_SELF'];
$index = basename($self);

$directories = str_replace($index, '', $self);
$requestString = str_replace($directories, '', $uri);

$requestParams = explode('/', $requestString);

$controller = array_shift($requestParams);
$action = array_shift($requestParams);

\SoftUni\Autoloader::init();

$fullQualifiedController = '\\SoftUni\\Controllers\\' . ucfirst($controller) . 'Controller';
$controllerInstance = new $fullQualifiedController();

\SoftUni\Core\Database::setInstance(
    \SoftUni\Config\DatabaseConfig::DB_INSTANCE,
    \SoftUni\Config\DatabaseConfig::DB_DRIVER,
    \SoftUni\Config\DatabaseConfig::DB_USER,
    \SoftUni\Config\DatabaseConfig::DB_PASS,
    \SoftUni\Config\DatabaseConfig::DB_NAME,
    \SoftUni\Config\DatabaseConfig::DB_HOST
);

if($controller){
    $app =  new \SoftUni\Application($controller, $action, $requestParams);
    $app->start();
}
