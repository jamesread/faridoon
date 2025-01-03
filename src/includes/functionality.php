<?php

use libAllure\Session;

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

    echo ' <span class = "currentPage">' . ($page + 1) . '</span> of <span class = "currentPage">' . ($numPages + 1) . '</span> ';

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

function outputJson($o)
{
    header('Content-Type: application/json');
    echo json_encode($o);
    exit;
}

function getCountApprovals()
{
    $sql = 'SELECT count(q.id) countNew FROM quotes q WHERE q.approval = 0';
    $stmt = libAllure\DatabaseFactory::getInstance()->prepare($sql);
    $stmt->execute();
    $countNew = $stmt->fetch();
    $countNew = $countNew['countNew'];
    $countNew = intval($countNew);

    return $countNew;
}
