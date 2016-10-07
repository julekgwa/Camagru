<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author julekgwa
 */
class User
{

    private $_db;

    function __construct($DB)
    {
        $this->_db = $DB;
    }

    public function register($user_name, $user_email, $user_passwd)
    {
        $stmt = $this->_db->prepare('INSERT INTO `users`(`user_name`, `user_email`, `user_passwd`) VALUES (?,?,?)');
        try {
            $passwd_hash = password_hash($user_passwd, PASSWORD_DEFAULT);
            $stmt->execute(array($user_name, $user_email, $passwd_hash));
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return FALSE;
        }
    }

    public function login($user_email, $user_passwd)
    {
        $stmt = $this->_db->prepare('SELECT * FROM `users` WHERE `user_name` = ? OR `user_email` = ? LIMIT 1');
        try {
            $stmt->execute(array($user_email, $user_email));
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($user_passwd, $results['user_passwd'])) {
                    $_SESSION['logged_on_user'] = $results['user_name'];
                    $_SESSION['last_login'] = time();
                    return TRUE;
                }
            } else {
                return FALSE;
            }
            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_logged_on()
    {
        if (isset($_SESSION['logged_on_user'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['logged_on_user']);
        unset($_SESSION['last_login']);
        return true;
    }

}
