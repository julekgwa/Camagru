<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/18/16
 * Time: 8:35 PM
 */
class ImageLike
{
    private $_image_id;
    private $_user_id;
    private $_like;
    private $_db;

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function set_like($image_id, $user_id, $like) {
        $this->_user_id = $user_id;
        $this->_image_id = $image_id;
        $this->_like = $like;
    }
    public function is_like() {
        $stmt  = $this->_db->prepare('SELECT `status` FROM `image_likes` WHERE `images_image_id` = ? AND `user_id` = ?');
        try {
            $stmt->execute([$this->_image_id, $this->_user_id]);
            $like = $stmt->fetch(PDO::FETCH_ASSOC);
            return $like['status'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function like_hate($col, $update_col) {
        $sql = "INSERT INTO `image_likes`(`status`, `images_image_id`, `user_id`, $update_col) VALUES (0, 2, 1, 1) ON DUPLICATE KEY UPDATE $col = FALSE, $update_col = CASE WHEN $update_col = TRUE THEN FALSE WHEN $update_col = FALSE THEN TRUE END";
        $stmt = $this->_db->prepare($sql);
        try {
            $stmt->execute([$this->_like, $this->_user_id, $this->_image_id, $this->_like]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}