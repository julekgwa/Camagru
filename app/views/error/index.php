<?php //require_once ('../templates/header.php'); ?>
<h1>Oops!</h1>
<p><?php
    if (isset($error)) {
        echo $error;
    } else {
        echo 'Something went wrong';
    }
    ?>
</p>
<?php //require_once ('../templates/footer.php'); ?>