<?php

require_once 'includes/common.php';

$_SESSION['admin'] = false;
@session_unset();
@session_destroy();

require_once 'includes/widgets/header.php';

$tpl->display('logout.tpl');

require_once 'includes/widgets/footer.php';
