<?php
$expire = 5;
if (isset($_SESSION['last_login'])) {
    //get time since last login.
    $inactive = time() - $_SESSION['last_login'];
    //convert minutes to seconds.
    $time_seconds = $expire * 60;
    //check if 30 minutes has passed.
    if ($inactive >= $time_seconds) {
        session_unset();
        session_destroy();
        if(!isset($home_model)) {
            header('Location: login.php');
        }
        exit();
    }
}
else {
    header('Location: login.php');
}
//set the current time as the latest activity.
$_SESSION['last_login'] = time();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>/css/camagru.css">
</head>
<body>
<div class="container">
    <header>
        <div class="item">
            <a href="<?php echo SITE_URL;?>"><img class="logo" src="<?php echo SITE_URL; ?>/images/logo.png"></a>
        </div>
        <div class="item-search container-search">
            <form>
                <input type="search" id="search" placeholder="Search...">
                <button class="icon"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="item item-menu dropdown">
            <?php if (Controller::logged_on()) : require_once ('logged_in.php') ?>
            <?php else: ?>
            <a href="#"><i class="fa fa-bars"></i></a>
            <div class="dropdown-content">
                <a href="<?php echo SITE_URL . '/login'; ?>">Login</a>
                <a href="<?php echo SITE_URL . '/edit'; ?>">Edit images</a>
            </div>
            <?php endif; ?>
        </div>
    </header>