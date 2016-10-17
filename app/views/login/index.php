<div class="container">
    <div class="login">
    <h2>Welcome back!<br>
        <span class="sub-title">Login to your account below</span></h2>
    <p class="error"><?php if (isset($error_msg)) echo $error_msg; ?></p>
    <p class="success">
        <?php
        if (isset($site_error['action'])) {
            $action = $site_error['action'];
            switch ($action) {
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
        <p><input type="checkbox" checked name="remember"> Remember me <span class="forgot"><a href="<?php echo SITE_URL; ?>/reset">Forgotten password</a></span> </p>
        <input type="submit" value="Login" name="login">
        <p>Don't have an account? <a href="<?php echo SITE_URL; ?>/register/">Sign up</a></p>
    </form>
</div>
</div>