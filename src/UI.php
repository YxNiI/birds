<?php

/**
 * Builds and displays the user-interface.
 */
final class UI
{
    private $view;

    function __construct()
    {
        $this->view = file_get_contents(BASEPATH_LOCAL . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'index.html');
        $path = BASEPATH_SERVER . 'resources/static/';

        $this->view = str_replace('[[*styles]]', $path . 'styles.css', $this->view);
        $this->view = str_replace('[[*favicon]]', $path . 'favicon.ico', $this->view);
        $this->view = str_replace('[[*action]]', BASEPATH_SERVER . '/index.php', $this->view);
    }

    final function getGetRequests(): array
    {
        if (!empty($_GET))
        {
            return$_GET;
        }
        else
        {
            return [];
        }
    }

    final function displayView(mysqli_result $businessResult): void
    {
        $viewWithData = $this->view;
        $result = '';

        for ($row = $businessResult->fetch_row(); $row !== null; $row = $businessResult->fetch_row())
        {
            $result .= '<tr><td>' .  $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td></tr>';
        }
        $viewWithData = str_replace('[[*birds]]', $result, $viewWithData);
        $viewWithData = str_replace('[[*hint]]', '', $viewWithData);

        print_r($viewWithData);
    }

    final function getTableName(): string
    {
        return 'birds';
    }

    final function getColumnNames(): array
    {
        return ['name', 'kind', 'color'];
    }
}
?>
