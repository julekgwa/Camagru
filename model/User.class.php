<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author julekgwa
 */
class User {

    private $_db;
    private $_site;
    private $_rowCount;

    function __construct($DB) {
        $this->_db = $DB;
    }

    /**
     * 
     * @param string username for the user.
     * @param string user registration email.
     * @param string user password.
     * @return boolean true if successful.
     */
    public function register($user_name, $user_email, $user_passwd) {
        $stmt = $this->_db->prepare('INSERT INTO `users`(`user_name`, `user_email`, `user_passwd`, `activated`) VALUES (?, ?, ?, ?)');
        $code = md5(uniqid(rand(), true)); //creating activation code.
        try {
            $passwd_hash = password_hash($user_passwd, PASSWORD_DEFAULT);
            $stmt->execute(array($user_name, $user_email, $passwd_hash, $code));
            $user_id = $this->_db->lastInsertId();
            $this->send_mail($user_name, $user_email, $user_id, $code);
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage(); //don't forget to display friendly error messages to the user
            return FALSE;
        }
    }

    /**
     * @param mixed $site
     */
    public function set_site($site) {
        $this->_site = $site;
    }

    public function login($user_email, $user_passwd) {
        $stmt = $this->_db->prepare('SELECT * FROM `users` WHERE (`user_name` = ? OR `user_email` = ?) AND activated = ?');
        try {
            $stmt->execute(array($user_email, $user_email, '1'));
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($user_passwd, $results['user_passwd'])) {
                    $_SESSION['logged_on_user'] = $results['user_name'];
                    $_SESSION['last_login'] = time();
                    return TRUE;
                }
            } else {
                return FALSE;
            }
            return false;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            require_once('../view/display_error.php'); //don't forget to display friendly error messages to the user
            exit();
        }
    }

    public function is_logged_on() {
        if (isset($_SESSION['logged_on_user'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logout() {
        session_destroy();
        session_unset();
        unset($_SESSION['logged_on_user']);
        unset($_SESSION['last_login']);
        return true;
    }

    private function send_mail($username, $email, $user_id, $code) {
        $subject = "Registration Confirmation";
        $to = $email;
        $headers = "From: no-reply@camagru.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $msg = $this->mail_content($username, $email, $user_id, $code);
        mail($to, $subject, $msg, $headers);
    }

    public function activate($id, $code) {
        $stmt = $this->_db->prepare("UPDATE `users` SET `activated` = '1' WHERE `user_id` = ? AND `activated` = ?");
        try {
            $stmt->execute(array($id, $code));
            $this->_rowCount = $stmt->rowCount();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function rowCount() {
        return $this->_rowCount;
    }

    private function mail_content($username, $email, $user_id, $code) {
        $content = "<html><head><meta name='viewport' content='width=device-width, initial-scale=1.0'></head><body>
                    <table width='100%' border='0' cellpadding='0'> <tr><td><table align='center' border='0' cellpadding='0' cellspacing='0'
                    style='border-collapse: collapse; width: 80%; margin: 0 auto; border: 1px solid #cccccc;'> <tr><td bgcolor='#03A9F4' 
                    align='center' style='padding: 20px 0 30px 0;'><img src='$this->_site/img/logo.png'></td></tr><tr> <td bgcolor='#ffffff' 
                    style='padding: 40px 30px 40px 30px;'><table><tr><td>Welcome to Camagru !</td></tr><tr> <td style='padding: 20px 0 30px 0;'>
                    Thank you for registering at Camagru, your account has been activated.<br> You can go to $this->_site to log into your account.
                    Your account information is shown below for reference purposes.<br><br> Login : $username or $email <br><br> The last 
                    step is the validation of your email address. For that, please visit this URL: $this->_site/view/activate.php?id=$user_id&activate=$code <br><br> Thanks and enjoy :)<br><br> All the best,<br> Camagru Team.
                    </td> </tr> </table> </td> </tr> <tr> <td bgcolor='#03A9F4' style='padding: 20px 20px 20px 20px; color: #ffffff'> &copy; Camagru 2016. 
                    </td> </tr> </table> </td> </tr> </table> </body> </html>";
        return $content;
    }

    public function is_email_used($email) {
        $stmt = $this->_db->prepare('SELECT * FROM `users` WHERE `user_email` = ?');
        try {
            $stmt->execute(array($email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($row['user_email'])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage(); //display a nice message to the user.
            return FALSE;
        }
    }

    public function is_username_used($user_name) {
        $stmt = $this->_db->prepare('SELECT * FROM `users` WHERE `user_name` = ?');
        try {
            $stmt->execute(array($user_name));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($row['user_name'])) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage(); //display a nice message to the user.
            return FALSE;
        }
    }

    public function is_passwd_valid($passwd) {
        if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/', $passwd)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function is_username_valid($user_name) {
        if (preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_+[A-Za-z0-9]+)*$/', $user_name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
