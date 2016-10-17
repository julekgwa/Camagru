<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/16/16
 * Time: 4:24 PM
 */
class Home extends Controller {

    public function index($name = '') {
//        $user = $this->model('User');
//        $user->setName($name);
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
}
