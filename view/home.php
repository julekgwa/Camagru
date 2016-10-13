<?php
require_once ('siteconfig.php');
require_once (DIRECTORY . '/../db/db_conn.php');
require_once ('header.php');

if ($controller->is_logged_on() && filter_has_var(INPUT_POST, 'upload'))
{
    $username  = trim($_SESSION['logged_on_user']);
    echo $controller->user_id($username);
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
                <input type="file" name="photo" required accept="image/*">
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