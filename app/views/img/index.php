<div class="container">
    <?php if (!empty($site_data)) : ?>
    <p><?php // echo $site_data['image_title']; ?></p>
    <img src="<?php echo SITE_URL . '/uploads/user-img/' . $site_data['image_url']; ?>">
    <div class="social">
        <!--like button-->
        <form method="post" action="" name="love-hate">
            <input type="number" id="like-img" name="like-img" hidden value="<?php echo $site_data['image_id']; ?>">
            <button class="social-like" type="submit" name="vote" value="love">
                <span class="like"><i class="fa fa-thumbs-up"></i></span>
                <span id="likes" class="count"><?php if (isset($site_data['love'])) echo $site_data['love']; ?></span>
            </button>
            &nbsp;
            <button class="social-dislike" type="submit" name="vote" value="hate">
                <span id="dislikes"
                      class="dislike-count"><?php if (isset($site_data['hate'])) echo $site_data['hate']; ?></span>
                <span class="dislike"><i class="fa fa-thumbs-down"></i></span>
            </button>
        </form>
    </div>
    <p id="nouser"><?php if (isset($site_data['nouser'])) echo $site_data['nouser']; ?></p>
    <form id="comment_form" method="post" action="" name="opinion">
        <input type="number" name="image-id" hidden value="<?php echo $site_data['image_id']; ?>">
        <textarea id="opinion" name="comment"></textarea>
        <br>
        <input type="submit" value="Comment" name="add-comment">
    </form>
    <br>
    <!--comment area -->
    <div id="comment-area">
        <?php if (isset($site_data['comments'])) : ?>
            <?php foreach ($site_data['comments'] as $comment) : ?>
                <div class="comment-area">
                    <p class="comment"><?php echo $comment['comment']; ?></p>
                    <p class="author">-<?php echo $comment['user_name']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
