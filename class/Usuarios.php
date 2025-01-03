<?php
require_once 'Conexion.php';

class Usuarios {
    public $id;
    public $username;
    public $password_user;
    public $direccion;
    public $email;
    public $telefono;
    public $rol;
    
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->getConexion();
    }

    public function iniciarSesion($user, $pass){
        $stmt = $this->db->prepare("SELECT id, username, password_user, direccion, email, telefono, rol FROM usuarios WHERE username = ?");
        $stmt->execute([$user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 

        if($result){
            if(md5($pass) == $result['password_user']){
                $this->id = $result['id'];
                $this->username = $result['username'];
                $this->direccion = $result['direccion'];
                $this->email = $result['email'];
                $this->telefono = $result['telefono'];
                $this->rol = $result['rol'];

                return true; // credenciales son válidas
            } else {
                return false; // credenciales no válidas
            }
        } else {
            return false; // usuario no existe
        }
    }

    public function traer_usuarios(): array
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "SELECT * FROM usuarios";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      $usuarios = [];

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $usuario = new self();
         $usuario->id = $row['id'];  
         $usuario->username = $row['username'];
         $usuario->direccion = $row['direccion'];
         $usuario->email = $row['email'];
         $usuario->telefono = $row['telefono'];
         $usuario->rol = $row['rol'];

         $usuarios[] = $usuario;
      }

      return $usuarios;
   }
}
