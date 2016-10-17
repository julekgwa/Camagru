<?php
/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/17/16
 * Time: 8:22 PM
 */
class Profile extends Controller {
    public function index($username = null) {
        $site_error = [];
        if ($username) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            $site_error = $new_user->get_user($username);
        }
        $this->view('templates/header');
        $this->view('profile/index', $site_error);
        $this->view('templates/footer');
    }
}