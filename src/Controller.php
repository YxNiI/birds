<?php

/**
 * Mediates between presentation-logic and business-logic.
 */
final class Controller
{
    private $ui;

    function __construct()
    {
        $this->ui = new UI();
    }

    final function run(): void
    {
        $this->ui->displayView(DBHandler::getAllData());
        echo INPUT_GET . 'Hier';
        for ($index = 0; $index < sizeof($_GET); ++$index)
        {
            print_r($_GET[$index]);
            echo 1;
        }
    }
}
?>