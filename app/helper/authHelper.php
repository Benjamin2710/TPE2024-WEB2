<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($usuario) {
        self::init();
        $_SESSION['id_usuario'] = $usuario->id;
        $_SESSION['username'] = $usuario->username;
        $_SESSION['role'] = $usuario->role;
    }

    public static function logout() {
        self::init();
        session_destroy();
    }

    //adaptado para que parezca al middleware del profe
    public static function verify($res) {
        self::init();
        if($res->user) {
            return;
        } else {
            header('Location: ' . BASE_URL . 'login');
            die();
        }

    }

    //esto viene del middleware del profe
    public static function sessionAuth($res) {
        self::init();
        if (isset($_SESSION['id_usuario'])) {
            $res->user = new stdClass();
            $res->user->username = $_SESSION['username'];
            $res->user->id = $_SESSION['id_usuario'];
            $res->user->role = $_SESSION['role'];
        }
    }

    public static function verifyAdmin($res) {
        self::init();
        if(isset($res->user) && 
        isset($res->user->role) && $res->user->role === 'admin') {
            return;
        } else {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }
}