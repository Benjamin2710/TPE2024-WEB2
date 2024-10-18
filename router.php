<?php
require_once './app/controllers/pelicula.controller.php';
require_once './app/controllers/authController.php';
require_once './app/controllers/adminController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// listar    ->         taskController->showTasks();
// agregar   ->         taskController->addTask();
// eliminar/:ID  ->     taskController->removeTask($id); 
// finalizar/:ID  ->    taskController->finishTask($id);
// about ->             aboutController->showAbout();

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new peliculaController();
        $controller->homeController();
        break;
    case 'peliculas':
        $controller = new peliculaController();
        $controller->showPeliculas();
        break;
    case 'iniciosesion':
        $controller = new authController();
        $controller->showInicioSesion();
        break;
    case 'ingreso':
        $controller = new authController();
        $controller->ingreso();
        break;
    case 'logout':
        $controller = new authController();
        $controller->logout();
        break;
    case 'administrar':
        $controller = new adminController();
        $controller->showAdministrar();
        break;
    case 'eliminarpelicula':
        $controller = new adminController();
        $controller->deletePelicula();
        break;
    case 'agregarpelicula':
        $controller = new adminController();
        $controller->addPelicula();
        break;
    case 'editarpelicula':
        $controller = new adminController();
        $controller->updatePelicula();
        break;
    case 'agregargenero':
        $controller = new adminController();
        $controller->addGenero();
        break;
    case 'editargenero':
        $controller = new adminController();
        $controller->updateGenero();
        break;
    case 'eliminargenero':
        $controller = new adminController();
        $controller->removeGenero();
        break;
        default:
        $controller = new peliculaController();
        $controller->errorController();
        break;
    }
    
    