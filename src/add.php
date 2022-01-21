<?php

require_once 'includes/widgets/header.php';
require_once 'includes/classes/FormQuote.php';

$f = new FormQuote();

if ($f->validate()) {
    $f->process();

    echo '<p>Oh goodie. Another quote!</p>';

    if (!isAdmin()) {
        echo '<p class = "good">Your quote needs approval before it shows up in the list.</p>';
    }

    include_once 'includes/widgets/footer.php';
}

$tpl->displayForm($f);

require_once 'includes/widgets/footer.php';

?>
