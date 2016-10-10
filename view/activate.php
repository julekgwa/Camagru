<?php
require_once ('siteconfig.php');
require_once (DIRECTORY . '/../db/db_conn.php');
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
                    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                    $code = filter_input(INPUT_GET, 'activate', FILTER_SANITIZE_STRING);
                    if (is_numeric($id) && !empty($code)) {
                        $controller->activate_user($id, $code);
                        if ($controller->getRowCount() == 1) {
                            header('Location: login.php?action=activated');
                            exit();
                        } else {
                            echo "<p>Your account could not be activated.</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php require_once('footer.php'); ?>
    </body>
</html>