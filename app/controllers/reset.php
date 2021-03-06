<?php

class Reset extends Controller
{

    public function index($code = null)
    {
        $site_data = [];
        if ($code) {
            $site_data['code'] = $code;
        }
        if (filter_has_var(INPUT_POST, 'reset')) {
            $site_data = $this->reset_passwd();
        }

        if (filter_has_var(INPUT_POST, 'new')) {
            $site_data = $this->new_passwd($code);
        }
        $this->view('templates/header');
        $this->view('reset/index', $site_data);
        $this->view('templates/footer');
    }

    /**
     * check if email is valid.
     * check if the reset code has been sent.
     * check if email it exits in our database.
     * generate a reset code and sent an email to the profile.
     * if success redirect to login page, with action set to reset.
     */
    protected function reset_passwd($ajax = '')
    {
        if (filter_has_var(INPUT_POST, 'email')) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            //check if email is valid
            if (($email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)))) {
                $email = trim($email); //remove trailing spaces.
                $checker = Controller::$db->prepare('SELECT * FROM `users` WHERE `user_email` = ?');
                try {
                    $checker->execute(array($email));
                    $row = $checker->fetch(PDO::FETCH_ASSOC);
                    if (!empty($row['reset'])) {
                        $site_data['email'] = 'Reset code has already been emailed to you, use the link provided!';
                        if ($ajax) {
                            echo json_decode($site_data);
                        } else {
                            return $site_data;
                        }
                    }
                    if (!isset($site_data)) {
                        //check if email exits.
                        $user_name = $row['user_name'];
                        if ($new_user->is_email_used($email)) {
                            $code = md5(uniqid(rand(), true)); //create reset code.
                            $stmt = Controller::$db->prepare('UPDATE `users` SET `reset`= ? WHERE `user_email` = ?');
                            try {
                                $stmt->execute(array($code, $email));
                                $message = "<h2>Hello, $user_name</h2>
                            <br /><br />
       Someone requested that the password be reset for Camagru account:
       <br /><br />
       Details:<br>
        Username: $user_name<br>
        E-mail: $email <br><br>
        If this was a mistake, just ignore this email and nothing will happen.
       <br /><br />
       To reset your password, visit the following address:
       " . SITE_URL . "/reset/$code
       <br /><br />
       thank you :)
       ";
                                $headers = 'From: Camagru <julekgwa@camagru.com>' . "\r\n";
                                $headers .= 'MIME-Version: 1.0' . "\r\n";
                                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                mail($email, 'Reset password', $new_user->mail_content($message), $headers);
                                if ($ajax) {
                                    $site_data['results'] = 'success.';
                                    echo json_encode($site_data);
                                    return true;
                                } else {
                                    header('Location: ' . SITE_URL . '/login/reset');
                                }
                            } catch (PDOException $exc) {
                                echo $exc->getTraceAsString(); //display error message here.
                            }
                        } else {
                            $site_data['email'] = 'Email provided is not recognised.';
                            if ($ajax) {
                                echo json_encode($site_data);
                            } else {
                                return $site_data;
                            }
                        }
                    } else {
                        if ($ajax) {
                            echo json_encode($site_data);
                            return true;
                        }
                    }
                } catch (PDOException $exc) {
                    echo $exc->getTraceAsString(); //display error messages.
                }
            } else {
                $site_data['email'] = 'Please enter a valid email address.';
                if ($ajax) {
                    echo json_encode($site_data);
                    return true;
                } else {
                    return $site_data;
                }
            }
        }
    }

    public function reset_passwd_ajax()
    {
        $this->reset_passwd(1);
    }

    /**
     * check the length of the password.
     * check if the token is valid.
     * check if the password provided is valid.
     * then update the password and set token to null.
     * if success redirect to login page, with action set to changed.
     */
    public function new_passwd($code = '', $ajax = '')
    {
        if (filter_has_var(INPUT_POST, 'newpasswd')) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            $passwd = filter_input(INPUT_POST, 'newpasswd');
            $code = trim($code);
            if ($ajax) {
                $code = trim(filter_input(INPUT_POST, 'code'));
            }
            if ($code == null) {
                echo json_encode(['results' => 'the code provided is invalid']);
                return false;
            }
            if (strlen($passwd) < 8 || strlen($passwd) > 20) {
                $site_data['passwd'] = 'Password is too short, must be between 8 and 20 characters.';
                if ($ajax) {
                    echo json_encode($site_data);
                    return true;
                } else {
                    return $site_data;
                }
            }
            if (!$new_user->is_reset_valid($code)) {
                $site_data['passwd'] = 'Invalid token provided, please use the link provided in the reset email.';
                return $site_data;
            }
            if (!isset($site_data)) {
                if (!$new_user->is_passwd_valid($passwd)) {
                    $site_data['passwd'] = 'Password needs to contain, atleast 1 number and 1 special characters.';
                    if ($ajax) {
                        echo json_encode($site_data);
                        return true;
                    } else {
                        return $site_data;
                    }
                }
                if (!isset($site_data)) {
                    $hash_passwd = password_hash($passwd, PASSWORD_DEFAULT);
                    $stmt = Controller::$db->prepare('UPDATE `users` SET `user_passwd`= ? ,`reset` = NULL WHERE `reset` = ?');
                    try {
                        $stmt->execute(array($hash_passwd, $code));
                        if ($ajax) {
                            $site_data['results'] = 'success.';
                            echo json_encode($site_data);
                            return true;
                        } else {
                            header('Location: ' . SITE_URL . '/login/changed');
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage(); //display error message here.
                    }
                }
            }
            if ($ajax) {
                echo json_encode($site_data);
                return false;
            }
        }
    }

    public function new_passwd_ajax()
    {
        $this->new_passwd('', 1);
    }
}
