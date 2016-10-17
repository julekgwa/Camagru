<?php echo $_SESSION['logged_on_user']; ?>
&nbsp; <img class="user-profile" src="<?php echo SITE_URL . '/images/icon.png'; ?>">
<div class="dropdown-content">
    <a href="<?php echo SITE_URL . '/edit'; ?>">Edit images</a>
    <a href="<?php echo SITE_URL . '/profile'; ?>">Profile</a>
    <a href="<?php echo SITE_URL . '/logout'; ?>">Logout</a>
</div>