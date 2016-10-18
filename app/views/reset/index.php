<div class="container">
    <div class="login">
        <h2>Reset your password</h2>
        <?php if (!isset($site_data['code'])) : ?>
            <form action="" method="post">
                <label for="email">E-mail <span
                        class="error"><?php if (isset($site_data['email'])) echo $site_data['email']; ?></span></label>
                <input type="email" name="email" required>
                <br>
                <input type="submit" value="Reset Password" name="reset">
                <p>Have an account? <a href="<?php echo SITE_URL; ?>/login">Sign in</a> or <a href="<?php echo SITE_URL; ?>/register">Sign up</a></p>
            </form>
        <?php else: ?>
            <form action="" method="post">
                <label for="email">Enter new password <span
                        class="error"><?php if (isset($site_data['passwd'])) echo $site_data['passwd']; ?></span></label>
                <input type="password" name="newpasswd" required>
                <br>
                <p><input type="checkbox" name="showpass">Show password </p>
                <br>
                <input type="submit" value="Reset Password" name="new">
                <p>Have an account? <a href="<?php echo SITE_URL; ?>/login">Sign in</a> or <a href="<?php echo SITE_URL; ?>/register">Sign up</a></p>
            </form>
        <?php endif; ?>
    </div>
</div>