<?php

require_once 'includes/widgets/header.php';

$f = new faridoon\FormQuote();

if ($f->validate()) {
    $f->process();

    $tpl->display('quoteAdded.tpl');

    include_once 'includes/widgets/footer.php';
}

$tpl->displayForm($f);

require_once 'includes/widgets/footer.php';
