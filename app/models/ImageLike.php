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
        $stmt  = $this->_db->prepare('SELECT `image_like` FROM `image_likes` WHERE `images_image_id` = ? AND `user_id` = ?');
        try {
            $stmt->execute([$this->_image_id, $this->_user_id]);
            $like = $stmt->fetch(PDO::FETCH_ASSOC);
            return $like['image_like'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function like_hate() {
        $stmt = $this->_db->prepare('UPDATE `image_likes` SET `image_like`= ? WHERE `user_id` = ? AND `images_image_id` = ?');
        try {
            $stmt->execute([$this->_like, $this->_user_id, $this->_image_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function love() {

    }
}