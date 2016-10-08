<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<header>
    <div class="navbar clearfix">
        <div class="row">
            <div class="mi-col-xs-2 navbar-brand">
                <a href="#">Camagru</a>
            </div>
            <div class="mi-col-xs-9">
                <div class="container-search" style="margin: 0 auto; width: 100%">
                    <form>
                        <input type="search" id="search" placeholder="Search...">
                        <button class="icon"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="mi-col-xs-1 pull-right">
                <div class="dropdown">
                    <?php if (isset($_SESSION['logged_on_user'])) : require_once ('logged_in.php'); ?>
                    <?php else: ?>
                        <a class="menu" href="#"><i class="fa fa-bars"></i></a>
                        <div class="dropdown-content">
                            <a href="/Camagru/view/login.php">Login</a>
                            <a href="/Camagru/view/edit_image.php">Edit images</a>
                            <a href="/Camagru/view/profile.php">Profile</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<!--registration modal-->
<div id="mod" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <p>My Modal...</p>
    </div>
</div>