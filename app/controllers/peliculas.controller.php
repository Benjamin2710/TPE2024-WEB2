<?php
require_once __DIR__ . '/../models/peliculas.model.php';
require_once __DIR__ . '/../views/peliculas.view.php';
require_once __DIR__ . '/../models/generos.model.php';


class PeliculasController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PeliculasModel();
        $this->generosModel = new GenerosModel();
        $this->view = new PeliculasView();
    }

    public function showPeliculas() {
        $peliculas = $this->model->getPeliculas();
        return $this->view->showPeliculas($peliculas);
    }

    public function showPelicula($id) {
        if($this->peliculaExists($id)){
            $pelicula = $this->model->getPelicula($id);
            return $this->view->showPelicula($pelicula);
        }else{
            return $this->view->showError('Pelicula no encontrada');
        }
        
    }

    public function showFormAltaPelicula() {
        $generos = $this->generosModel->getGeneros();
        return $this->view->showFormAltaPelicula($generos);
    }
    
    public function insertarPelicula() {
        if (!isset($_POST['titulo']) || empty($_POST['titulo'])) {
            return $this->view->showError('Falta completar el título');
        }
        if (!isset($_POST['anio']) || empty($_POST['anio'])) {
            return $this->view->showError('Falta completar el año');
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
        $anio = $_POST['anio'];
        $id_genero = $_POST['id_genero'];


        $id = $this->model->insertarPelicula($titulo, $descripcion, $director, $anio, $id_genero);
        header('Location: ' . BASE_URL . 'pelicula/' . $id); //se redirige a la vista de la película recién insertada
    }

    public function borrarPelicula($id) {
        if ($this->peliculaExists($id)) {
            $this->model->borrarPelicula($id);
            header('Location: ' . BASE_URL . 'peliculas');
        } else {
            return $this->view->showError('La película no existe');
        }
    }

    public function showPeliculasByGenero($id_genero) {
        if($this->generoExists($id_genero)){
            $peliculas = $this->model->getPeliculasByGenero($id_genero);
            return $this->view->showPeliculas($peliculas);
        }else{
            return $this->view->showError('Género no encontrado');
        }
    }

    private function generoExists($id) { //que lo haga generos model!!!
        return $this->model->generoExists($id);
    }

    private function peliculaExists($id) {
        return $this->model->peliculaExists($id);
    }
    //prueba
    // para mostrar la lista de los géneros
    public function showGeneros($generos){
        require 'templates/layout/header.phtml';
        echo "<h1>Lista de Géneros de Películas</h1>";
        echo "<ul>";
        foreach ($generos as $genero) {
            echo "<li><strong>{$genero->nombre}</strong>: {$genero->descripcion} (Clasificación: {$genero->clasificacion_por_edad})</li>";
        }
        echo "</ul>";
    }
}
