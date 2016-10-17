<?php
/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 2016/10/17
 * Time: 2:05 PM
 */
class Activate extends Controller {

    public function index($id = null, $code = null) {
        if ($id && $code) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);

            $id = base64_decode($id);
            $code = trim(filter_var($code, FILTER_SANITIZE_STRING));
            if (is_numeric($id) && !empty($code)) {
                $new_user->activate($id, $code);
                if ($new_user->rowCount() == 1) {
                    $this->redirect(SITE_URL . '/login/active');
                    exit();
                }
            }
        }
        $this->view('templates/header');
        $this->view('activate/index');
        $this->view('templates/footer');
    }
}