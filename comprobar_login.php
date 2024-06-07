<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['correo'])) {
    // Si la sesión está iniciada, redirige a comentarios.php
    header("Location: reviews2original.php");
    exit();
} else {
    // Si la sesión no está iniciada, redirige a login.php
    header("Location: login.php");
    exit();
}
?>
