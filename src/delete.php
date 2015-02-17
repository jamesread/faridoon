<?php

require_once 'includes/widgets/header.php';

if (!isAdmin()) {
	throw new PermissionsException();
}

$sql = 'DELETE FROM quotes WHERE id = :id LIMIT 1';
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', filter('id'));
$stmt->execute();

echo '<h2>Deleted.</h2>';
echo '<p>Easy come, easy go.</p>';
echo '<p><a href = "index.php">Index</a>, <a href = "approvals.php">Approvals</a>.</p>';

require_once 'includes/widgets/footer.php';

?>
