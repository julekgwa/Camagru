<div class="container">
        <div class="login">
            <h2>Create your Camagru Account</h2>
            <form action="<?php echo SITE_URL; ?>/register/" method="post" autocomplete="off" name="reg_user">
                <label for="username">Username <span class="error" id="user-error"><?php if (isset($site_data['username'])) echo $site_data['username']; ?></span></label>
                <input type="text" name="username" id="username" required>
                <br>
                <label for="email">E-mail <span class="error" id="email-error"><?php if (isset($site_data['email'])) echo $site_data['email']; ?></span></label>
                <input type="email" name="email" id="email" required>
                <br>
                <label for="passwd">Password <span class="error" id="passwd-error"><?php if (isset($site_data['passwd'])) echo $site_data['passwd']; ?></span></label>
                <input type="password" name="passwd" id="passwd" required>
                <br>
                <p><input type="checkbox" name="showpass">Show password </p>
                <input type="submit" value="Register" id="register" name="register">
                <p>Have an account? <a href="<?php echo SITE_URL; ?>/login">Sign in</a></p>
            </form>
        </div>
</div>