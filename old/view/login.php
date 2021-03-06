<?php
require_once ('siteconfig.php');
require_once DIRECTORY . '/../db/db_conn.php';
if (filter_has_var(INPUT_POST, 'login')) {
    $user = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $passwd = trim(filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING));
    if ($controller->login($user, $passwd)) {
        header('Location: ' . SITE . '/view/home.php');
    } else {
        $error_msg = 'The username or password is incorrect.';
    }
}
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
                        <p class="error"><?php if (isset($error_msg)) echo $error_msg; ?></p>
                        <p class="success">
                            <?php
                            if (isset($_GET))
                            {
                                $action = filter_input(INPUT_GET, 'action');
                                switch ($action){
                                    case 'active':
                                        echo 'Your account is now active you may now log in.';
                                        break;
                                    case 'registered':
                                        echo 'Registration successful, please check your email to activate your account.';
                                        break;
                                    case 'reset':
                                        echo 'Please check your inbox for a reset link.';
                                        break;
                                    case 'changed':
                                        echo 'Your password was changed, you may now login.';
                                        break;
                                }
                            }
                            ?>
                        </p>
                        <form action="" method="post">
                            <label for="username">Username/e-mail</label>
                            <input type="text" name="username" required>
                            <br>
                            <label for="passwd">Password</label>
                            <input type="password" name="passwd" required>
                            <br>
                            <p><input type="checkbox" checked name="remember"> Remember me <span class="forgot"><a href="reset.php">Forgotten password</a></span> </p>
                            <input type="submit" value="Login" name="login">
                            <p>Don't have an account? <a href="register.php">Sign up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('footer.php'); ?>
    </body>
</html>