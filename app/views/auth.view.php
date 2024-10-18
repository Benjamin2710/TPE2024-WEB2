<?php

class AuthView {
    private $res;

    public function __construct($res = null) {
        $this->res = $res;
    }

    public function showLogin($error = '') {
        require 'templates/formLogin.phtml';
    }

    public function showSignup($error = '') {
        require 'templates/formSignup.phtml';
    }
}
