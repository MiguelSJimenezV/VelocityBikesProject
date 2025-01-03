<?php 

class Conexion {

    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "velocitybikes";
    
    private const DB_DSN = "mysql:host=".self::DB_SERVER.";dbname=".self::DB_NAME.";charset=utf8mb4"; 
    
    protected PDO $db;

    public function __construct(){
        try {
            $this->db = new PDO(
                self::DB_DSN, 
                self::DB_USER, 
                self::DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanzar excepciones en errores
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Modo de fetch predeterminado
                    PDO::ATTR_EMULATE_PREPARES => false, // Deshabilitar emulación de consultas preparadas
                ]
            );
            // echo "Conexión exitosa"; // Eliminar cualquier salida
        } catch (PDOException $e) {
            // No exponer detalles específicos del error en producción
            // echo "No se pudo conectar a la base de datos."; // Eliminar cualquier salida
            // Registrar el error para revisión del desarrollador
            error_log($e->getMessage());
        }
    }

    public function getConexion() : PDO {
        return $this->db;
    }
}
?>
