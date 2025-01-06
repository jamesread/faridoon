<?php

require_once '../vendor/autoload.php';

@include_once '/config/init.php';

use libAllure\ErrorHandler;

ErrorHandler::getInstance()->beGreedy();

$cfg = new \libAllure\ConfigFile();
$cfg->set(
    [
        'DB_NAME' => 'faridoon',
        'DB_HOST' => 'mysql',
        'SITE_TITLE' => 'Faridoon',
    ]
);
$cfg->loadFromPaths(
    [
        '/config/',
        '/var/www/html/faridoon/',
        '/etc/faridoon/config.ini',
    ]
);
$cfg->loadFromEnv();

use libAllure\Database;
use libAllure\DatabaseFactory;

$db = new Database($cfg->getDsn(), $cfg->get('DB_USER'), $cfg->get('DB_PASS'));
DatabaseFactory::registerInstance($db);

function startupError($message)
{
    $message = nl2br($message);
    $message = <<<HTML
<head>
<title>Faridoon startup error</title>
<style type = "text/css">
body {
    background-color: #efefef;
    font-family: sans-serif;
    padding: 2em;
}
</style>
</head>
<body>
    <h1>Faridoon startup error</h1>
    $message
</body>
HTML;
    echo $message;

    exit;
}

function requireDatabaseVersion(string $requiredMigration)
{
    try {
        $sql = 'SELECT id FROM migrations';
        $stmt = libAllure\DatabaseFactory::getInstance()->query($sql);
        $versionRows = array_column($stmt->fetchAll(), 'id');
    } catch (Exception $e) {
        startupError('Faridoon connected to the database, but the migrations table could not be queried.');
    }

    natsort($versionRows);
    $latestVersion = end($versionRows);

    if ($latestVersion != $requiredMigration) {
        if ($latestVersion == '') {
            $latestVersion = 'null';
        }

        startupError('Faridoon requires database version ' . $requiredMigration . ' but the database is at version ' . $latestVersion . '. Please <a href = "http://jamesread.github.io/Faridoon/installation/migrations/">run database migrations</a>.');
    }
}

requireDatabaseVersion('0.base.sql');

require_once 'includes/functionality.php';

use libAllure\AuthBackend;
use libAllure\AuthBackendDatabase;

$backend = new AuthBackendDatabase($db);
$backend->register();

use libAllure\Session;

Session::setSessionName('faridoon');
Session::start();

use libAllure\Template;

$tpl = new Template(sys_get_temp_dir() . '/faridoon/' . 'includes/templates/');
$tpl->registerModifier('isAdmin', 'isAdmin');
