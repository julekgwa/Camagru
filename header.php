<?php
if (!isset($_SESSION))
{
    session_start();
}
//expire the session if the user is inactive for 30
//minutes or more
$expire = 30;
if (isset($_SESSION['last_login']))
{
    //get time since last login.
    $inactive = time() - $_SESSION['last_login'];
    //convert minutes to seconds.
    $time_seconds = $expire * 60;
    //check if 30 minutes has passed.
    if ($inactive >= $time_seconds)
    {
        session_unset();
        session_destroy();
    }
}
//set the current time as the latest activity.
$_SESSION['last_login'] = time();
?>
<header>
    <div class="navbar clearfix">
        <div class="row">
            <div class="mi-col-xs-2 navbar-brand">
                <a  href="#">Camagru</a>
            </div>
            <div class="mi-col-xs-9">
                <div class="container-search" style="margin: 0 auto; width: 100%">
                    <form>
                        <input type="search" id="search" placeholder="Search...">
                        <button class="icon"><i class="fa fa-search"></i> </button>
                    </form>
                </div>
            </div>
            <div class="mi-col-xs-1 pull-right">
                <div class="dropdown">
                    <a href="#"><i class="fa fa-bars"></i></a>
                    <div class="dropdown-content">
                    <a href="#">Register/Login</a>
                    <a href="#">Login</a>
                </div>
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