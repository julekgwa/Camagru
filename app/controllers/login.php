<?php

class Login extends Controller
{

    public function index($action = null)
    {
        $site_data = [];
        if ($action) {
            $site_data['action'] = $action;
        }
        $site_data['wrong_user_cred'] = $this->login_user();
        $this->view('templates/header');
        $this->view('login/index', $site_data);
        $this->view('templates/footer');
    }

    private function login_user()
    {
        if (filter_has_var(INPUT_POST, 'login')) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            $user = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $passwd = trim(filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING));
            if ($new_user->login($user, $passwd)) {
                $this->redirect(SITE_URL . '/edit');
            } else {
                return 'The username or password is incorrect.';
            }
        }
    }

}
