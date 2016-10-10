<?php
require_once ('siteconfig.php');
require_once DIRECTORY . '/../db/db_conn.php';
//reset password
if (filter_has_var(INPUT_POST, 'reset')) {
    if (($email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
        $email = trim($email);
        if ($controller->used_email($email)) {
            $code = md5(uniqid(rand(), true)); //create reset code.
            $stmt = $DB->prepare('UPDATE `users` SET `reset`= ? WHERE `user_email` = ?');
            try {
                $stmt->execute(array($code, $email));
                $message = "Hello , $email
       <br /><br />
       We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
       <br /><br />
       Click Following Link To Reset Your Password 
       <br /><br />
       <a href='" . SITE . "/reset.php?code=$code'>click here to reset your password</a>
       <br /><br />
       thank you :)
       ";
                mail($email, 'Reset password', $message, 'From: noreply@' . SITE);
            } catch (PDOException $exc) {
                echo $exc->getTraceAsString();
            }
        } else {
            $site_error['email'] = 'Email provided is not recognised.';
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
                    <form action="" method="post">
                        <label for="email">E-mail <span class="error"><?php if (isset($site_error['email'])) echo $site_error['email']; ?></span></label>
                        <input type="email" name="email" required>
                        <br>
                        <input type="submit" value="Reset Password" name="reset">
                        <p>Have an account? <a href="login.php">Sign in</a> or <a href="register.php">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
</html>
