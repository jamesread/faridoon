<?php

require_once 'includes/widgets/header.php';

$tpl->assign('isAdmin', isAdmin());
$tpl->display('account.tpl');

require_once 'includes/widgets/footer.php';
