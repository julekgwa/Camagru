<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/16/16
 * Time: 4:24 PM
 */
class Home extends Controller {

    public function index($current = '') {
        $site_data['id'] = $current;
        $image = $this->model('Image');
        $image->setDb(Controller::$db);
        $site_data['obj'] = $image;
        $this->view('templates/header');
        $this->view('home/index', $site_data);
        $this->view('templates/footer');
    }

    protected function load_data() {
        $image = $this->model('Image');
        $image->setDb(Controller::$db);
        return $image->get_images();
    }
}
