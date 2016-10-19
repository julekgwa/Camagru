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

    public function like_hate($col, $update_col) {
        $sql = "INSERT INTO `image_likes`(`images_image_id`, `user_id`, $update_col) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE $col = FALSE, $update_col = CASE WHEN $update_col = TRUE THEN FALSE WHEN $update_col = FALSE THEN TRUE END";
        $stmt = $this->_db->prepare($sql);
        try {
            $stmt->execute([ $this->_image_id, $this->_user_id, $this->_like]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function get_likes($db) {
        $stmt = $db->prepare('SELECT COUNT(*) AS `total` FROM `image_likes` WHERE `image_like_love` = true');
        try {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (PDOException $e) {
            return false;
        }
    }

    public function get_dislikes($db) {
        $stmt = $db->prepare('SELECT COUNT(*) AS `total` FROM `image_likes` WHERE `image_like_hate` = true');
        try {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (PDOException $e) {
            return false;
        }
    }
}