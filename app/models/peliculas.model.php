<?php
class PeliculasModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_peliculas;charset=utf8', 'root', '');
    }

    public function getPeliculas() {
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $peliculas;
    }

    public function getPelicula($id) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id=?');
        $query->execute([$id]);
        $pelicula = $query->fetch(PDO::FETCH_OBJ); 
    
        return $pelicula;
    }

    public function insertarPelicula($titulo, $descripcion, $director, $id_genero) {
        $query = $this->db->prepare('INSERT INTO peliculas(titulo, descripcion, director, id_genero) VALUES(?,?,?,?)');
        $query->execute([$titulo, $descripcion, $director, $id_genero]);
    }

    public function borrarPelicula($id) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id=?');
        $query->execute([$id]);
    }

    public function editarPelicula($id, $titulo, $descripcion, $director, $id_genero) {
        $query = $this->db->prepare('UPDATE peliculas SET titulo=?, descripcion=?, director=?, id_genero=? WHERE id=?');
        $query->execute([$titulo, $descripcion, $director, $id_genero, $id]);
    }
}