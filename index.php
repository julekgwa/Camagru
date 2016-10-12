<?php
require_once ('view/siteconfig.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Camagru Gallery</title>
    <?php require_once('./view/header_files.php'); ?>
</head>
<body>
<div class="container clearfix">
    <?php require_once('./view/nav.php'); ?>
    <div class="row">
        <div class="mi-col-xs-12 col-sm-6 col-md-4 add-pads">
            <a href="view/view.php"><img src="http://www.w3schools.com/bootstrap/sanfran.jpg"></a>
            <div class="description">
                <p>Uploaded by --John</p>
            </div>
        </div>
        <div class="mi-col-xs-12 col-sm-6 col-md-4 add-pads">
            <img src="http://www.w3schools.com/bootstrap/newyork.jpg">
            <div class="description">
                <p>Uploaded by --John</p>
            </div>
        </div>
        <div class="mi-col-xs-12 col-sm-6 col-md-4 add-pads">
            <img src="http://www.w3schools.com/bootstrap/paris.jpg">
            <div class="description">
                <p>Uploaded by --John</p>
            </div>
        </div>
    </div>
</div>
<?php require_once('./view/footer.php'); ?>
</body>
</html>