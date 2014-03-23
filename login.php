<?php

require_once 'includes/common.php';
require_once 'libAllure/util/FormLogin.php';
require_once 'libAllure/AuthBackendOpenId.php';

$openId = new AuthBackendOpenId('http://tydus.net/quotes/');

if (!$openId->getMode()) {
	if (isset($_REQUEST['openId'])) {
		$openId->login($_REQUEST['openId']);
	}
} elseif ($openId->getMode() == 'cancel') {
	echo 'aww';
} else {
	if ($openId->getOpenId()->validate()) {
		\libAllure\Session::performLogin($openId->getEmail(), 'email');

		require_once 'index.php';
	} else {
		echo 'no login :(';
	}
}

use \libAllure\util\FormLogin;

$f = new FormLogin();
$f->setTitle('');

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

	echo '<div class = "container">';
	echo '<a href = "?openId=google"><img src = "https://developers.google.com/accounts/images/sign-in-with-google.png" width = "300" /></a><br />';
	echo '<a href = "?openId=facebook"><img src = "http://www.fitnessblender.com/media/content-images/facebook-login-button.png" width = "300" /></a><br />';
	echo '</div>';

	echo '<div class = "container">';
	$tpl->displayForm($f);
	echo '</div>';
}
	
require_once 'includes/widgets/footer.php';

?>
