<?php
if (!isset($_SESSION)) {
    session_start();
}
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
                    <img class="logo" src="<?php echo SITE_URL; ?>/img/logo.png">
                </div>
                <div class="item-search container-search">
                    <form>
                        <input type="search" id="search" placeholder="Search...">
                        <button class="icon"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="item item-menu dropdown">
                    <a href="#"><i class="fa fa-bars"></i></a>
                    <div class="dropdown-content">
                        <a href="<?php echo SITE_URL . '/login'; ?>">Login</a>
                        <a href="<?php echo SITE_URL . '/edit'; ?>">Edit images</a>
                    </div>
                </div>
            </header>