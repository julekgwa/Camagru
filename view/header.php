<?php
if (!isset($_SESSION)) {
    session_start();
}
//expire the session if the user is inactive for 30
//minutes or more
$expire = 5;
if (isset($_SESSION['last_login'])) {
    //get time since last login.
    $inactive = time() - $_SESSION['last_login'];
    //convert minutes to seconds.
    $time_seconds = $expire * 60;
    //check if 30 minutes has passed.
    if ($inactive >= $time_seconds) {
        // session_unset();
        // session_destroy();
        header('Location: login.php');
        exit();
    }
}
//set the current time as the latest activity.
$_SESSION['last_login'] = time();
?>