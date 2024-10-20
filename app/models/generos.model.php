<?php
require_once __DIR__ . '/model.php';

class GenerosModel extends Model {

    public function getGeneros() {
        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $generos;
    }

    public function getNombresIds() {
        $query = $this->db->prepare('SELECT id, nombre FROM generos');
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $generos;
    }

    public function generoExists($id) {
        $query = $this->db->prepare('SELECT COUNT(*) FROM generos WHERE id = ?');
        $query->execute([$id]);
        return $query->fetchColumn() > 0;
    }
}