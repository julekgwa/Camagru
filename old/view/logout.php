<?php
require_once ('siteconfig.php');
require_once DIRECTORY . '/../db/db_conn.php';
if ($controller->logout())
{
    header('Location: '. SITE);
}
else
{
    require_once ('display_error.php');
}