<?php

/**
 * Mediates between presentation-logic and business-logic.
 */
final class Controller
{
    private function __construct()
    {
    }

    static final function run(): void
    {
        $ui = new UI();
        $ui->displayView(DBHandler::getAllData());
        echo INPUT_GET;
    }
}
?>