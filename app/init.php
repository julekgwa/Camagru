<?php

require_once ('config/database.php');
require_once ('core/App.php');
require_once ('core/Controller.php');

date_default_timezone_set('Africa/Johannesburg');
define('SITEMAIL', 'noreply@localhost.com');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__) . '/public')));
try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

Controller::$db = $db;