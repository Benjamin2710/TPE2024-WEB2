<?php

require_once 'app/controllers/peliculas.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/user.controller.php';
require_once 'app/helper/authHelper.php';
require_once 'libs/response.php';
require_once 'libs/funciones.php';


// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$action = 'peliculas'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$res = new Response();
AuthHelper::sessionAuth($res);

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'peliculas':
        if (isset($params[1]) && !empty($params[1])) {
            $controller = new PeliculasController($res);
            $controller->showPeliculas($params[1]);
        }else{
            $controller = new PeliculasController($res);
            $controller->showPeliculas();
        }
        break;
    case 'pelicula':
        $controller = new PeliculasController($res);
        if (!isset($params[1]) || empty($params[1])) {
            $controller->showError("Falta el id de la pelicula");
        }else{
            $controller->showPelicula($params[1]);
        }
        break;
    case 'editarPelicula':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController();
        $controller->editarPelicula();
        break;
    case 'eliminarPelicula':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController();
        if (!isset($params[1]) || empty($params[1])) {
            $controller->showError("Falta el id de la pelicula a eliminar");
        }else{
            $controller->borrarPelicula($params[1]);
        }
        break;
    case 'nuevaPelicula':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController($res);
        $controller->showFormAltaPelicula();
        break;
    case 'insertarPelicula':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController();
        $controller->insertarPelicula();
        break;
    case 'generos':
        $controller = new PeliculasController($res); // Corrección de typo
        $controller->showGeneros();
        break;
    case 'genero':
        $controller = new PeliculasController($res);
        if (!isset($params[1]) || empty($params[1])) {
            $controller->showError("Falta el id del genero");
        }else{
            $controller->showGenero($params[1]);
        }
        break;
    case 'editarGenero':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController();
        $controller->editarGenero();
        break;
    case 'eliminarGenero':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController();
        if (!isset($params[1]) || empty($params[1])) {
            $controller->showError("Falta el id del genero a eliminar");
        }else{
            $controller->eliminarGenero($params[1]);
        }
        break;
    case 'insertarGenero':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController();
        $controller->insertarGenero();
        break;
    case 'nuevoGenero':
        AuthHelper::verifyAdmin($res);
        $controller = new PeliculasController($res);
        $controller->showFormAltaGenero();
        break;
    case 'signup':
        $controller = new AuthController($res);
        $controller->showSignup();
        break;
    case 'signupUser':
        $controller = new UserController();
        $controller->signup();
        break;
    case 'login':
        $controller = new AuthController($res);
        $controller->showLogin();
        break;
    case 'logout': 
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'auth':
        $controller = new AuthController($res);
        $controller->login();
    default: 
        $controller = new PeliculasController();
        $controller->showError("404 Page Not Found");
        break;
}

test_var($res);
test_var($_SESSION);