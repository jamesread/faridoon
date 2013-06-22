<?php

require_once 'settings.php';
require_once 'libAllure/ErrorHandler.php';

use \libAllure\ErrorHandler;

ErrorHandler::getInstance()->beGreedy();

require_once 'libAllure/Form.php';
require_once 'includes/functionality.php';

session_name('faridoon');
session_start();

require_once 'libAllure/Database.php';

use \libAllure\Database;

$db = new Database('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);

require_once 'libAllure/Template.php';

use \libAllure\Template;

$tpl = new Template('/var/cache/apache2/smarty/faridoon/', 'includes/templates/');

?>
