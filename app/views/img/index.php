<div class="container">
    <?php if (!empty($site_data)) : ?>
        <p><?php echo $site_data['image_title']; ?></p>
        <img src="<?php echo SITE_URL . '/uploads/user-img/' . $site_data['image_url']; ?>">
        <div class="social">
            <!--like button-->
            <button class="social-like">
                <span class="like"><i class="fa fa-thumbs-up"></i></span>
                <span class="count">0</span>
            </button>
            &nbsp;
            <button class="social-dislike">
                <span class="dislike-count">0</span>
                <span class="dislike"><i class="fa fa-thumbs-down"></i></span>
            </button>
        </div>
        <p><?php if (isset($site_data['nouser'])) echo $site_data['nouser']; ?></p>
        <form id="comment_form" method="post" action="">
            <input type="number" name="image-id" hidden value="<?php echo $site_data['image_id']; ?>">
            <textarea name="comment"></textarea>
            <br>
            <input type="submit" value="Comment" name="add-comment">
        </form>
        <br>
        <!--comment area -->
        <?php if (isset($site_data['comments'])) : ?>
            <?php foreach($site_data['comments'] as $comment) : ?>
            <div class="comment-area">
                <p class="comment"><?php echo $comment['comment']; ?></p>
                <p class="author">-<?php echo $comment['user_name']; ?></p>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
