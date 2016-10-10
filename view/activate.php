<?php
require_once ('../db/db_conn.php');
?>
<html>
<head>
    <?php require_once('header_files.php'); ?>
    <title>Account activation</title>
</head>
<body>
<div class="container clearfix">
    <?php require_once('nav.php'); ?>
    <div class="row">
        <div class="mi-col-xs-12">
            <?php
            $id = $_GET['id'];
            $code = $_GET['activate'];
            if (is_numeric($id) && !empty($code))
            {
                $controller->activate_user($id, $code);
                if ($controller->getRowCount() == 1)
                {
                    header('Location: login.php?action=activated');
                    exit();
                }
                else {
                    echo "<p>Your account could not be activated.</p>";
                }
            }
            else
            {
                echo "<p>Your account could not be activated error.</p>";
            }
            ?>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>