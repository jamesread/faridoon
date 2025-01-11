<?php

require_once 'includes/common.php';

requireAdmin();

$f = new faridoon\FormUsergroupGrant();

if ($f->validate()) {
    $f->process();

    redirect('users.php');
}

require_once 'includes/widgets/header.php';

$tpl->displayForm($f);
