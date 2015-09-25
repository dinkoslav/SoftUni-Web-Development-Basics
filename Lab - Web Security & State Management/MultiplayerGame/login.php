<?php
require_once './index.php';

if ($app->isLogged()) {
    header('location: profile.php');
}

if (isset($_POST['username'], $_POST['password'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $app->login($username, $password);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    
    header('location: profile.php');
}

loadTemplate('login');