<?php

require_once 'includes/common.php';

$f = new libAllure\util\FormLogin();

if (libAllure\Session::isLoggedIn()) {
    include_once 'includes/widgets/header.php';

    $tpl->display('loggedin.tpl');

    include_once 'includes/widgets/footer.php';
    die();
}

if ($f->validate()) {
    try {
        $f->process();

        include_once 'includes/widgets/header.php';

        $tpl->display('loggedin.tpl');

        include_once 'includes/widgets/footer.php';
    } catch (Exception $e) {
        include_once 'includes/widgets/header.php';
        var_dump($e);
        echo 'Wrong password. ';
    }
} else {
    include_once 'includes/widgets/header.php';

    echo '<div class = "container">';
    $tpl->displayForm($f);

    $tpl->display('register.tpl');
    echo '</div>';
}

require_once 'includes/widgets/footer.php';
