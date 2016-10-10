<?php
require_once ('siteconfig.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once('header_files.php'); ?>
</head>
<div class="container clearfix">
    <?php require_once('nav.php'); ?>
    <div class="row">
        <div class="mi-col-xs-12">
            <div class="login">
                <h2>Reset your password</h2>
                <form action="">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" required>
                    <br>
                    <input type="submit" value="Register" name="register">
                    <p>Have an account? <a href="login.php">Sign in</a> or <a href="register.php">Sign up</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</html>
