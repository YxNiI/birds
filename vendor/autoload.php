<?php
spl_autoload_register(function (string $class): void
{
    require_once BASEPATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class . '.php';
});
?>