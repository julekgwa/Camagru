<div class="container">
    <div class="login">
        <h2>Reset your password</h2>
        <?php if (!isset($site_data['code'])) : ?>
            <form action="" id="reset-form" method="post" name="reset-passwd">
                <label for="email">E-mail <span
                        class="error" id="reset-email-error"><?php if (isset($site_data['email'])) echo $site_data['email']; ?></span></label>
                <input type="email" id="reset-email" name="email" required>
                <br>
                <input type="submit" value="Reset Password" id="reset-sub" name="reset">
                <p>Have an account? <a href="<?php echo SITE_URL; ?>/login">Sign in</a> or <a href="<?php echo SITE_URL; ?>/register">Sign up</a></p>
            </form>
        <?php else: ?>
            <form action="" method="post" name="new-passwd">
                <label for="password">Enter new password <span
                        class="error" id="new-passwd-error"><?php if (isset($site_data['passwd'])) echo $site_data['passwd']; ?></span></label>
                <input type="password" name="newpasswd" id="new-passwd-set" required>
                <input type="text" name="code" hidden id="reset-code" value="<?php if (isset($site_data['code'])) echo $site_data['code']; ?>">
                <br>
                <p><input type="checkbox" name="showpass">Show password </p>
                <br>
                <input type="submit" value="Set new password" id="new-pass-sub" name="new">
                <p>Have an account? <a href="<?php echo SITE_URL; ?>/login">Sign in</a> or <a href="<?php echo SITE_URL; ?>/register">Sign up</a></p>
            </form>
        <?php endif; ?>
    </div>
</div>