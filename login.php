<?php

require_once 'includes/common.php';
require_once 'includes/classes/FormLogin.php';

$f = new FormLogin();

if ($f->validate()) {
	try {
		$f->process();


		require_once 'includes/widgets/header.php';
		echo '<p>You have been logged in. Well done.</p>';
		require_once 'includes/widgets/footer.php';
	} catch (Exception $e) {
	require_once 'includes/widgets/header.php';
		echo 'Wrong password. ';
	}
} else {
	require_once 'includes/widgets/header.php';

	$tpl->displayForm($f);
}

require_once 'includes/widgets/footer.php';

?>
