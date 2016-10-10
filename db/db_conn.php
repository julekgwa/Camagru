<?php
session_start();
require_once '../config/database.php';
require_once '../controller/Controller.php';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
} catch (PDOException $e) {
    $error =  $e->getMessage(); //create file for displaying error messages.
    require_once ('../view/display_error.php');
    exit();
}
$controller = new Controller($DB);
$controller->set_site('');