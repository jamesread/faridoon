<?php

require_once 'includes/widgets/header.php';

requireAdmin();

$f = new faridoon\FormUsergroupCreate();

if ($f->validate()) {
    $f->process();

    redirect('users.php');
}

$tpl->displayForm($f);
