<?php

class Image extends Controller {
    public function index() {
//        $user = $this->model('User');
//        $user->setName($name);
        $this->view('templates/header');
        $this->view('image/index');
        $this->view('templates/footer');
    }
}