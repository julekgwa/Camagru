<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/16/16
 * Time: 4:33 PM
 */
class Controller {
    
    protected function model($model) {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }
    }
    
    protected function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }
    }
}
