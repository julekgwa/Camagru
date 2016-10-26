<?PHP

        // /*create database*/
        $db->query('CREATE DATABASE IF NOT EXISTS db_julekgwa');
        /*select database*/
        // $$db->query('USE db_julekgwa');
        $db->query('CREATE TABLE IF NOT EXISTS comments (
            comment_id int(11) NOT NULL,
            images_image_id int(11) NOT NULL,
            comment varchar(5000) NOT NULL,
            comment_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            users_id int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        /*create table for valid users after verification*/
        $create_comment_likes = $db->prepare('CREATE TABLE IF NOT EXISTS comment_likes (
            comment_like_id int(11) NOT NULL,
            comment_like int(11) NOT NULL DEFAULT 0,
            comment_dislike int(11) NOT NULL DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        /*create table for images*/
        $db->query('CREATE TABLE IF NOT EXISTS images (
            image_id int(11) NOT NULL,
            users_user_id int(11) NOT NULL,
            image_created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            image_url varchar(500) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $db->query('CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_passwd` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `user_reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset` varchar(255) DEFAULT NULL,
  `user_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $db->query('CREATE TABLE `image_likes` (
  `images_image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_like_love` tinyint(1) NOT NULL DEFAULT false,
  `image_like_hate` tinyint(1) NOT NULL DEFAULT false
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
         //constraints
        $db->query('ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`,`images_image_id`),
  ADD KEY `fk_comments_images1_idx` (`images_image_id`)');

        $db->query('ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`comment_like_id`)');
        $db->query('ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`,`users_user_id`),
  ADD KEY `fk_images_users_idx` (`users_user_id`)');
        $db->query('ALTER TABLE `image_likes`
  ADD UNIQUE KEY `unique_index` (`images_image_id`,`user_id`),
  ADD KEY `fk_image_likes_images1_idx` (`images_image_id`)');
        $db->query('LTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  ADD UNIQUE KEY `user_email_UNIQUE` (`user_email`)');
        $db->query('ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT');
        $db->query('ALTER TABLE `comment_likes`
  MODIFY `comment_like_id` int(11) NOT NULL AUTO_INCREMENT');
        $db->query('ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT');
        $db->query('ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT');
        $db->query('ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_images1` FOREIGN KEY (`images_image_id`) REFERENCES `images` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $db->query('ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_users` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $db->query('ALTER TABLE `image_likes`
  ADD CONSTRAINT `fk_image_likes_images1` FOREIGN KEY (`images_image_id`) REFERENCES `images` (`image_id`) ON DELETE NO ACTION ON UPDATE NO ACTION');
        $create_comment_likes->execute();
        // $create_images->execute();
        // $create_image->execute();
 
?>