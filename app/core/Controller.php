<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/16/16
 * Time: 4:33 PM
 */
class Controller {

    public static $db;

    protected function model($model) {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }
    }

    public static function getDb()
    {
        return self::$db;
    }

    protected function view($view, $site_error = [])
    {
        if (file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }
    }

    protected function redirect($location){
        header("Location: $location");
    }

    public static function logged_on()
    {
        if (isset($_SESSION['logged_on_user'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
