<?php 
require 'class/Usuarios.php';

header('Content-Type: application/json');

// Crear una instancia de la clase Usuarios
$usuarios = new Usuarios();

// Obtener los datos del formulario de manera segura
$user = isset($_POST['username']) ? $_POST['username'] : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

// Validar que se hayan recibido los datos necesarios
if (empty($user) || empty($pass)) {
    echo json_encode(['success' => false, 'message' => 'Usuario o contraseña no proporcionados']);
    exit();
}

// Intentar iniciar sesión
if ($usuarios->iniciarSesion($user, $pass)) {
    session_start();
    // Asignar las variables de sesión
    $_SESSION['id'] = $usuarios->id;
    $_SESSION['username'] = $usuarios->username;
    $_SESSION['direccion'] = $usuarios->direccion;
    $_SESSION['email'] = $usuarios->email;
    $_SESSION['telefono'] = $usuarios->telefono;
    $_SESSION['rol'] = $usuarios->rol;

    // Determinar la URL de redirección basada en el rol del usuario
    $redirectUrl = $usuarios->rol == 1 ? 'admin.php' : 'index.php';

    echo json_encode(['success' => true, 'redirect' => $redirectUrl]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no válido']);
}
?>
