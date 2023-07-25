<?php

require_once 'includes/common.php';

use \libAllure\Session;

echo <<<DT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

DT;

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo SITE_TITLE ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel = "stylesheet" type = "text/css" href = "resources/stylesheets/main.css" />
    <link rel = "stylesheet" type = "text/css" href = "resources/stylesheets/jquery.snippet.min.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type = "text/javascript"></script>
    <script src="resources/javascript/jquery.snippet.min.js" type = "text/javascript"></script>
    <script src="resources/javascript/main.js" type = "text/javascript"></script>
</head>

<body>
    <div id = "header">
        <h1><?php echo SITE_TITLE ?> <span class = "subtle"> - Powered by <a href = "https://github.com/jamesread/faridoon">faridoon</a></span></h1>
        <div class = "navbar">
            <ul class = "navigation left">
                <li><a href = "list.php?order=latest">Latest</a></li>
                <li><a href = "list.php?order=random">Random</a></li>
                <li><a href = "list.php?order=rank">Highest voted</a></li>
            </ul>
            <ul class = "navigation right">
                <?php 
                
                if (Session::isLoggedIn()) {         
                    echo '<li>Logged in as <strong>' . Session::getUser()->getUsername() . '</strong></li>';
                    echo '<li><a href = "logout.php">Logout</a></li>';

                    if (isAdmin()) {
                        $sql = 'SELECT count(q.id) countNew FROM quotes q WHERE q.approval = 0';
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $countNew = $stmt->fetch();
                        $countNew = $countNew['countNew'];
                        $countNew = intval($countNew);

                        if ($countNew == 0) {
                            echo '<li><a href = "approvals.php">Approvals</a></li>';
                        } else {
                            echo '<li><a href = "approvals.php">Approvals</a> (' . $countNew . ')</li>';
                        }
                    }
            
                } else { 
                    echo '<li><a href = "login.php">Login</a></li>';
                } ?>

                <li class = "right"><a href = "add.php">Add</a></li>
            </ul>
        </div>
    </div>
    <div id = "content">
<?php


?>
