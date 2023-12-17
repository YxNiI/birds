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

        $size = sizeof($getRequestNames);
        $query = 'INSERT INTO ' . $tableName . ' (';

        for ($index = 0; $index < $size; ++$index)
        {
            if ($index != ($size - 2))
            {
                $query .= $getRequestNames[$index] . ', ';
            }
            else
            {
                $query .= $getRequestNames[$index] . ') ';
            }
        }

        $query .= 'VALUES (';
        for ($index = 0; $index < $size; ++$index)
        {
            if ($index != ($size - 2))
            {
                $query .= '\'' . $_GET[$getRequestNames[$index]] . '\', ';
            }
            else
            {
                $query .= '\'' . $_GET[$getRequestNames[$index]] . '\')';
            }
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