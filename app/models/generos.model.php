<?php
require_once __DIR__ . '/config.php';

class GenerosModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_peliculas;charset=utf8', 'root', '');
    }

    public function getGeneros() {
        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $generos;
    }
}