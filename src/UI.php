<?php

/**
 * Builds and displays the user-interface.
 */
final class UI
{
    private $view;

    function __construct()
    {
        $path = BASEPATH . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR;

        $this->view = file_get_contents($path . 'index.html');
        $this->view = str_replace('[[*styles]]', '<style>' . file_get_contents($path . 'styles.css') . '</style>', $this->view);
    }

    final function displayView(mysqli_result $businessResult): void
    {
        $result = '';


        for ($row = $businessResult->fetch_row(); $row != NULL; $row = $businessResult->fetch_row())
        {
            $result .= '<tr><td>' .  $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td></tr>';
        }
        $this->view = str_replace('[[*birds]]', $result, $this->view);

        print_r($this->view);
    }
}

?>
