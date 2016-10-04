<!DOCTYPE html>
<html>
<head>
    <title>Camagru Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="css/mistyle.css" type="text/css" rel="stylesheet">
    <link href="css/camagru.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php require_once('header.php'); ?>
<div class="container clearfix">
    <div class="row">
        <div class="mi-col-xs-12 col-sm-6 col-md-4 add-pads">
            <img src="http://www.w3schools.com/bootstrap/sanfran.jpg">
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
<script src="js/camagru.js"></script>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Camagru. Developed by <a href="https://profile.intra.42.fr/users/julekgwa"> julekgwa</a></p>
</footer>
</body>
</html>