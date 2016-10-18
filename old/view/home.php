<?php
require_once ('siteconfig.php');
require_once (DIRECTORY . '/../db/db_conn.php');
require_once ('header.php');

if ($controller->is_logged_on() && filter_has_var(INPUT_POST, 'upload'))
{
    $username  = trim($_SESSION['logged_on_user']);
    $user_id = $controller->user_id($username);
    $tmp_image_name  = $_FILES['photo']['tmp_name'];
    $image_name  = $_FILES['photo']['name'];
    $move_file = DIRECTORY .'/../uploads/' . $image_name;
    $info  = getimagesize($tmp_image_name);
    if ($info === FALSE){
        $site_data['wrong_type'] = 'Unable to determine images type of uploaded file';
    }
    if (!isset($site_data))
    {
        if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG) && ($info[2] !== IMAGETYPE_GIF)) {
            $site_data['wrong_type'] = "The selected file $image_name could not be uploaded. Only JPEG, PNG and GIF images are allowed.";
        }
    }
//    move_uploaded_file($tmp_image_name, $move_file);
}
?>
<html>
<head>
    <title>Edit Image</title>
    <?php require_once('header_files.php'); ?>
</head>
<body>
<div class="container clearfix">
    <?php require_once('nav.php'); ?>
    <div class="row">
        <div class="mi-col-xs-12">
            <h1>Main</h1>
            <form method="post" enctype="multipart/form-data" action="">
                <label>Title</label>
                <input type="text" name="title" required>
                <br>
                <label><span class="error"><?php if (isset($site_data)) echo $site_data['wrong_type']; ?></span></label>
                <br><input type="file" name="photo" required accept="image/*">
                <input type="submit" name="upload">
            </form>
        </div>
        <div class="mi-col-xs-12">
            <h1>sidebar</h1>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>