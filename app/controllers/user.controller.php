<?php
require_once './app/models/user.model.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function signup() {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $this->model->addUser($username, $password, $role);
        header('Location: ' . BASE_URL . 'login');
    }
}
