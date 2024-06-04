<?php

$correo = isset($_SESSION["correo"]) ? $_SESSION["correo"] : '';
$accesoriosHref = (strpos($correo, '@refugioadmin.es') !== false) ? 'comparadorAdmin.php' : 'comparadorUsuario.php';
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
        <div class="imagen-logo">
            <img src="imgs/pixelcut-export_3.png" alt="">
        </div>
        <ul>
            <li><a class="encuentro" href="index.php">¿Quíenes Somos?</a></li>
            <li><a href="#">Animales</a></li>
            <li><a href="<?php echo $accesoriosHref; ?>">Accesorios</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="login.php">Cuenta</a></li>
        </ul>
    </nav>
</body>
</html>
