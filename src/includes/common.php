<?php

set_include_path(
    get_include_path() 
    . PATH_SEPARATOR . '/usr/share/libAllure/' 
    . PATH_SEPARATOR . '/config/'
);

if (is_dir('/config/') && !file_exists('/config/settings.php')) {
    copy('includes/settings.template.php', '/config/settings.php');
}

require_once 'settings.php';

require_once 'vendor/autoload.php';

use \libAllure\ErrorHandler;

ErrorHandler::getInstance()->beGreedy();

use \libAllure\Database;
use \libAllure\DatabaseFactory;

$db = new Database('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
DatabaseFactory::registerInstance($db);

require_once 'includes/functionality.php';

use \libAllure\AuthBackend;
use \libAllure\AuthBackendDatabase;

$backend = new AuthBackendDatabase($db);
$backend->register();

use \libAllure\Session;

Session::setSessionName('faridoon');
Session::start();

use \libAllure\Template;

$tpl = new Template(sys_get_temp_dir() . '/faridoon/' . 'includes/templates/');

?>
