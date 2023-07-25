<?php

use \libAllure\Session;

$usernameColors = array();
$colors = array(
    '#CC0066', '#3399FF', 'green', 'orange'
);

function getCol($username)
{
    global $usernameColors;
    global $colors;

    if (isset($usernameColors[$username])) {
        return $usernameColors[$username];
    } else {
        $col = current($colors); next($colors);
        $usernameColors[$username] = $col;
    }

    return $col;
}

/*
 * Flattening a multi-dimensional array into a
 * single-dimensional one. The resulting keys are a
 * string-separated list of the original keys:
 *
 * a[x][y][z] becomes a[implode(sep, array(x,y,z))]
 */

function array_flatten($array)
{
    $result = array();
    $stack = array();
    array_push($stack, array("", $array));

    while (count($stack) > 0) {
        list($prefix, $array) = array_pop($stack);

        foreach ($array as $key => $value) {
            $new_key = $prefix . strval($key);

            if (is_array($value)) {
                array_push($stack, array($new_key . '.', $value));
            } else {
                $result[$new_key] = $value;
            }
        }
    }

    return $result;
}

function filter($name, $type = FILTER_DEFAULT)
{
    $v = filter_input(INPUT_GET, $name, $type);

    if (empty($v)) {
        $v = filter_input(INPUT_POST, $name, $type);
    }

    return $v;
}

function isAdmin()
{
    if (Session::isLoggedIn()) {
        $admin = Session::getUser()->hasPriv('ADMIN');

        if ($admin) {
            return true;
        }
    }

    return false;
}

function pagingLinks($start, $page, $numPages)
{
    echo '<div class = "pagination">';
    if ($start > 0) { 
        echo '<a href = "list.php?page=' . ($page - 1) . '">&laquo; prev</a> ';
    } else {
        echo '&laquo; prev';
    }

    echo ' <span class = "currentPage">' . ($page + 1) . '/' . ($numPages + 1) . '</span> ';

    if ($page < $numPages) {
        echo '<a href = "list.php?page=' . ($page + 1) . '">next &raquo;</a>';
    } else {
        echo 'next &raquo;';
    }
    echo '</div>';
}

function randomLink()
{
}


?>
