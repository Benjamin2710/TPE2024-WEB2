<?php 
require_once './app/models/adminModel.php';
require_once './app/views/pelicula.view.php';
require_once './app/helper/authHelper.php';
class adminController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new adminModel();
        $this->view = new peliculaView(); //coordinacion modelo vista
    }
    
    public function showAdministrar(){
        AuthHelper::verify();
        $peliculas = $this->model->getPeliculas();
        $generos = $this->model->getGeneros();
        $this->view->viewAdministrar($peliculas, $generos);
    }
    public function deletePelicula(){
        AuthHelper::verify();
        $id = $_POST['id'];
        if(empty($id)){
            $this->view->showError("Elija un id");
            return;
        }
        $this->model->removePelicula($id);
        header('Location: ' . 'administrar');
    }
    public function addPelicula(){
        AuthHelper::verify();
        $titulo_pelicula = $_POST['titulo_pelicula'];
        $director = $_POST['director'];
        $anio = $_POST ['año'];
        $descripcion = $_POST ['descripcion'];
        $id_genero = $_POST['id_genero'];
        if(empty($titulo_pelicula) || empty($director) || empty($anio) || empty($descripcion) || empty($id_genero)){
            $this->view->showError("Complete los campos solicitados");
            return;
        }
        $id = $this->model->insertPelicula($titulo_pelicula, $director, $anio, $descripcion, $id_genero);
        if($id){
            header ('Location: ' . 'administrar');
        }
        else{
            $this->view->showError("404 Error");
        }
    }

    // hasta aca chequeado1
    public function updatePelicula() {
        AuthHelper::verify();
        $peliculaname = $_POST['nombre_pelicula'];
        $director = $_POST['director'];
        $anio = $_POST['anio'];
        $descripcion = $_POST['descripcion'];
        $generoId = $_POST['id_genero'];
        $id = $_POST['id'];
    
        
        if (empty($peliculaname) || empty($director) || empty($anio) || empty($descripcion) || empty($generoId) || empty($id)) {
            $this->view->showError("Complete todos los campos");
            return;
        }
    
        $result = $this->model->updatePelicula($peliculaname, $director, $anio, $descripcion, $generoId, $id);
    
        // Verificar si la actualización fue exitosa
        if ($result) {
            header('Location: ' . 'administrar');
        } else {
            $this->view->showError("Error al actualizar la película");
        }
    }
    
    public function addGenero(){
        AuthHelper::verify();
        $genero = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $calificacion_por_edad = $_POST['calificacion_por_edad'];
        if (empty($genero) || empty($descripcion) || empty($calificacion_por_edad)) {
            $this->view->showError("Complete los todos los campos");
            return;
        }
        $this->model->insertGenero($genero, $descripcion, $calificacion_por_edad);
        header('Location: ' . 'administrar');
    }

    // actualizo genero-
    public function updateGenero() {
        AuthHelper::verify();
        $generoName = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $calificacion_por_edad = $_POST['calificacion_por_edad'];
        $id = $_POST['id_genero'];
    
        // Verificación de que todos los campos estén completos
        if (empty($generoName) || empty($descripcion) || empty($calificacion_por_edad) || empty($id)) {
            $this->view->showError("Complete todos los campos");
            return;
        }
    
        // Actualizar el género en el modelo
        $result = $this->model->updateGenero($generoName, $descripcion, $calificacion_por_edad, $id);
    
        // Verificar si la actualización fue exitosa
        if ($result) {
            header('Location: ' . 'administrar');
        } else {
            $this->view->showError("Error al actualizar el género");
        }
    }
    public function removeGenero(){
        AuthHelper::verify();
        $generoId = $_POST['id_genero'];
        if (empty($generoId)) {
            $this->view->showError("Complete los campos");
            return;
        }
        $this->model->deleteGenero($generoId);
        header('Location: ' . 'administrar');
    }
    
}