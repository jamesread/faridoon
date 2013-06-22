<?php

require_once 'includes/widgets/header.php';

$order = filter('order');
switch ($order) {
case 'random':
	$sql = 'SELECT id, content, created, syntaxHighlighting FROM quotes WHERE approval = 1 ORDER BY rand() LIMIT 10';
	break;
case 'latest':
default:
	$sql = 'SELECT id, content, created, syntaxHighlighting FROM quotes WHERE approval = 1 ORDER BY id DESC LIMIT 25';
}

$stmt = $db->prepare($sql);
$stmt->execute();
$quotes = $stmt->fetchAll();

if (count($quotes) == 0) {
	echo '<p>Nobody has posted anything yet.</p>';
} else {
	foreach ($quotes as $quote) {
		require 'includes/widgets/quote.php';
	}
}	

require_once 'includes/widgets/footer.php';

?>
