<?php

require_once DIRECTORY . '/../model/Model.class.php';

class Controller
{

    private $_model;

    public function __construct($db)
    {
        $this->_model = new Model($db);
    }

    public function set_site($site)
    {
        $this->_model->set_site($site);
    }

    public function login($username, $passwd)
    {
        return $this->_model->login($username, $passwd);
    }

    public function logout()
    {
        return $this->_model->logout();
    }

    public function is_valid_passwd($passwd)
    {
        return $this->_model->is_valid_passwd($passwd);
    }

    public function is_valid_username($username)
    {
        return $this->_model->is_valid_username($username);
    }

    public function used_email($email)
    {
        return $this->_model->used_email($email);
    }

    public function used_username($username)
    {
        return $this->_model->used_username($username);
    }

    public function register($username, $email, $passwd)
    {
        return $this->_model->register($username, $email, $passwd);
    }

    public function activate_user($id, $code)
    {
        return $this->_model->activate_user($id, $code);
    }

    public function get_row_count()
    {
        return $this->_model->getRowCount();
    }

    public function get_email_structure($message)
    {
        return $this->get_email_structure($message);
    }

    public function is_logged_on()
    {
        return $this->_model->is_logged_on();
    }

    public function user_id($username)
    {
        return $this->_model->get_user_id($username);
    }
}
