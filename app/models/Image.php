<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/17/16
 * Time: 9:33 PM
 */
class Image
{
    private $_title;
    private $_user_id;
    private $_url;
    private $_db;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->_user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->_db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function set_image_info($title, $url, $user_id)
    {
        $this->_url = $url;
        $this->_user_id = $user_id;
        $this->_title = $title;
    }

    public function insert_image()
    {
        $stmt = $this->_db->prepare('INSERT INTO `images`(`users_user_id`, `image_url`, `image_title`) VALUES (?, ?, ?)');
        try {
            $stmt->execute([$this->_user_id, $this->_url, $this->_title]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function get_image_by_id($id)
    {
        $stmt = $this->_db->prepare('SELECT * FROM `images` WHERE `image_id` = ?');
        try {
            $stmt->execuet([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function move_uploaded_img($tmp_file, $new_loc)
    {
        if (file_exists($new_loc)) {
            $new_img = explode('.', $new_loc);
            $new_loc = $new_img[0] . mt_rand() . '.' . $new_img[1];
        }
        if (move_uploaded_file($tmp_file, $new_loc)) {
            return $new_loc;
        } else {
            return false;
        }
    }

    public function get_images() {
        $stmt = $this->_db->prepare('SELECT * FROM images INNER JOIN users ON images.users_user_id = users.user_id ORDER BY image_created DESC');
        try {
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            return false;
        }
    }
}