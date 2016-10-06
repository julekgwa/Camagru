<?php

require_once '../model/User.class.php';

class Controller {

    private $_model;

    function __construct($DB) {
        $this->_model = new User($DB);
    }

    public function is_logged_in() {
        if ($this->_model->is_logged_on()) {
            include '../view/edit_image.php';
        } else {
            include '../view/login.php';
        }
    }

    public function register($user_name, $user_email, $user_passwd) {
        if ($this->_model->register($user_name, $user_email, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function login($username, $user_passwd) {
        if ($this->_model->login($username, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
