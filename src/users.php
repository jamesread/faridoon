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

    redirect('users.php');
}

if (isset($_GET['deleteGroup'])) {
    $id = intval($_GET['deleteGroup']);

    if ($id <= 2) {
        simpleFatalError('You cannot delete the default groups.');
    }

    $sql = "DELETE FROM `groups` WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    redirect('users.php');
}

if (isset($_GET['revokePermission'])) {
    $pid = intval($_GET['revokePermission']);
    $gid = intval($_GET['gid']);

    $sql = "DELETE FROM privileges_g WHERE `permission` = :pid AND `group` = :gid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':pid', $pid);
    $stmt->bindParam(':gid', $gid);
    $stmt->execute();

    redirect('users.php');
}

$sql = "SELECT u.id, u.username, u.`group`, g.title AS  groupTitle FROM users u LEFT JOIN `groups` g ON u.`group` = g.id";
$stmt = $db->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll();

$tpl->assign('currentUid', Session::getUser()->getId());
$tpl->assign('users', $users);


$sql = 'SELECT g.id, g.title FROM `groups` g';
$stmt = $db->prepare($sql);
$stmt->execute();

$groups = array();

foreach ($stmt->fetchAll() as $usergroup) {
    $sql = 'SELECT gp.permission AS pid, p.`key`, p.description FROM privileges_g gp LEFT JOIN permissions p ON gp.permission = p.id WHERE gp.group = :gid';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':gid', $usergroup['id']);
    $stmt->execute();


    $groups[$usergroup['id']] = array (
        'id' => $usergroup['id'],
        'title' => $usergroup['title'],
        'permissions' => $stmt->fetchAll(),
    );
}

$tpl->assign('usergroups', $groups);
$tpl->display('users.tpl');

require_once 'includes/widgets/footer.php';
