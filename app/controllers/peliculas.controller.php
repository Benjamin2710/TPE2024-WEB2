<?php
require_once './app/models/peliculas.model.php';
require_once './app/views/peliculas.view.php';

class PeliculasController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PeliculasModel();
        $this->view = new PeliculasView();
    }

    public function showpeliculas() {
        $peliculas = $this->model->getPeliculas();
        return $this->view->showPeliculas($peliculas);
    }

    public function showpelicula($id) {
        $pelicula = $this->model->getPelicula($id);
        return $this->view->showPelicula($pelicula);
    }
    
    public function insertarPelicula() {
        if (!isset($_POST['titulo']) || empty($_POST['titulo'])) {
            return $this->view->showError('Falta completar el título');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar la descripción');
        }
        if (!isset($_POST['director']) || empty($_POST['director'])) {
            return $this->view->showError('Falta completar el director');
        }
        if (!isset($_POST['id_genero']) || empty($_POST['id_genero'])) {
            return $this->view->showError('Falta completar el género');
        }

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $director = $_POST['director'];
        $id_genero = $_POST['id_genero'];


        $id = $this->model->insertarPelicula($titulo, $descripcion, $director, $id_genero);
        header('Location: ' . BASE_URL . 'pelicula/' . $id); //se redirige a la vista de la película recién insertada

    }

    public function borrarPelicula($id) {
        $pelicula = $this->model->getPelicula($id);
        if ($pelicula) {
            $this->model->borrarPelicula($id);
            header('Location: ' . BASE_URL . 'peliculas');
        } else {
            return $this->view->showError('La película no existe');
        }
    }
}