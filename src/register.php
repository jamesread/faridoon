<?php

require_once 'includes/common.php';
require_once 'libAllure/util/FormRegister.php';

use \libAllure\FormRegister;

$f = new FormRegister();

if ($f->validate()) {
    $f->process();

    header('Location: login.php');
} else {
    include_once 'includes/widgets/header.php';
    $tpl->displayForm($f);
    include_once 'includes/widgets/footer.php';
}

?>
