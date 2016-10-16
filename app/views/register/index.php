
<div class="container">
        <div class="login">
            <h2>Create your Camagru Account</h2>
            <form action="" method="post" autocomplete="off">
                <label for="username">Username <span class="error"><?php if (isset($site_error['username'])) echo $site_error['username']; ?></span></label>
                <input type="text" name="username" required>
                <br>
                <label for="email">E-mail <span class="error"><?php if (isset($site_error['email'])) echo $site_error['email']; ?></span></label>
                <input type="email" name="email" required>
                <br>
                <label for="passwd">Password <span class="error"><?php if (isset($site_error['passwd'])) echo $site_error['passwd']; ?></span></label>
                <input type="password" name="passwd" required>
                <br>
                <p><input type="checkbox" name="showpass">Show password </p>
                <input type="submit" value="Register" name="register">
                <p>Have an account? <a href="login.php">Sign in</a></p>
            </form>
        </div>
</div>