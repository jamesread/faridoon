<?php

require_once 'includes/widgets/header.php';

$id = filter('id');
$sql = 'SELECT id, content, created, syntaxHighlighting FROM quotes WHERE id = :id ORDER BY id LIMIT 1';
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

if ($stmt->numRows() == 0) {
	echo '<p>That quote does not exist.</p>';
} else {
	$quote = $stmt->fetchRow();

	require_once 'includes/widgets/quote.php';

	echo '<br /><br /><p>There are <a href = "list.php">many more quotes</a>, just in case this was not as exciting as you expected.</p>';
}	

require_once 'includes/widgets/footer.php';

?>
