<?php
require_once __DIR__ . '/config.php';

Class Model{
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function deploy(){
        //completar deploy al final, asi tener la sql final
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            
            $this->db->query($sql);
        }
    }
}