<?php

namespace SoftUni\Controllers;


class Controller
{
    public function isLogged(){
        return isset($_SESSION['id']);
    }
}