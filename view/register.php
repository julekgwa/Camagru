<?php
require_once '../db/db_conn.php';
$error = '';
if (filter_has_var(INPUT_POST, 'register')) {
    $user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($controller->register($user, $email, $passwd)) {
        header('Location: login.php');
    } else {
        $error = 'error';
    }
}
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
                <h2>Create your Camagru Account</h2>
                <form action="" method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                    <br>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" required>
                    <br>
                    <label for="passwd">Password</label>
                    <input type="password" name="passwd" required>
                    <br>
                    <p><input type="checkbox" name="remember">Show password </p>
                    <input type="submit" value="Register" name="register">
                    <p>Have an account? <a href="login.php">Sign in</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</html>