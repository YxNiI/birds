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

    function getAllData(string $tableName, array $columnNames): mysqli_result
    {
        return $this->dbHandler->getAll($tableName, $columnNames);
    }

    function add(string $tableName, array $columnsAndValues): void
    {
        $this->dbHandler->add($tableName, $columnsAndValues);
    }
}

?>