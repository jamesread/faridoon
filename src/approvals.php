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

    $tpl->display('quoteApproved.tpl');
}

$sql = 'SELECT id, "?" as voteCount, content, approval as approved, date_format(created, "%Y-%m-%d") AS created FROM quotes WHERE approval = 0';
$stmt = $db->prepare($sql);
$stmt->execute();
$quotes = $stmt->fetchAll();

$tpl->assign('count', count($quotes));
$tpl->display('approveHeader.tpl');

foreach ($quotes as $dbquote) {
    $quote = new faridoon\Quote();
    $quote->unmarshalFromDatabase($dbquote);

    include 'includes/widgets/quote.php';
}

require_once 'includes/widgets/footer.php';
