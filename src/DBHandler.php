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

    final function getAll(array $columns, string $table): mysqli_result
    {
        $size = sizeof($columns);

        $query = 'SELECT ';
        for ($index = 0; $index < $size; ++$index)
        {
            if ($index !== ($size - 1))
            {
                $query .= $columns[$index] . ', ';
            }
            else
            {
                $query .= $columns[$index] . ' ';
            }
        }
        $query .= 'FROM ' . $table . ' WHERE 1';

        $connection = $this->getConnection();
        $result = $connection->query($query);
        $connection->close();

        return (false === $result) ? new mysqli_result() : $result;
    }

    final function add(array $postKeysAndValues, string $table): void
    {
        // TODO: Return boolean if it worked. (Or rather let the view handle the checking first.)
        // TODO: Reset with: ,,unset()''-function.

        $query = 'INSERT INTO ' . $table . ' (';
        foreach ($postKeysAndValues as $key => $value)
        {
            if ($key !== array_key_last($postKeysAndValues))
            {
                $query .= $key . ', ';
            }
            else
            {
                $query .= $key . ') ';
            }
        }

        $query .= 'VALUES (';
        foreach ($postKeysAndValues as $key => $value)
        {
            if ($key !== array_key_last($postKeysAndValues))
            {
                $query .= '\'' . $value . '\', ';
            }
            else
            {
                $query .= '\'' . $value . '\')';
            }
        }

        $connection = $this->getConnection();
        $connection->query($query);
        $connection->close();
    }

    final function delete(array $postKeysAndValues, string $table)
    {
        $query = 'DELETE FROM ' . $table . ' WHERE 1 ';

        foreach ($postKeysAndValues as $key => $value)
        {
            if ($key !== array_key_last($postKeysAndValues))
            {
                $query .= 'AND ' . $key . ' = \'' . $value . '\' ';
            }
            else
            {
                $query .= 'AND ' . $key . ' = \'' . $value . '\'';
            }
        }

        $connection = $this->getConnection();
        $connection->query($query);
        $connection->close();
    }

    final function getConnection(): mysqli
    {
        return mysqli_connect($this->hostName, $this->userName, $this->password, $this->database);

    }

    final function setHostName(string $hostName): void
    {
        $this->hostName = $hostName;
    }

    final function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    final function setPassword(string $password): void
    {
        $this->password = $password;
    }

    final function setDatabase(string $database): void
    {
        $this->database = $database;
    }
}

?>