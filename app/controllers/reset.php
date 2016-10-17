<?php

class Reset extends Controller
{

    public function index($code = null)
    {
        $site_error = [];
        if ($code) {
            $site_error['code'] = $code;
        }
        if (filter_has_var(INPUT_POST, 'reset')) {
            $site_error = $this->reset_passwd();
        }

        if (filter_has_var(INPUT_POST, 'new')) {
            $site_error = $this->new_passwd($code);
        }
        $this->view('templates/header');
        $this->view('reset/index', $site_error);
        $this->view('templates/footer');
    }

    /**
     * check if email is valid.
     * check if the reset code has been sent.
     * check if email it exits in our database.
     * generate a reset code and sent an email to the profile.
     * if success redirect to login page, with action set to reset.
     */
    protected function reset_passwd()
    {
        if (filter_has_var(INPUT_POST, 'reset')) {
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
                        $site_error['email'] = 'Reset code has already been emailed to you, use the link provided!';
                        return $site_error;
                    }
                    if (!isset($site_error)) {
                        //check if email exits.
                        $user_name = $row['user_name'];
                        if ($new_user->is_email_used($email)) {
                            $code = md5(uniqid(rand(), true)); //create reset code.
                            $stmt = Controller::$db->prepare('UPDATE `users` SET `reset`= ? WHERE `user_email` = ?');
                            try {
                                $stmt->execute(array($code, $email));
                                $message = "<h2>Hello , $user_name</h2>
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
                                header('Location: ' . SITE_URL . '/login/reset');
                            } catch (PDOException $exc) {
                                echo $exc->getTraceAsString(); //display error message here.
                            }
                        } else {
                            $site_error['email'] = 'Email provided is not recognised.';
                            return $site_error;
                        }
                    }
                } catch (PDOException $exc) {
                    echo $exc->getTraceAsString(); //display error messages.
                }
            } else {
                $site_error['email'] = 'Please enter a valid email address.';
                return $site_error;
            }
        }
    }

    /**
     * check the length of the password.
     * check if the token is valid.
     * check if the password provided is valid.
     * then update the password and set token to null.
     * if success redirect to login page, with action set to changed.
     */
    public function new_passwd($code)
    {
        if (filter_has_var(INPUT_POST, 'new')) {
            $new_user = $this->model('User');
            $new_user->setDb(Controller::getDb());
            $new_user->set_site(SITE_URL);
            $passwd = filter_input(INPUT_POST, 'newpasswd');
            $code = trim($code);
            if (strlen($passwd) < 8 || strlen($passwd) > 20) {
                $site_error['passwd'] = 'Password is too short, must be between 8 and 20 characters.';
                return $site_error;
            }
            if (!$new_user->is_reset_valid($code)) {
                $site_error['passwd'] = 'Invalid token provided, please use the link provided in the reset email.';
                return $site_error;
            }
            if (!isset($site_error)) {
                if (!$new_user->is_passwd_valid($passwd)) {
                    $site_error['passwd'] = 'Password needs to contain, atleast 1 number and 1 special characters.';
                    return $site_error;
                }
                if (!isset($site_error)) {
                    $hash_passwd = password_hash($passwd, PASSWORD_DEFAULT);
                    $stmt = Controller::$db->prepare('UPDATE `users` SET `user_passwd`= ? ,`reset` = NULL WHERE `reset` = ?');
                    try {
                        $stmt->execute(array($hash_passwd, $code));
                        header('Location: ' . SITE_URL . '/login/changed');
                    } catch (PDOException $e) {
                        echo $e->getMessage(); //display error message here.
                    }
                }
            }
        }
    }
}
