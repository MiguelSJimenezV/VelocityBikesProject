<?php
// Iniciar la sesión
session_start();

// Incrementar el contador
if (isset($_SESSION['contador'])) {
    $_SESSION['contador']++;
    echo $_SESSION['contador'];
} else {
    echo 0;
}
?>
