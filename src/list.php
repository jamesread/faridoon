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
    $navigable = false;
    $order = 'rand()';
    break;
case 'rank':
    $order = 'voteCount DESC, created'; 
    break;
case 'latest':
default:
    $order = 'q.created';
}

$sql = 'SELECT SQL_CALC_FOUND_ROWS q.id, q.content, date_format(q.created, "%Y-%m-%d") AS created, q.syntaxHighlighting, COALESCE(SUM(v.delta), 0) AS voteCount FROM quotes q LEFT JOIN votes v ON v.quote = q.id WHERE approval = 1 GROUP BY q.id ORDER BY ' . $order . ' DESC LIMIT ' . $start . ', ' . $limit;

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
        include 'includes/widgets/quote.php';
    }
}    

$navigable ? pagingLinks($start, $page, $numPages) : randomLink();

require_once 'includes/widgets/footer.php';

?>
