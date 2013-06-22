<?php

require_once 'includes/common.php';

$_SESSION['admin'] = false;
@session_unset();
@session_destroy();

require_once 'includes/widgets/header.php';

echo '<h2>Logged out.</h2>';
echo '<p>ttyl.</p>';

require_once 'includes/widgets/footer.php';

?>
