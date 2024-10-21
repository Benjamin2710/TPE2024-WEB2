<?php
require_once __DIR__ . '/model.php';

class GenerosModel extends Model {

    public function getGeneros() {
        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $generos;
    }

    public function getGenero($id) {
        $query = $this->db->prepare('SELECT * FROM generos WHERE id = ?');
        $query->execute([$id]);
        $genero = $query->fetch(PDO::FETCH_OBJ); 
    
        return $genero;
    }

    public function getNombresIds() {
        $query = $this->db->prepare('SELECT id, nombre FROM generos');
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $generos;
    }

    public function insertarGenero($nombre, $descripcion, $clasificacion_por_edad) {
        $query = $this->db->prepare('INSERT INTO generos(nombre, descripcion, clasificacion_por_edad) VALUES(?,?,?)');
        $query->execute([$nombre, $descripcion, $clasificacion_por_edad]);
    }

    public function eliminarGenero($id) {
        $query = $this->db->prepare('DELETE FROM generos WHERE id = ?');
        $query->execute([$id]);
    }

    public function editarGenero($id, $nombre, $descripcion, $clasificacion_por_edad) {
        $query = $this->db->prepare('UPDATE generos SET nombre = ?, descripcion = ?, clasificacion_por_edad = ? WHERE id = ?');
        $query->execute([$nombre, $descripcion, $clasificacion_por_edad, $id]);
    }

    public function generoExists($nombre) {
        $query = $this->db->prepare('SELECT COUNT(*) FROM generos WHERE nombre = ?');
        $query->execute([$nombre]);
        return $query->fetchColumn() > 0;
    }

    public function getIdByNombre($nombre) {
        $query = $this->db->prepare('SELECT id FROM generos WHERE nombre = ?');
        $query->execute([$nombre]);
        return $query->fetch(PDO::FETCH_OBJ)->id;
    }
}