<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si la sesión está activa
if (!isset($_SESSION['correo'])) {
    // Redirigir si la sesión no está activa
    header("Location: login.php");
    exit();
}

// Inicializar variables
$error_message = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger la nueva contraseña del formulario
    $nueva_contrasena = $_POST['nueva_contrasena'];

    // Conectar a la base de datos
    $conex = new mysqli('localhost:3366', 'root', '', 'comparadorbd');

    // Verificar errores de conexión
    if ($conex->connect_error) {
        die("Error de conexión: " . $conex->connect_error);
    }

    // Escapar caracteres especiales para prevenir inyección SQL
    $nueva_contrasena = $conex->real_escape_string($nueva_contrasena);

    // Obtener el correo electrónico de la sesión
    $correo = $_SESSION['correo'];

    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE usuarios SET contrasena = '$nueva_contrasena' WHERE correo = '$correo'";
    if ($conex->query($sql) === TRUE) {
        // Contraseña actualizada exitosamente
        header("Location: login2.php");
    } else {
        // Error al actualizar la contraseña
        $error_message = '<div class="error-msg">Error al actualizar la contraseña: ' . $conex->error . '</div>';
        $error_message .= '<div class="error-msg">Si sigues teniendo problemas, contacta a alguno de nuestros empleados al 635-23-44-12 o a refugioanimales@contacto.es</div>';
    }

    // Cerrar la conexión a la base de datos
    $conex->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Selecciona el elemento body
    var body = document.querySelector("body");

    // Oculta el cursor predeterminado
    body.style.cursor = "none";

    // Crea un nuevo elemento de imagen para el cursor
    var customCursor = new Image();
    customCursor.src = "cursor.png";
    customCursor.style.position = "fixed"; // Asegura que el cursor se muestre correctamente
    customCursor.style.pointerEvents = "none"; // Evita que el cursor personalizado capture eventos de ratón
    customCursor.style.zIndex = "9999"; 
    // Establece el tamaño del cursor personalizado
    var tamañoCursor = 20; // Tamaño del cursor personalizado en píxeles
    customCursor.width = tamañoCursor;
    customCursor.height = tamañoCursor;

    // Escucha eventos de movimiento del ratón
    body.addEventListener("mousemove", function(event) {
        // Actualiza la posición del cursor personalizado
        customCursor.style.left = (event.clientX - tamañoCursor / 2) + "px";
        customCursor.style.top = (event.clientY - tamañoCursor / 2) + "px";
    });

    // Agrega el cursor personalizado al cuerpo del documento
    body.appendChild(customCursor);

});
    </script>
</head>
<body class="body">
<?php include "includes/navbar.php"; ?>
<div class="container">
    <h2 class="titulo">Cambiar Contraseña</h2>
    <div class="form-group">
        <form method="POST" action="">
            <label for="nueva_contrasena" class="label">Nueva Contraseña:</label>
            <input type="password" id="nueva_contrasena" name="nueva_contrasena" class="input" placeholder="Introduce tu nueva contraseña" required>
            <button type="submit" name="submit" class="button">Cambiar Contraseña</button>
        </form>
    </div>
    <?php
    // Mostrar mensaje de error o éxito
    if (!empty($error_message)) {
        echo $error_message;
    }
    ?>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
