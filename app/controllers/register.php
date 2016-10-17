<?php

class Register extends Controller {

    public function index($siter_error = []) {
        $this->view('templates/header');
        $this->view('register/index', $siter_error);
        $this->view('templates/footer');
    }

    public function user() {
        if (filter_has_var(INPUT_POST, 'register')) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            $user = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $passwd = trim(filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING));
            if (($email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)))) {
                if (strlen($passwd) < 8 || strlen($passwd) > 20) {
                    $site_error['passwd'] = 'Password is too short, must be between 8 and 20 characters.';
                }

                if (strlen($user) < 4) {
                    $site_error['username'] = 'Username is too short, must be atleast 4 characters long.';
                }
                if (!isset($site_error)) {
                    if (!$new_user->is_passwd_valid($passwd)) {
                        $site_error['passwd'] = 'Password needs to contain, atleast 1 number and 1 special characters.';
                    }
                    if (!$new_user->is_username_valid($user)) {
                        $site_error['username'] = 'Only alphanumeric characters and underscore are allowed.';
                    }
                    if (!isset($site_error)) {
                        if ($new_user->is_email_used($email)) {
                            $site_error['email'] = 'Email provided is already in use.';
                        }
                        if ($new_user->is_username_used($user)) {
                            $site_error['username'] = 'Username provided is already in use.';
                        }
                        if (!isset($site_error)) {
                            if ($new_user->register($user, $email, $passwd)) {
                                $this->redirect(SITE_URL . '/login/registered');
                            }else {
                                $this->index($site_error);
                            }
                        } else {
                            $this->index($site_error);
                        }
                    } else {
                        $this->index($site_error);
                    }
                } else {
                    $this->index($site_error);
                }
            } else {
                $site_error['email'] = 'Please enter a valid email address.';
                $this->index($site_error);
            }
        }
    }
}

