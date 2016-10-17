<?php echo $_SESSION['logged_on_user']; ?> 
&nbsp; <img class="user-profile" src="<?php echo SITE . '/images/icon.png'; ?>">
<div class="dropdown-content">
    <a href="<?php echo SITE . '/view/home.php'; ?>">Edit images</a>
    <a href="<?php echo SITE . '/view/profile.php'; ?>">Profile</a>
    <a href="<?php echo SITE . '/view/logout.php'; ?>">Logout</a>
</div>

