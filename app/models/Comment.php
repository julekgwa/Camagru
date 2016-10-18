<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 2016/10/18
 * Time: 1:29 PM
 */
class Comment
{
    private $_comment;
    private $_user_id;
    private $_image_id;
    private $_db;

    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function set_comment_info($comment, $user_id, $image_id)
    {
        $this->_comment = $comment;
        $this->_user_id = $user_id;
        $this->_image_id = $image_id;
    }

    public function get_comments_by_id($id) {
        $stmt = $this->_db->prepare('SELECT * FROM `comments` INNER JOIN users ON users.user_id = comments.users_id WHERE `images_image_id` = ? ORDER BY comment_created DESC');
        try {
            $stmt->execute([$id]);
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e){
            return null;
        }
    }

    public function insert_comment() {
        $stmt = $this->_db->prepare('INSERT INTO `comments`( `images_image_id`, `comment`, `users_id`) VALUES (?, ?, ?)');
        try {
            $stmt->execute([$this->_image_id, $this->_comment, $this->_user_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}