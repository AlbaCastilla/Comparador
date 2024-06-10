

<?php
// Definir una variable para almacenar mensajes de error
$error_msg = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Hash de la contraseña para mayor seguridad
    //$hashed_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    // Conectar a la base de datos (modifica los parámetros según tu configuración)
    $conex = new mysqli('localhost:3306', 'root', '', 'comparadorbd');

    // Verificar si hay errores de conexión
    if ($conex->connect_error) {
        die("Error de conexión: " . $conex->connect_error);
    }

    // Verificar si el correo ya está registrado
    $sql_check_correo = "SELECT correo FROM usuarios WHERE correo = '$correo'";
    $result_check_correo = $conex->query($sql_check_correo);

    if ($result_check_correo->num_rows > 0) {
        $error_msg = "El correo electrónico ya está registrado. Por favor, utilice otro correo.";
    } else {
        // Preparar la consulta SQL para insertar los datos en la tabla usuarios
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";

        // Ejecutar la consulta
        if ($conex->query($sql) === TRUE) {
            header("Location: login.php");
        } else {
            $error_msg = "Error al registrar el usuario: " . $conex->error.". Si sigues teniendo problemas contacta alguno de nuestros empleados 635-23-44-12 o refugioanimales@contacto.es";
        }
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
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/registro.css?v=<?php echo time(); ?>">
    <script>document.addEventListener("DOMContentLoaded", function() {
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

});</script>
</head>
<body class="body">
<?php include "includes/navbar.php"; ?>
<div class="container">
    <h2 class="titulo">Registro de Usuario</h2>
    <?php if (!empty($error_msg)) : ?>
        <div class="error-msg"><?php echo $error_msg; ?></div>
    <?php endif; ?>
    <div class="form-group">
        <form method="POST" action="">
        <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre" required>
            
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" class="input" placeholder="Correo electrónico" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" class="input" placeholder="Contraseña" required>
            
            <button type="submit" name="submit" class="button">Registrarse</button>

        </form>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
