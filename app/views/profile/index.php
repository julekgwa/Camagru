<div class="container">
    <?php if (count($site_data)) : ?>
    <div class="profile">
        <div class="info">
            <h3><?php echo $site_data['user_name']; ?></h3>
        </div>
        <div class="uploads">
uploads
        </div>
    </div>
    <?php else: ?>
    <h3>Oops can't find what you are looking for.</h3>
    <?php endif; ?>
</div>