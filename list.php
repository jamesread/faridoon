<?php

require_once 'includes/widgets/header.php';

$limit = 15;
$order = filter('order');
$page = filter('page');
$page = $page == null ? 0 : $page;

$start = $page * $limit;

$navigable = true;

switch ($order) {
case 'random':
	$sql = 'SELECT SQL_CALC_FOUND_ROWS id, content, created, syntaxHighlighting FROM quotes WHERE approval = 1 ORDER BY rand() LIMIT ' . $start . ', ' . $limit;
	$navigable = false;
	break;
case 'latest':
default:
	$sql = 'SELECT SQL_CALC_FOUND_ROWS id, content, created, syntaxHighlighting FROM quotes WHERE approval = 1 ORDER BY id DESC LIMIT ' . $start . ', ' . $limit;
}

$stmt = $db->prepare($sql);
$stmt->bindValue(':start', $start);
$stmt->execute();
$quotes = $stmt->fetchAll();

$foundRows = intval($db->prepare('SELECT found_rows() AS count')->execute()->fetchColumn());
$numPages = ceil($foundRows / $limit);

$navigable ? pagingLinks($start, $page, $numPages) : null;

if (count($quotes) == 0) {
	echo '<p>Nobody has posted anything yet.</p>';
} else {
	foreach ($quotes as $quote) {
		require 'includes/widgets/quote.php';
	}
}	

$navigable ? pagingLinks($start, $page, $numPages) : randomLink();

require_once 'includes/widgets/footer.php';

?>
