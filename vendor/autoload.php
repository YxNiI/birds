<?php
spl_autoload_register(function (string $class): void
{
    require_once BASEPATH_LOCAL . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class . '.php';
});
?>