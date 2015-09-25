<?php
require_once './index.php';

if ($app->isLogged()) {
    header('location: profile.php');
}

if (isset($_POST['username'], $_POST['password'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $app->register($username, $password);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    
    $app->login($username,$password);
    header('location: profile.php');
}

loadTemplate("register");