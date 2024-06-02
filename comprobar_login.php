<?php
session_start();

if (isset($_SESSION['usuario'])) {
    // Si la sesión está iniciada, redirige a comentarios.php
    header("Location: comentarios.php");
    exit();
} else {
    // Si la sesión no está iniciada, redirige a login.php
    header("Location: login.php");
    exit();
}
?>
