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

        $businessLogic->addData($ui->getPostRequests(), $ui->getTableName());
        $ui->displayView($businessLogic->getAllData($ui->getColumnNames(), $ui->getTableName()));
    }
}
?>