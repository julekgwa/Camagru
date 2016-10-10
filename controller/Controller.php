<?php
require_once DIRECTORY . '/../model/User.class.php';

class Controller {

    private $_model;

    function __construct($DB) {
        $this->_model = new User($DB);
    }

    public function is_logged_in() {
        if ($this->_model->is_logged_on()) {
            include DIRECTORY . '../view/edit_image.php';
        } else {
            include DIRECTORY . '../view/login.php';
        }
    }

    public function register($user_name, $user_email, $user_passwd) {
        if ($this->_model->register($user_name, $user_email, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_site($site)
    {
        $this->_model->set_site($site);
    }

    /**
     * @return User
     */
    public function activate_user($id, $code)
    {
        if ($this->_model->activate($id, $code))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getRowCount()
    {
        return $this->_model->rowCount();
    }

    public function login($username, $user_passwd) {
        if ($this->_model->login($username, $user_passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function logout()
    {
        if ($this->_model->logout())
        {
            return true;
        }
    }

}
