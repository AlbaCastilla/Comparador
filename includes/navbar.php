<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$correo = isset($_SESSION["correo"]) ? $_SESSION["correo"] : '';

$animalesHref = empty($correo) ? 'animalesFiltros.php' : (strpos($correo, '@refugioadmin.es') !== false ? 'animalesFiltrosAdmin.php' : 'animalesFiltros.php');
// Si no hay sesión iniciada o no hay correo en la sesión, establece la ruta a comparadorUsuario.php
$accesoriosHref = empty($correo) ? 'comparadorUsuario.php' : (strpos($correo, '@refugioadmin.es') !== false ? 'comparadorAdmin.php' : 'comparadorUsuario.php');
// Verifica si el usuario está registrado
$cuentaHref = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ? 'cuenta.php' : 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Barra Navegacion</title>
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <nav>
        <div class="logo">Refugio de Animales</div>
        
        <input type="checkbox" id="click" class="aceptar">
        <label for="click" class="menu-btn">
            <div class="emoticono-barra fas fa-bars"></div>
        </label>
        
        <ul>
        <!--<li>
            <div class="imagen-logo">
                <img src="imgs/pixelcut-export_3.png" alt="">
            </div>
        </li>-->
            <li><a  href="index.php">¿Quiénes Somos?</a></li>
            <li><a href="<?php echo $animalesHref; ?>">Animales</a></li>
            <li><a href="<?php echo $accesoriosHref; ?>">Accesorios</a></li>
            <li><a href="contacto.php">Tu compañero ideal</a></li>
            <li><a href="<?php echo $cuentaHref; ?>"> <i class="i fa-solid fa-user icon-blanco"></i></a></li>
        </ul>
    </nav>
</body>
</html>
