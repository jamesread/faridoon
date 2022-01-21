<?php

require_once 'includes/widgets/header.php';

if (!isAdmin()) {
    echo '<p class = "bad">You are no admin that I know of. Go away.</p>';
    include_once 'includes/widgets/footer.php';
}

$approveId = filter('approveId');

if (!empty($approveId)) {
    $sql = 'UPDATE quotes SET approval = 1 WHERE id = :itemId ';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':itemId', $approveId);
    $stmt->execute();

    echo '<p class = "good">Approved. You probably just made somebody very happy.</p>';
}

$sql = 'SELECT id, "?" as voteCount, content, approval, date_format(created, "%Y-%m-%d") AS created FROM quotes WHERE approval = 0';
$stmt = $db->prepare($sql);
$stmt->execute();
$quotes = $stmt->fetchAll();

if (count($quotes) == 0) {
    echo '<p>Nothing to approve here. Prehaps you would like a crumpet instead?</p>';
} else {
    echo '<p><strong>Ooh, there are items to approve.</strong></p>';

    foreach ($quotes as $quote) {
        include 'includes/widgets/quote.php';
    }
}

require_once 'includes/widgets/footer.php';

?>
