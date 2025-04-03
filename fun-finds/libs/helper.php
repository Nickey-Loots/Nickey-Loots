<?php

/**
    (var_)dump variable(s)
    No params, just get vars from func_get_args function
 */
function dd()
{
    $args = func_get_args();

    if (count($args)) {
        echo "<pre>";

        foreach ($args as $arg) {
            var_dump($arg);
        }

        echo "</pre>";

        die();
    }
}

function getPage()
{

    if (isset($_GET['page']) && trim($_GET['page']) != '') {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $admin = array_search('admin', $url) !== false ? 'admin' : '';

        if (file_exists('../resources/views/' . $admin . '/' . $_GET['page'] . '.view.php')) {
            return '../resources/views/' . $admin . '/' . $_GET['page'] . '.view.php';
        } else {
            echo '404';
            exit(404);
        }
    }

    return '../resources/views/home.view.php';
}

function dbConnect()
{
    $db_name = 'mysql:host=localhost;dbname=' . $_ENV['DB_NAME'];

    $conn = new PDO($db_name, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    return $conn;
}

