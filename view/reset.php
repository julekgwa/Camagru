<?php
require_once('siteconfig.php');
require_once DIRECTORY . '/../db/db_conn.php';
//reset password
if (filter_has_var(INPUT_POST, 'reset')) {
    //check if email is valid
    if (($email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)))) {
        $email = trim($email); //remove trailing spaces.
        $stmt = $DB->prepare('SELECT * FROM `users` WHERE `user_email` = ?');
        try {
            $stmt->execute(array($email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($row['reset'])) {
                $site_error['email'] = 'Your reset code has already been emailed to you, use the link provided!';
            }
            if (!isset($site_error))
            {
                //check if email exits.
                if ($controller->used_email($email)) {
                    $code = md5(uniqid(rand(), true)); //create reset code.
                    $stmt = $DB->prepare('UPDATE `users` SET `reset`= ? WHERE `user_email` = ?');
                    try {
                        $stmt->execute(array($code, $email));
                        $message = "<h2 style='font-family: 'Prociono', serif;'>Hello , $email</h2>
       <br /><br />
       Someone requested that the password be reset for Camagru account:
       <br /><br />
       Details:<br>
        Username: <br>
        E-mail: $email <br><br>
        If this was a mistake, just ignore this email and nothing will happen.
       <br /><br />
       To reset your password, visit the following address:
       " . SITE . "/view/reset.php?code=$code
       <br /><br />
       thank you :)
       ";
                        $headers = 'From: Camagru <julekgwa@camagru.com>' . "\r\n";
                        $headers .= 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        mail($email, 'Reset password', $controller->get_email_structure($message), $headers);
                        header('Location: login.php?action=reset');
                    } catch (PDOException $exc) {
                        echo $exc->getTraceAsString(); //display error message here.
                    }
                } else {
                    $site_error['email'] = 'Email provided is not recognised.';
                }
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    } else {
        $site_error['email'] = 'Please enter a valid email address.';
    }
}

//set new password
if (filter_has_var(INPUT_POST, 'new')) {
    $passwd = filter_input(INPUT_POST, 'newpasswd');
    $code = trim(filter_input(INPUT_GET, 'code'));
    if (strlen($passwd) < 8 || strlen($passwd) > 20) {
        $site_error['passwd'] = 'Password is too short, must be between 8 and 20 characters.';
    }
    if (!$controller->is_valid_code($code)) {
        $site_error['passwd'] = 'Invalid token provided, please use the link provided in the reset email.';
    }
    if (!isset($site_error)) {
        if (!$controller->is_valid_passwd($passwd)) {
            $site_error['passwd'] = 'Password needs to contain, atleast 1 number and 1 special characters.';
        }
        if (!isset($site_error)) {
            $hash_passwd = password_hash($passwd, PASSWORD_DEFAULT);
            $stmt = $DB->prepare('UPDATE `users` SET `user_passwd`= ? ,`reset` = NULL WHERE `reset` = ?');
            try {
                $stmt->execute(array($hash_passwd, $code));
                header('Location: login.php?action=changed');
            } catch (PDOException $e) {
                echo $e->getMessage(); //display error message here.
            }
        }
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
                    <h2>Reset your password</h2>
                    <?php if (!isset($_GET['code'])) : ?>
                        <form action="" method="post">
                            <label for="email">E-mail <span
                                    class="error"><?php if (isset($site_error['email'])) echo $site_error['email']; ?></span></label>
                            <input type="email" name="email" required>
                            <br>
                            <input type="submit" value="Reset Password" name="reset">
                            <p>Have an account? <a href="login.php">Sign in</a> or <a href="register.php">Sign up</a></p>
                        </form>
                    <?php else: ?>
                        <form action="" method="post">
                            <label for="email">Enter new password <span
                                    class="error"><?php if (isset($site_error['passwd'])) echo $site_error['passwd']; ?></span></label>
                            <input type="password" name="newpasswd" required>
                            <br>
                            <p><input type="checkbox" name="showpass">Show password </p>
                            <br>
                            <input type="submit" value="Reset Password" name="new">
                            <p>Have an account? <a href="login.php">Sign in</a> or <a href="register.php">Sign up</a></p>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
</html>
