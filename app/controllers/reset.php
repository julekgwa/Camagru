<?php

class Reset extends Controller {

  public function index() {
        $this->view('templates/header');
        $this->view('reset/index');
        $this->view('templates/footer');
    }

}
