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
    private $_created;
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
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->_created = $created;
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

    public function set_image_info($title, $created, $url, $user_id) {
        $this->_created = $created;
        $this->_url = $url;
        $this->_user_id = $user_id;
        $this->_title = $title;
    }

    public function insert_image() {
        $stmt  = $this->_db->prepare('INSERT INTO `images`(`users_user_id`, `image_created`, `image_url`, `image_title`) VALUES (?, ?, ?, ?)');
        try {
            $stmt->execute([$this->_user_id, $this->_created], $this->_url, $this->_title);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function get_image_by_id($id) {
        $stmt = $this->_db->prepare('SELECT * FROM `images` WHERE `image_id` = ?');
        try {
            $stmt->execuet([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
}