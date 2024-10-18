<?php
require_once 'model.php';
class adminModel extends Model{
    
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
    public function removePelicula($id){
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id=?');
        $query->execute([$id]);
    }
    public function insertPelicula($titulo, $director, $anio, $descripcion, $id_genero) {
        $query = $this->db->prepare('INSERT INTO peliculas (titulo, director, anio, descripcion, id_genero) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$titulo, $director, $anio, $descripcion, $id_genero]);
        return $this->db->lastInsertId();
    }
    

    //hay que revisar 
    public function updatePelicula($peliculaname, $director, $anio, $descripcion, $generoId, $id){
        $query=$this->db->prepare('UPDATE `peliculas` SET `titulo` = ?, `director` = ?, `anio` = ?, `descripcion` = ?, `id_genero` = ? WHERE `peliculas`.`id` = ?;');
        $query->execute([$peliculaname, $director, $anio, $descripcion, $generoId, $id]);
    }
    public function insertGenero($genero, $descripcion, $calificacion_por_edad) {
        $query = $this->db->prepare('INSERT INTO generos (nombre, descripcion, calificacion_por_edad) VALUES (?, ?, ?)');
        $query->execute([$genero, $descripcion, $calificacion_por_edad]);
    
        return $this->db->lastInsertId();
    }
    public function updateGenero($generoName, $descripcion, $calificacion_por_edad, $id) {
        $query = $this->db->prepare('UPDATE generos SET nombre = ?, descripcion = ?, calificacion_por_edad = ? WHERE id_genero = ?');
        return $query->execute([$generoName, $descripcion, $calificacion_por_edad, $id]);
    }
    public function deleteGenero($generoId){
        $query = $this->db-> prepare('DELETE FROM generos WHERE id_genero=?');
        $query-> execute([$generoId]);
    }
    






}