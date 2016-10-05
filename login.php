<?php
/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 2016/10/05
 * Time: 8:01 AM
 */
?>
<html>
<head>
    <?php require_once('header_files.php'); ?>
</head>
<body>
<div class="container clearfix">
    <?php require_once('nav.php'); ?>
    <div class="row">
        <div class="mi-col-xs-12">
            <div class="login">
                <h2>Welcome back!<br>
                    <span class="sub-title">Login to your account below</span></h2>
                <form action="">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                    <br>
                    <label for="passwd">Password</label>
                    <input type="password" name="passwd" required>
                    <br>
                    <p><input type="checkbox" checked name="remember"> Remember me <span class="forgot">Forgotten password</span> </p>
                    <input type="submit" value="Login" name="login">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>