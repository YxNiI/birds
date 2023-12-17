<?php

/**
 * Executes the business-logic.
 */
final class BusinessLogic
{
    private $dbHandler;

    function __construct()
    {
        $this->dbHandler = new DBHandler();
        $this->dbHandler->setHostName('localhost');
        $this->dbHandler->setUserName('root');
        $this->dbHandler->setPassword('');
        $this->dbHandler->setDatabase('birds');
    }

    function getAllData(): mysqli_result
    {
        return $this->dbHandler->getAll('', '');
    }

    function addDataFromServer(): void
    {
        $this->dbHandler->addFromServer('birds', '');
    }
}