<?php
error_reporting(E_ALL ^ E_NOTICE);
    include '../../framework/App.php';
    $app = \FRAMEWORK\App::getInstance();
    $app->run();
    echo $config->app['test2'];
