<?php

/**
 * Handles database interactions.
 */
final class DBHandler
{
    private $hostName;
    private $userName;
    private $password;
    private $database;

    final function getAll(string $tableName, array $columnNames): mysqli_result
    {
        // TODO: Add the query generation.
        // TODO: And handling of booleans.

        $connection = $this->getConnection();
        $result = $connection->query('SELECT birds.name, birds.kind, birds.color
                                            FROM birds
                                            WHERE 1');
        $connection->close();

        return $result;
    }

    final function add(string $tableName, array $getRequestNames): void
    {
        // TODO: Return boolean if it worked. (Or rather let the view handle the checking first.)
        // TODO: Reset with: ,,unset()''-function.

        $query = 'INSERT INTO ' . $tableName . ' (';

        foreach ($getRequestNames as $key => $value)
        {
            if ($key !== array_key_last($getRequestNames))
            {
                $query .= $key . ', ';
            }
            else
            {
                $query .= $key . ') ';
            }
        }

        $query .= 'VALUES (';
        foreach ($getRequestNames as $key => $value)
        {
            if ($key !== array_key_last($getRequestNames))
            {
                $query .= '\'' . $value . '\', ';
            }
            else
            {
                $query .= '\'' . $value . '\')';
            }

            unset($getRequestNames[$key]);
        }

        $connection = $this->getConnection();
        $connection->query($query);
        $connection->close();
    }

    private function getConnection(): mysqli
    {
        return mysqli_connect($this->hostName, $this->userName, $this->password, $this->database);

    }

    public final function setHostName(string $hostName): void
    {
        $this->hostName = $hostName;
    }

    public final function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public final function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public final function setDatabase(string $database): void
    {
        $this->database = $database;
    }
}

?>