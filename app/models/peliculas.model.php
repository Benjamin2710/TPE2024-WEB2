<?php
require_once 'model.php';
class peliculaModel extends Model {
    
    public function getPeliculas() {
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();

        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);

        return $peliculas;
    }
    public function getGeneros(){
        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();

        $generos = $query->fetchAll(PDO::FETCH_OBJ);

        return $generos;
    }
    public function getPeliculasByGenero($id) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_genero = ?');
        $query->execute([$id]);

        $peliculasPorGenero = $query->fetchAll(PDO::FETCH_OBJ);

        return $peliculasPorGenero;
    }



}