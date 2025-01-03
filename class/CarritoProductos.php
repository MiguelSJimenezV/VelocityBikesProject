<?php

class CarritoProductos{
    public $id;


    //Metodos //////////////////

    public function __construct(){
       $this->db = (new Conexion())->getConexion();
    }

    public function iniciarSesion($user, $pass){
        
      $stmt = $this->$db->prepare("SELECT id, username, password, direccion, email, telefono FROM usuarios WHERE username = ?");
      $stmt->execute([$user]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if($result){
         if(md5($pass) == $result['password']){
            $this->id = $result['id'];
            return true;
         }else{
            return false;
         }
      }else{
         return false;
      }
      
     }
}