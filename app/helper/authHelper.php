<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($usuario) {
        self::init();
        $_SESSION['id_usuario'] = $usuario->id_usuario;
        $_SESSION['usuario'] = $usuario->usuario; 
    }

    public static function logout() {
        self::init();
        session_destroy();
    }

    public static function verify() {
        self::init();
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL . 'iniciosesion');
            die();
        }
    }
}