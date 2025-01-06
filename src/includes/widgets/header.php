<?php

require_once 'includes/common.php';

use libAllure\Session;

if (Session::isLoggedIn()) {
    $tpl->assign('isLoggedIn', true);
    $tpl->assign('username', Session::getUser()->getUsername());
    $tpl->assign('isAdmin', isAdmin());
    $tpl->assign('countApprovals', getCountApprovals());
} else {
    $tpl->assign('isLoggedIn', false);
    $tpl->assign('isAdmin', false);
    $tpl->assign('countApprovals', 0);
}

$tpl->assign('isVotingEnabled', $cfg->get('ENABLE_VOTING'));
$tpl->assign('siteTitle', $cfg->get('SITE_TITLE'));
$tpl->assign('inlineCss', getCustomCss());
$tpl->assign('isRegistrationEnabled', !$cfg->getBool('DISABLE_REGISTRATION'));
$tpl->display('header.tpl');
