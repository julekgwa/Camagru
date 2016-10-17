<?php

class Edit extends Controller {

    public function index() {
        $this->view('templates/header');
        $this->view('edit/index');
        $this->view('templates/footer');
    }

    public function uploads() {

    }
}
