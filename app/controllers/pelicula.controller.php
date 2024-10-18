<?php
require_once './app/models/peliculas.model.php';
require_once './app/views/pelicula.view.php';

class peliculaController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new peliculaModel();
        $this->view = new peliculaView();
        
    }
    public function homeController(){
        $this->view->viewHome();
    }
    public function errorController(){
        $this->view->showError();
    }
    public function showPeliculas(){
        $peliculas = $this->model->getPeliculas();
        $generos = $this->model->getGeneros();
        $this->view->showPeliculas($peliculas, $generos);
    }
}