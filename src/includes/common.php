<?php

require_once 'settings.php';
require_once 'libAllure/ErrorHandler.php';

use \libAllure\ErrorHandler;

ErrorHandler::getInstance()->beGreedy();

require_once 'libAllure/Database.php';

use \libAllure\Database;
use \libAllure\DatabaseFactory;

$db = new Database('mysql:host=localhost;dbname=' . DB_NAME, DB_USER, DB_PASS);
DatabaseFactory::registerInstance($db);

require_once 'libAllure/Form.php';
require_once 'includes/functionality.php';
require_once 'libAllure/User.php';

require_once 'libAllure/AuthBackendDatabase.php';

use \libAllure\AuthBackend;
use \libAllure\AuthBackendDatabase;

$backend = new AuthBackendDatabase($db);
$backend->register();

require_once 'libAllure/Session.php';

use \libAllure\Session;

Session::setSessionName('faridoon');
Session::start();

require_once 'libAllure/Template.php';

use \libAllure\Template;

$tpl = new Template('/var/cache/apache2/smarty/faridoon/', 'includes/templates/');

?>
