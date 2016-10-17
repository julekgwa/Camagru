<?php

class Login extends Controller {
    
    public function index($action = null) {
    	$site_error = [];
    	if ($action) {
    		$site_error['action'] = $action;
    	}
        $this->view('templates/header');
        $this->view('login/index', $site_error);
        $this->view('templates/footer');
    }

}
