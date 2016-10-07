<?php
require_once '../db/db_conn.php';
if ($controller->logout())
{
    header('Location: http://localhost:8080/Camagru/');
}
else
{
    require_once ('display_error.php');
}