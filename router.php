<?php

require_once 'app/controllers/peliculas.controller.php';


// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo todo (robado del profe por eso dice task)

// listar  -> TaskController->showTask();
// nueva  -> TaskController->addTask();
// eliminar/:ID  -> TaskController->deleteTask($id);
// finalizar/:ID -> TaskController->finishTask($id);
// ver/:ID -> TaskController->view($id); COMPLETAR

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'peliculas':
        $controller = new PeliculasController();
        $controller->showPeliculas();
        break;
    case 'pelicula':
        $controller = new PeliculasController();
        $controller->showPelicula($params[1]);
        break;
    case 'eliminar': // todavia no testeado
        $controller = new PeliculasController();
        $controller->borrarPelicula($params[1]);
        break;
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}
