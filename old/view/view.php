<?php
require_once('siteconfig.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Camagru Gallery</title>
    <?php require_once('header_files.php'); ?>
</head>
<body>
<div class="container clearfix">
    <?php require_once('nav.php'); ?>
    <div class="row gallery">
        <div class="mi-col-xs-12">
            <p>Image title</p>
            <img src="http://www.w3schools.com/bootstrap/sanfran.jpg">
            <div class="social">
                <!--like button-->
                <button class="social-like" >
                    <span class="like"><i class="fa fa-thumbs-up"></i></span>
                    <span class="count" >0</span>
                </button>
                &nbsp;
                <button class="social-dislike" >
                    <span class="dislike-count" >0</span>
                    <span class="dislike"><i class="fa fa-thumbs-down"></i></span>
                </button>
            </div>
            <form id="comment_form" method="post" action="">
                <textarea></textarea>
                <br>
                <input type="submit" value="Comment" name="comment">
            </form>
            <br>
            <!--comment area -->
            <div class="comment-area">
                <p class="comment">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                <p class="author">-Junius</p>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>