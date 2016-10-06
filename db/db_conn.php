<?php

require_once '../config/database.php';
require_once '../controller/Controller.php';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
} catch (PDOException $e) {
    echo $e->getMessage(); //create file for displaying error messages.
    exit();
}

$controller = new Controller($DB);