<div class="container">
    <div class="login">
    <h2>Welcome back!<br>
        <span class="sub-title">Login to your account below</span></h2>
    <p class="error" id="cred-error"><?php if (isset($site_data['wrong_user_cred'])) echo $site_data['wrong_user_cred']; ?></p>
    <p class="success">
        <?php
        if (isset($site_data['action'])) {
            $action = $site_data['action'];
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
    <form action="" method="post" name="login_user">
        <label for="username">Username/e-mail <span class="error" id="user-error"></span></label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="passwd">Password <span class="error" id="passwd-error"></span></label>
        <input type="password" name="passwd" id="passwd" required>
        <br>
        <p><input type="checkbox" checked name="remember"> Remember me <span class="forgot"><a href="<?php echo SITE_URL; ?>/reset">Forgotten password</a></span> </p>
        <input type="submit" id="login" value="Login" name="login">
        <p>Don't have an account? <a href="<?php echo SITE_URL; ?>/register/">Sign up</a></p>
    </form>
</div>
</div>