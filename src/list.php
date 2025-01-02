<?php

require_once 'includes/widgets/header.php';

use faridoon\Quote;

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

$sql = 'SELECT SQL_CALC_FOUND_ROWS q.id, q.content, q.approval as approved, date_format(q.created, "%Y-%m-%d") AS created, q.syntaxHighlighting, COALESCE(SUM(v.delta), 0) AS voteCount FROM quotes q LEFT JOIN votes v ON v.quote = q.id WHERE approval = 1 GROUP BY q.id ORDER BY ' . $order . ' DESC LIMIT ' . $start . ', ' . $limit;

$stmt = $db->prepare($sql);
$stmt->execute();
$quotes = $stmt->fetchAll();

$foundRows = intval($db->prepare('SELECT found_rows() AS count')->executeRet()->fetchColumn());
$numPages = ceil($foundRows / $limit);

$navigable ? pagingLinks($start, $page, $numPages) : null;

if (count($quotes) == 0) {
    echo '<section><h2>Uh-oh</h2><p>Nobody has posted anything yet.</p></section>';
} else {
    foreach ($quotes as $dbquote) {
        $quote = new Quote();
        $quote->unmarshalFromDatabase($dbquote);

        include 'includes/widgets/quote.php';
    }
}

pagingLinks($start, $page, $numPages);

require_once 'includes/widgets/footer.php';
