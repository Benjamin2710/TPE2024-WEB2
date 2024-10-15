<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/formLogin.phtml';
    }

    public function showSignup($error = '') {
        require 'templates/formSignup.phtml';
    }
}
