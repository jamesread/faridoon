<?php

require_once 'includes/common.php';

use libAllure\util\FormRegister;

$f = new FormRegister();

if ($f->validate()) {
    $f->process();

    require_once 'includes/widgets/header.php';

    echo '<div class = "container">';
    echo '<section>You have been registered. You can now login.</section>';
    echo '</div>';

    require_once 'login.php';
} else {
    include_once 'includes/widgets/header.php';

    echo '<div class = "container">';

    $tpl->displayForm($f);

    echo '</div>';
    include_once 'includes/widgets/footer.php';
}
