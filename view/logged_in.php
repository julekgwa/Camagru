<?php echo $_SESSION['logged_on_user']; ?> 
&nbsp; <img class="user-profile" src="<?php echo $dir . 'img/icon.png'; ?>">
<div class="dropdown-content">
    <a href="<?php echo $dir . 'view/edit_image.php'; ?>">Edit images</a>
    <a href="<?php echo $dir . 'view/profile.php'; ?>">Profile</a>
    <a href="<?php echo $dir . 'view/logout.php'; ?>">Logout</a>
</div>

