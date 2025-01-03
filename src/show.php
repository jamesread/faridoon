<?php

require_once 'includes/widgets/header.php';

use faridoon\Quote;

$id = filter('id');
$sql = 'SELECT q.id, q.content, q.created, q.approval as approved, q.syntaxHighlighting, COALESCE(SUM(v.delta), 0) AS voteCount FROM quotes q LEFT JOIN votes v ON v.quote = q.id WHERE q.id = :id ORDER BY q.id LIMIT 1';
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

if ($stmt->numRows() == 0) {
    echo '<p>That quote does not exist.</p>';
} else {
    $dbquote = $stmt->fetchRow();
    $quote = new Quote();
    $quote->unmarshalFromDatabase($dbquote);

    include_once 'includes/widgets/quote.php';

    echo '<br /><br /><p>There are <a href = "list.php">many more quotes</a>, just in case this was not as exciting as you expected.</p>';
}

require_once 'includes/widgets/footer.php';
