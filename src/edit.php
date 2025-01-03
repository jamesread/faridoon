<?php

require_once 'includes/widgets/header.php';

use faridoon\FormQuote;

$sql = 'SELECT id, content, syntaxHighlighting FROM quotes WHERE id = :itemId LIMIT 1';
$stmt = $db->prepare($sql);
$stmt->bindValue('itemId', filter('id'));
$stmt->execute();
$quote = $stmt->fetch();

if (empty($quote)) {
    echo '<p>Oh dear, I cannot find that quote. Ah, for that matter, I dont think I can find my marbles!</p>';

    include_once 'includes/widgets/footer.php';
} else {
    $f = new FormQuote($quote);

    if ($f->validate()) {
        $f->process();

        $tpl->assign('quoteId', $f->getElementValue('id'));
        $tpl->display('quoteEdited.tpl');

        require_once 'show.php';

        include_once 'includes/widgets/footer.php';
    }

    $tpl->displayForm($f);
}

require_once 'includes/widgets/footer.php';
