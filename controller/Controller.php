<?php

require_once DIRECTORY . '/../model/User.class.php';

class Controller {

    private $_model;

    function __construct($DB) {
        $this->_model = new User($DB);
    }

    public function is_logged_in() {
        if ($this->_model->is_logged_on()) {
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
        if ($this->_model->register($user_name, $user_email, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_site($site) {
        $this->_model->set_site($site);
    }

    /**
     * @return User
     */
    public function activate_user($id, $code) {
        if ($this->_model->activate($id, $code)) {
            return true;
        } else {
            return false;
        }
    }

    public function getRowCount() {
        return $this->_model->rowCount();
    }

    public function login($username, $user_passwd) {
        if ($this->_model->login($username, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logout() {
        if ($this->_model->logout()) {
            return true;
        }
    }
    
    public function used_email($email) {
        return $this->_model->is_email_used($email);
    }
    
    public function used_username($user_name) {
        return $this->_model->is_username_used($user_name);
    }
    
    public function is_valid_passwd($passwd) {
        return $this->_model->is_passwd_valid($passwd);
    }
    
    public function is_valid_username($user_name) {
        return $this->_model->is_username_valid($user_name);
    }

    public function get_email_structure($message)
    {
        return $this->_model->mail_content($message);
    }

    public function is_valid_code($code){
        return $this->_model->is_reset_valid($code);
    }
}
