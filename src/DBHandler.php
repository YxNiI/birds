<?php

/**
 * Handles database interactions.
 */
final class DBHandler
{
    private function __construct()
    {

    }

    static final function getAllData(): mysqli_result
    {
        $connection = mysqli_connect('localhost', 'root', '', 'birds');
        $result = $connection->query('SELECT birds.name, birds.kind, birds.color
                                            FROM birds
                                            WHERE 1');
        $connection->close();

        return $result;
    }
}
?>