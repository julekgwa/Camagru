<?php
session_start();
require_once '../db/db_conn.php';
if ($controller->logout())
{
    header('Location: http://localhost/Camagru/');
}
else
{
    require_once ('display_error.php');
}