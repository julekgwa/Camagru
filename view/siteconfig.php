<?php
/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/10/16
 * Time: 7:36 AM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION)) {
    session_start();
}

define('SITE', 'http://localhost/Camagru');
define('SITEMAIL', 'noreply@localhost.com');
define('DIRECTORY', __DIR__);
require_once (DIRECTORY .'/../config/database.php');