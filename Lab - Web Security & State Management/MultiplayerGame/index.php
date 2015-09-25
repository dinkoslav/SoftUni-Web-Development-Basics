<?php 
session_start();
spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class);
    require_once $classPath . '.php';
});

require_once './core/App.php';
$db = \Core\Database::setInstance(
    \Config\DatabaseConfig::DB_INSTANCE,
    \Config\DatabaseConfig::DB_DRIVER,
    \Config\DatabaseConfig::DB_USER,
    \Config\DatabaseConfig::DB_PASS,
    \Config\DatabaseConfig::DB_NAME,
    \Config\DatabaseConfig::DB_HOST
    );

/**
 * @var \Core\App
 */
$app = new \Core\App(Core\Database::getInstance(\Config\DatabaseConfig::DB_INSTANCE));

function loadTemplate($templateName, $data = null)
{
    require_once 'templates/' . $templateName . '.php';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Multiplayer game</title>
    </head>
    <body>
        <?php if(!$app->isLogged()): ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <?php endif; ?>
    </body>
</html>
