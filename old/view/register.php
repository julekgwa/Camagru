<?php

if (filter_has_var(INPUT_POST, 'register')) {
    $user = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $passwd = trim(filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING));
    if (($email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)))) {
        if (strlen($passwd) < 8 || strlen($passwd) > 20) {
            $site_data['passwd'] = 'Password is too short, must be between 8 and 20 characters.';
        }

        if (strlen($user) < 4) {
            $site_data['username'] = 'Username is too short, must be atleast 4 characters long.';
        }
        if (!isset($site_data)) {
            if (!$controller->is_valid_passwd($passwd)) {
                $site_data['passwd'] = 'Password needs to contain, atleast 1 number and 1 special characters.';
            }
            if (!$controller->is_valid_username($user)) {
                $site_data['username'] = 'Only alphanumeric characters and underscore are allowed.';
            }
            if (!isset($site_data)) {
                if ($controller->used_email($email)) {
                    $site_data['email'] = 'Email provided is already in use.';
                }
                if ($controller->used_username($user)) {
                    $site_data['username'] = 'Username provided is already in use.';
                }
                if (!isset($site_data)) {
                    if ($controller->register($user, $email, $passwd)) {
                        header('Location: login.php?action=registered');
                    }
                }
            }
        }
    } else {
        $site_data['email'] = 'Please enter a valid email address.';
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
                    <form action="" method="post" autocomplete="off">
                        <label for="username">Username <span class="error"><?php if (isset($site_data['username'])) echo $site_data['username']; ?></span></label>
                        <input type="text" name="username" required>
                        <br>
                        <label for="email">E-mail <span class="error"><?php if (isset($site_data['email'])) echo $site_data['email']; ?></span></label>
                        <input type="email" name="email" required>
                        <br>
                        <label for="passwd">Password <span class="error"><?php if (isset($site_data['passwd'])) echo $site_data['passwd']; ?></span></label>
                        <input type="password" name="passwd" required>
                        <br>
                        <p><input type="checkbox" name="showpass">Show password </p>
                        <input type="submit" value="Register" name="register">
                        <p>Have an account? <a href="login.php">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
</html>
