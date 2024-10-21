<?php
require_once __DIR__ . '/../models/peliculas.model.php';
require_once __DIR__ . '/../views/peliculas.view.php';
require_once __DIR__ . '/../models/generos.model.php';


class PeliculasController {
    private $model;
    private $view;
    private $generosModel;
    private $res;

    public function __construct($res = null) {
        $this->model = new PeliculasModel();
        $this->generosModel = new GenerosModel();
        $this->view = new PeliculasView($res);
        $this->res = $res;
    }

    private function moveImage(){
        $newFileName = uniqid("", true) . "." . strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $filePath =$_SERVER['DOCUMENT_ROOT']."/TPE/TPE2024-WEB2/frontend/images/" . $newFileName;
        move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
        return $newFileName;
    }

    public function showPeliculas($nombreGenero = null) {
        $generos = $this->generosModel->getNombresIds();
        if($nombreGenero != null){
            $generosNombres = array_column($generos, 'nombre');
            if(!in_array($nombreGenero, $generosNombres)){
                return $this->view->showError('Género no encontrado');
            }else{
                $idGenero = null;
                    foreach ($generos as $genero) {
                        if ($genero->nombre === $nombreGenero) {
                            $idGenero = $genero->id;
                            break;
                        }
                    }
                $peliculas = $this->model->getPeliculasByGenero($idGenero);
            }
        }else{
            $peliculas = $this->model->getPeliculas();
        }
        return $this->view->showPeliculas($peliculas, $generos);
    }

    public function showPelicula($id) {
        if($this->peliculaExists($id)){
            if($this->res->user && $this->res->user->role == 'admin'){
                $_SESSION['ultima_pelicula_mostrada'] = $id;
            }
            $pelicula = $this->model->getPelicula($id);
            $generos = $this->generosModel->getNombresIds();
            return $this->view->showPelicula($pelicula, $generos);
        }else{
            return $this->view->showError('Pelicula no encontrada');
        }
        
    }

    public function showFormAltaPelicula() {
        $generos = $this->generosModel->getNombresIds();
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
        $id = null;
        $filePath = null;
        
        if($_FILES['image']['type'] == "image/jpg" || 
        $_FILES['image']['type'] == "image/jpeg" || 
        $_FILES['image']['type'] == "image/png"){ 
            $filePath = $this->moveImage();
            $id = $this->model->insertarPelicula($titulo, $descripcion, $director, $anio, $id_genero, $filePath);
        }else{
            $id = $this->model->insertarPelicula($titulo, $descripcion, $director, $anio, $id_genero);
        }
        header('Location: ' . BASE_URL . 'pelicula/' . $id); //se redirige a la vista de la película recién insertada
    }

    public function editarPelicula() {
        if (!isset($_SESSION['ultima_pelicula_mostrada']) || empty($_SESSION['ultima_pelicula_mostrada'])) {
            return $this->view->showError('ERROR: No se puede editar la película');
        }
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
        $id = $_SESSION['ultima_pelicula_mostrada'];

        if($_FILES['image']['type'] == "image/jpg" || 
        $_FILES['image']['type'] == "image/jpeg" || 
        $_FILES['image']['type'] == "image/png"){
            $filePath = $this->moveImage();
            $this->model->editarPelicula($id, $titulo, $descripcion, $director, $anio, $id_genero, $filePath);
        }else{
            $this->model->editarPelicula($id, $titulo, $descripcion, $director, $anio, $id_genero);
        }

        $this->model->editarPelicula($id, $titulo, $descripcion, $director, $anio, $id_genero);
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

    private function generoExists($nombre) { //que lo haga generos model!!!
        return $this->generosModel->generoExists($nombre);
    }

    private function peliculaExists($id) {
        return $this->model->peliculaExists($id);
    }
    //prueba
    // Mostrar todos los géneros
    public function showGeneros(){
        $generos = $this->generosModel->getGeneros();
        
        if ($generos) {
            $this->view->showGeneros($generos);
        } else {
            $this->view->showError("No se encontraron géneros.");
        }
        
        test_var($generos);
    }

    public function showGenero($id){
        if($this->generoExists($id)){
            $genero = $this->generosModel->getGenero($id);
            $peliculas = $this->model->getPeliculasByGenero($id);
            $this->view->showGenero($genero, $peliculas);
        }else{
            $this->view->showError("Género no encontrado");
        }
    }

    public function showError($error) {
        return $this->view->showError($error);
    }
}
