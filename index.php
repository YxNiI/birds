<?php
session_start();
define('BASEPATH', realpath(dirname(__FILE__)));
require_once(BASEPATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$controller = null;
if (!empty($_SESSION['controller']))
{
    $controller = unserialize($_SESSION['controller']);
}
else
{
   $controller = new Controller();
}

$controller->run();
$_SESSION['controller'] = serialize($controller);
?>