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

    function getAllData(array $columns, string $table): mysqli_result
    {
        return $this->dbHandler->getAll($columns, $table);
    }

    function modifyData(array $postRequests, string $table): void
    {
        if (empty($postRequests))
        {
            return;
        }
        else
        {
            $buttonAction = $postRequests['button'];
            unset($postRequests['button']);

            if ('save' === $buttonAction)
            {
                $this->dbHandler->add($postRequests, $table);
            }
            elseif ('delete' === $buttonAction)
            {
                $this->dbHandler->delete($postRequests, $table);
            }
        }
    }
}

?>