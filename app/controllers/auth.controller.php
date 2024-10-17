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

    public function login() {
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta contraseña');
        }
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model->getUserByUsername($username);
        if ($user && password_verify($password, $user->password)) {
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . 'home');
        } else {
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }

    public function showSignup() {
        // Muestro el formulario de registro
        return $this->view->showSignup();
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'login');
    }
}
