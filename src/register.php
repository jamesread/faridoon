<?php

require_once 'includes/common.php';

use libAllure\util\FormRegister;

$f = new FormRegister();

if ($f->validate()) {
    $f->process();

    $uid = $db->lastInsertId();

    $sql = 'SELECT * FROM users';
    $stmt = $db->prepare($sql);
    $stmt->execute();


    require_once 'includes/widgets/header.php';

    echo '<div class = "container">';
    echo '<section><p>You have been registered. You can now login.</p>';

    $sql = 'UPDATE users SET `group` = :gid WHERE id = :uid LIMIT 1';
    $stmt = $db->prepare($sql);
    $stmt->bindValue('uid', $uid);


    if ($stmt->numRows() == 1) {
        $gid = 1;

        echo '<p>You have been promoted to admin as you are the first registered user.</p>';
    } else {
        $gid = 2;
    }

    $stmt->bindValue('gid', $gid);
    $stmt->execute();

    echo '<p><a href = "login.php">Login</a></p>';
    echo '</section></div>';
} else {
    include_once 'includes/widgets/header.php';

    echo '<div class = "container">';

    $tpl->displayForm($f);

    echo '</div>';
    include_once 'includes/widgets/footer.php';
}
