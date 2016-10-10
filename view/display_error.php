<!DOCTYPE html>
<html>
    <head>
        <title>Camagru Gallery</title>
        <?php require_once('header_files.php'); ?>
    </head>
    <body>
        <div class="container clearfix">
            <?php require_once('nav.php'); ?>
            <div class="row">
                <h1>Oops!</h1>
                <p><?php
                    if (isset($error)) {
                        echo $error;
                    } else {
                        echo 'Something went wrong';
                    }
                    ?></p>
            </div>
        </div>
<?php require_once('footer.php'); ?>
    </body>
</html>