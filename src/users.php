<?php

require_once 'includes/widgets/header.php';

use libAllure\Session;

requireAdmin();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('location: users.php');
    exit;
}

if (isset($_GET['promote'])) {
    $id = $_GET['promote'];

    $sql = "UPDATE users SET `group` = 1 WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('location: users.php');
    exit;
}

if (isset($_GET['demote'])) {
    $id = $_GET['demote'];

    $sql = "UPDATE users SET `group` = 2 WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('location: users.php');
    exit;
}

$sql = "SELECT u.id, u.username, u.`group`, g.title AS  groupTitle FROM users u LEFT JOIN `groups` g ON u.`group` = g.id";
$stmt = $db->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll();

$tpl->assign('currentUid', Session::getUser()->getId());
$tpl->assign('users', $users);
$tpl->display('users.tpl');

require_once 'includes/widgets/footer.php';
