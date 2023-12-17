<?php
$relativePathToCurrFile = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
$relativePath = str_replace('index.php', '', $relativePathToCurrFile);

define('BASEPATH_LOCAL', realpath(dirname(__FILE__)));
define('BASEPATH_SERVER', 'http://' . $_SERVER['HTTP_HOST'] . $relativePath);

require_once(BASEPATH_LOCAL . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

Controller::run();
?>