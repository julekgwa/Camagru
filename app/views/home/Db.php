<?php

/**
* 
*/
class Db {
	private $_db;

	public function __construct($dsn,$username,$password,$options) {
		try {
			$this->_db = new PDO($dsn,$username,$password,$options);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	// get row counts
	public function rowCounts($tableName) {
        return $this->_db->query("SELECT * FROM $tableName")->rowCount();
    }

    // get rows left in the database
    public function rowsLeft($tableName, $start, $limit) {
        return $this->_db->query("SELECT * FROM $tableName LIMIT $start, $limit")->rowCount();
    }

    // select data from the database
    public function selecetLimit($tableName, $columns, $start, $limit) {
 
            $select = "SELECT $columns FROM $tableName ORDER BY image_id DESC LIMIT ?,?";
            $prepare = $this->_db->prepare($select);
            $prepare->bindParam(1, $start, PDO::PARAM_INT);
            $prepare->bindParam(2, $limit, PDO::PARAM_INT);
            $prepare->execute();
            $resulst = $prepare->fetchAll();
        return $resulst;
    }

    public function get_images_limit($start, $limit)
    {
        $prepare = $this->_db->prepare('SELECT images.image_id, images.image_url, users.user_name FROM (SELECT * FROM images LIMIT ?,?) images INNER JOIN users ON images.users_user_id = users.user_id ORDER BY image_created DESC');
        try {
            $prepare->bindParam(1, $start, PDO::PARAM_INT);
            $prepare->bindParam(2, $limit, PDO::PARAM_INT);
            $prepare->execute();
            $results = $prepare->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


