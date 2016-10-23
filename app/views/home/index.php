<div class="gallery">
    <div class="grid">
        <?php if ($site_data) : ?>
            <?php foreach ($site_data as $image) : ?>
                <div class="cell">
                    <a href="<?php echo SITE_URL . '/img/' . $image['image_id']; ?>" ><img class="responsive-image" src="<?php echo SITE_URL . '/uploads/user-img/' . $image['image_url']; ?>"></a>
                    <p class="uploader">uploaded by <?php echo ' - <a href="' . SITE_URL . '/profile/'
                            . $image['user_name'] . '">' . $image['user_name'] . '</a>'; ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>