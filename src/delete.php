<?php

require_once 'includes/widgets/header.php';

if (!isAdmin()) {
    throw new PermissionsException();
}

$sql = 'DELETE FROM quotes WHERE id = :id LIMIT 1';
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', filter('id'));
$stmt->execute();

$tpl->display('quoteDeleted.tpl');

require_once 'includes/widgets/footer.php';
