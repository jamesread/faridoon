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

    $tpl->displayForm($f);

    if (!$cfg->getBool('DISABLE_REGISTRATION')) {
        $tpl->display('register.tpl');
    }
}

require_once 'includes/widgets/footer.php';
