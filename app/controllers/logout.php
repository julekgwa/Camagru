<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 2016/10/17
 * Time: 3:13 PM
 */
class Logout extends Controller
{
    public function index()
    {
        $new_user = $this->model('User');
        $new_user->setDb(Controller::getDb());
        $new_user->set_site(SITE_URL);
        if ($new_user->logout()) {
            $this->redirect(SITE_URL . '/home');
        }
        $this->view('templates/header');
        $this->view('logout/index');
        $this->view('templates/footer');
    }
}