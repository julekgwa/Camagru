<?php
require_once ('siteconfig.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Camagru Gallery</title>
    <?php require_once('header_files.php'); ?>
</head>
<body>
<div class="container clearfix">
    <?php require_once('nav.php'); ?>
    <div class="row gallery">
        <div class="mi-col-xs-12">
            <p>Image title</p>
            <img src="http://www.w3schools.com/bootstrap/sanfran.jpg">
            <p>like button</p>
            <form id="comment_form" method="post" action="">
                <textarea></textarea>
                <br>
                <input type="submit" value="Comment" name="comment">
            </form>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>