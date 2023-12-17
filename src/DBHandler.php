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

        return $this->execute($query);
    }

    final function add(array $postRequests, string $table): void
    {
        // TODO: Return boolean if it worked. (Or rather let the view handle the checking first.)
        // TODO: Reset with: ,,unset()''-function.

        $query = 'INSERT INTO ' . $table . ' (';
        foreach ($postRequests as $key => $value)
        {
            if ($key !== array_key_last($postRequests))
            {
                $query .= $key . ', ';
            }
            else
            {
                $query .= $key . ') ';
            }
        }

        $query .= 'VALUES (';
        foreach ($postRequests as $key => $value)
        {
            if ($key !== array_key_last($postRequests))
            {
                $query .= '\'' . $value . '\', ';
            }
            else
            {
                $query .= '\'' . $value . '\')';
            }
        }

        $this->execute($query);
    }

    final function delete(array $postRequests, string $table)
    {
        $query = 'DELETE FROM ' . $table . ' WHERE 1 ';

        foreach ($postRequests as $key => $value)
        {
            if ($key !== array_key_last($postRequests))
            {
                $query .= 'AND ' . $key . ' = \'' . $value . '\' ';
            }
            else
            {
                $query .= 'AND ' . $key . ' = \'' . $value . '\'';
            }
        }

        $this->execute($query);
    }

    private final function execute(string $query): mysqli_result
    {
        $connection = mysqli_connect($this->hostName, $this->userName, $this->password, $this->database);
        $result = $connection->query($query);
        $connection->close();

        return $result;
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