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
        $businessLogic = new BusinessLogic();

        $ui->displayView($businessLogic->getAllData());
    }
}
?>