<?php

class Register extends Controller {

    public function index() {
        $this->view('templates/header');
        $this->view('register/index');
        $this->view('templates/footer');
    }

}

