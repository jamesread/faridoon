<?php

require_once 'includes/common.php';

use libAllure\Session;

$tpl->assign('isLoggedIn', Session::isLoggedIn());
$tpl->assign('countApprovals', 0);
$tpl->assign('hasApprovalPermissions', false);

if (Session::isLoggedIn()) {
    $tpl->assign('username', Session::getUser()->getUsername());

    if (Session::getUser()->hasPriv('APPROVE_QUOTES')) {
        $tpl->assign('hasApprovalPermissions', getCountApprovals());
        $tpl->assign('countApprovals', getCountApprovals());
    }
}

$tpl->assign('isVotingEnabled', $cfg->get('ENABLE_VOTING'));
$tpl->assign('siteTitle', $cfg->get('SITE_TITLE'));
$tpl->assign('inlineCss', getCustomCss());
$tpl->assign('isRegistrationEnabled', !$cfg->getBool('DISABLE_REGISTRATION'));
$tpl->assign('isAddEnabled', isAddEnabled());
$tpl->display('header.tpl');
