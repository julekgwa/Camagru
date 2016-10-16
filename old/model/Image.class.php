<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 2016/10/13
 * Time: 10:10 AM
 */
class Image
{
    private $_uploader_id;
    private $_created_time;
    private $_img_url;
    private $_title;
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function set_image_info($user_id, $img_url, $title)
    {
        $this->_uploader_id = $user_id;
        $this->_img_url = $img_url;
        $this->_title = $title;
        $this->_created_time = date("Y-m-d H:i:s");
    }

    public function is_image_valid()
    {
        return TRUE;
    }

    public function add_image()
    {
        $stmt  = $this->_db->prepare('INSERT INTO `images`(`users_user_id`, `image_created`, `image_url`, `image_title`) VALUES (? , ?, ?, ?)');
        try {
            $stmt->execute(array($this->_uploader_id, $this->_created_time, $this->_img_url, $this->_title));
            return TRUE;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return FALSE;
        }
    }

    public function get_images()
    {
      $stmt = $this->_db->prepare('SELECT * FROM `images` INNER JOIN users ON images.users_user_id = users.user_id');
        try {
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}