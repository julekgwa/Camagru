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
class User {

    private $_db;

    function __construct($DB) {
        $this->_db = $DB;
    }

    public function register($user_email, $user_passwd) {
        
    }

    public function login($user_email, $user_passwd) {
        
    }

    public function is_logged_on() {
        if (isset($_SESSION['logged_on_user'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
