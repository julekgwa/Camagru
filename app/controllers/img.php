<?php

class Img extends Controller {
    public function index() {
       if (filter_has_var(INPUT_POST, 'upload')) {
           $img = $this->model('Image');
       }
        $this->view('templates/header');
        $this->view('img/index');
        $this->view('templates/footer');
    }
}