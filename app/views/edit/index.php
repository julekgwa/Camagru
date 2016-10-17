<div class="container">
    <div class="row">
        <div class="mi-col-xs-12">
            <h1>Main</h1>
            <form method="post" enctype="multipart/form-data" action="">
                <label>Title</label>
                <input type="text" name="title" required>
                <br>
                <label><span class="error"><?php if (isset($site_error)) echo $site_error['wrong_type']; ?></span></label>
                <br><input type="file" name="photo" required accept="image/*">
                <input type="submit" name="upload">
            </form>
        </div>
        <div class="mi-col-xs-12">
            <h1>sidebar</h1>
            <?php
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            if ($new_user->is_logged_on()) {
            echo 'Yes';
            }
            ?>
        </div>
    </div>
</div>