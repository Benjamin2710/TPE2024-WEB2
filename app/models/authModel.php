<?php 
require_once 'model.php';
class authModel extends Model{
    

    public function getEmail($email_user){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario=?');
        $query->execute([$email_user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    
}

