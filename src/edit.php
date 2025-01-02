<?php

require_once 'includes/widgets/header.php';
require_once 'includes/classes/FormQuote.php';

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

        echo '<h2>Quote edited.</h2>';
        echo '<p><a href = "show.php?id=' . $f->getElementValue('id') . '">#' . $f->getElementValue('id') . '</a></p>';

        include_once 'includes/widgets/footer.php';
    }

    $tpl->displayForm($f);
}

require_once 'includes/widgets/footer.php';
