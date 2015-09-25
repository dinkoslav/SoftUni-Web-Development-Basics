<?php /** @var \Core\User $app */ ?>
<?php
require_once './index.php';

if (!$app->isLogged()) {
    header('location: login.php');
}

loadTemplate('profile', $app->getUser());

if (isset($_POST['username'], $_POST['password'], $_POST['confirm'])) {
    if ($_POST['password'] != $_POST['confirm'] || empty($_POST['password'])) {
        header('location: profile.php?error=1');
        exit;
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_SESSION['id'];
    $user = new \Core\User($username, $password, $id);

    if ($app->editUser($user)) {
        header('location: profile.php?success=1');
        exit;
    };
        
    header('location: profile.php?error=1');
    exit;
}