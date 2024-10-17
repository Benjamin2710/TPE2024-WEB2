<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helper/authHelper.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        // Muestro el formulario de login
        return $this->view->showLogin();
    }

    public function showSignup() {
        // Muestro el formulario de registro
        return $this->view->showSignup();
    }
}