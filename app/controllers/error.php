<?php

class Error extends Controller {

    public function index()
    {
        $this->view('templates/header');
        $this->view('error/index');
        $this->view('templates/footer');
    }
}