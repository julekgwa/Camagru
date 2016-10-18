<div class="gallery">
    <?php if ($site_data) : ?>
        <?php foreach ($site_data as $image) : ?>
            <div class="item">
                <img src="<?php echo SITE_URL . '/uploads/user-img/' . $image['image_url']; ?>">
                <p class="uploader"><?php echo $image['image_title'] . ' - <a href="' . SITE_URL . '/profile/'
                        . $image['user_name'] . '">' . $image['user_name'] . '</a>'; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>