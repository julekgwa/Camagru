<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 2016/10/13
 * Time: 10:58 AM
 */
require_once ('User.class.php');
require_once ('Image.class.php');
class Model
{
    private $_user;
    private $_image;

    function __construct($DB) {
        $this->_user = new User($DB);
        $this->_image = new Image($DB);
    }

    public function is_logged_in() {
        if ($this->_user->is_logged_on()) {
            include DIRECTORY . '../view/home.php';
        } else {
            include DIRECTORY . '../view/login.php';
        }
    }

    /**
     *
     * @param string username for the user.
     * @param string user registration email.
     * @param string user password.
     * @return boolean true if successful.
     */
    public function register($user_name, $user_email, $user_passwd) {
        if ($this->_user->register($user_name, $user_email, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_site($site) {
        $this->_user->set_site($site);
    }

    /**
     * @return User
     */
    public function activate_user($id, $code) {
        if ($this->_user->activate($id, $code)) {
            return true;
        } else {
            return false;
        }
    }

    public function getRowCount() {
        return $this->_user->rowCount();
    }

    public function login($username, $user_passwd) {
        if ($this->_user->login($username, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logout() {
        if ($this->_user->logout()) {
            return true;
        }
    }

    public function used_email($email) {
        return $this->_user->is_email_used($email);
    }

    public function used_username($user_name) {
        return $this->_user->is_username_used($user_name);
    }

    public function is_valid_passwd($passwd) {
        return $this->_user->is_passwd_valid($passwd);
    }

    public function is_valid_username($user_name) {
        return $this->_user->is_username_valid($user_name);
    }

    public function get_email_structure($message)
    {
        return $this->_user->mail_content($message);
    }

    public function is_valid_code($code){
        return $this->_user->is_reset_valid($code);
    }

    public function is_logged_on()
    {
        return $this->_user->is_logged_on();
    }

    public function get_user_id($username)
    {
        return $this->_user->get_user_id($username);
    }
}