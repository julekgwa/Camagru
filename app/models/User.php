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
    private $name;
    private $surname;
    
    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }
}
