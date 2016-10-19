<?php

class Register extends Controller
{

    public function index($siter_error = [])
    {
        if (filter_has_var(INPUT_POST, 'register')) {
            $new_user_class = $this->model('User');
            $new_user_class->setDb(Controller::getDb());
            $new_user_class->set_site(SITE_URL);
            $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $passwd = trim(filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING));
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));

        }
        $this->view('templates/header');
        $this->view('register/index', $siter_error);
        $this->view('templates/footer');
    }

    public function register_user($email, $new_user_class, $passwd, $username)
    {

        if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
            if (strlen($passwd) < 8 || strlen($passwd) > 20) {
                $site_data['passwd'] = 'Password is too short, must be between 8 and 20 characters.';
            }

            if (strlen($username) < 4) {
                $site_data['username'] = 'Username is too short, must be atleast 4 characters long.';
            }
            if (!isset($site_data)) {
                if (!$new_user_class->is_passwd_valid($passwd)) {
                    $site_data['passwd'] = 'Password needs to contain, atleast 1 number and 1 special characters.';
                }
                if (!$new_user_class->is_username_valid($username)) {
                    $site_data['username'] = 'Only alphanumeric characters and underscore are allowed.';
                }
                if (!isset($site_data)) {
                    if ($new_user_class->is_email_used($email)) {
                        $site_data['email'] = 'Email provided is already in use.';
                    }
                    if ($new_user_class->is_username_used($username)) {
                        $site_data['username'] = 'Username provided is already in use.';
                    }
                    if (!isset($site_data)) {
                        if ($new_user_class->register($username, $email, $passwd)) {
                            $this->redirect(SITE_URL . '/login/registered');
                        } else {
                            $site_data['username'] = 'Something went wrong';
                        }
                    }
                }
            }
        } else {
            $site_data['email'] = 'Please enter a valid email address.';
        }
        return $site_data;
    }
}

