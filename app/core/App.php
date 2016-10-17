<?php

/**
 * Created by PhpStorm.
 * User: julekgwa
 * Date: 10/16/16
 * Time: 3:45 PM
 */
class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parse_url();
        if (file_exists('../app/controllers/' . $url[0] . '.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once ('../app/controllers/' . $this->controller . '.php');
        $this->controller = new  $this->controller;
        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parse_url() {
        if (filter_has_var(INPUT_GET, 'url')){
            return explode('/', filter_var(trim(filter_input(INPUT_GET, 'url'), '/'), FILTER_SANITIZE_URL));
        }
    }
}