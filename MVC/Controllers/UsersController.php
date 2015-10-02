<?php

namespace SoftUni\Controllers;

use SoftUni\Models\Building;
use SoftUni\Models\User;
use SoftUni\View;
use SoftUni\ViewModels\BuildingsInformation;
use SoftUni\ViewModels\LoginInformation;
use SoftUni\ViewModels\ProfileInformation;
use SoftUni\ViewModels\RegisterInformation;

class UsersController extends Controller
{
    public function register(){
        $viewModel = new RegisterInformation();

        if(isset($_POST['username'], $_POST['password'])) {
            try{
                $user = $_POST['username'];
                $pass = $_POST['password'];

                $userModel = new User();
                $userModel->register($user, $pass);

                $this->initLogin($user, $pass);
            } catch (\Exception $e) {
                $viewModel->error = $e->getMessage();
                return new View($viewModel);
            }
        }

        return new View($viewModel);
    }

    public function login(){
        $viewModel = new LoginInformation();

        if(isset($_POST['username'], $_POST['password'])){
            try {
                $user = $_POST['username'];
                $pass = $_POST['password'];

                $this->initLogin($user, $pass);
            } catch (\Exception $e) {
                $viewModel->error = $e->getMessage();
                return new View($viewModel);
            }
        }

        return new View($viewModel);
    }

    public function profile(){
        $viewModel = new ProfileInformation();
        $user = new User();
        $info = $user->getInfo($_SESSION['id']);
        $viewModel->food = $info['food'];
        $viewModel->gold = $info['gold'];
        $viewModel->username = $info['username'];

        if(isset($_POST['edit'])){
            if($_POST['password'] != $_POST['confirm'] || empty($_POST['password'])){
                $viewModel->error = "Passwords do not match";
                return new View($viewModel);
            }

            try {
                $user->edit($_POST['username'], $_POST['password'], $_SESSION['id']);
            } catch (\Exception $e) {
                $viewModel->error = $e->getMessage();
                return new View($viewModel);
            }
        }

        return new View($viewModel);
    }

    public function buildings($id = null){
        $viewModel = new BuildingsInformation();
        $user = new User();
        $building = new Building();
        $info = $user->getInfo($_SESSION['id']);
        $viewModel->food = $info['food'];
        $viewModel->gold = $info['gold'];
        $buildings = $building->getBuildings($_SESSION['id']);
        $viewModel->buildings = $buildings;

        if(isset($id)) {
            try {
                $building->evolveBuilding($_SESSION['id'], $id, $info['gold'], $info['food']);
                var_dump($_SERVER['PHP_SELF']);
                header('Location: buildings');
                /**
                 * Problem with the header function - expand for more info
                 * it appends "/buildings" to the current url =>
                 * becomes /buildings/buildings - don't know how to solve it
                 */
                exit;
            } catch (\Exception $e) {
                $viewModel->error = $e->getMessage();
                return new View($viewModel);
            }
        }

        return new View($viewModel);
    }

    private function initLogin($user, $pass)
    {
        $userModel = new User();
        $userId = $userModel->login($user, $pass);
        $_SESSION['id'] = $userId;
        header('Location: profile');
    }
}