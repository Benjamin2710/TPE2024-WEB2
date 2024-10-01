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
}