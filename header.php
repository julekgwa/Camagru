<?php
if (!isset($_SESSION))
    session_start();
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
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Camagru</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a data-toggle="modal"  data-target="#login"  href="">Register/Login</a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>

<!--registration and login modal-->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-label="mylogin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
        </div>
    </div>
</div>