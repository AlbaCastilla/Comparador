<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['correo'])) {
    // Redirigir si el correo no está definido en la sesión
    header("Location: login.php");
    exit();
}

$correo = $_SESSION['correo'];
$error_message = ""; // Inicializar la variable de mensaje de error

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contrasena = $_POST['contrasena'];

    // Connect to the database
    $conex = new mysqli('localhost', 'root', '', 'comparadorbd');

    // Check for connection errors
    if ($conex->connect_error) {
        die("Error de conexión: " . $conex->connect_error);
    }

    // Escape special characters to prevent SQL injection
    $contrasena = $conex->real_escape_string($contrasena);

    // Store the email in session
    $_SESSION['contrasena'] = $contrasena;

    // Query to check if the email and password are correct
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $result = $conex->query($sql);

    if ($result->num_rows > 0) {
        // La contraseña es correcta
        
        // Obtener el nombre del usuario
        $sql2 = "SELECT nombre FROM usuarios WHERE correo = '$correo'";
        $result2 = mysqli_query($conex, $sql2);

        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombreUsuario = $row['nombre'];

            // Guarda el nombre de usuario en la sesión
            $_SESSION['nombre'] = $nombreUsuario;
            }
        }
        
        /*// Verifica si la consulta fue exitosa y tiene resultados
        if ($result2 && $result2->num_rows > 0) {
            // Extrae el nombre de usuario de la fila obtenida
            $row = $result2->fetch_assoc();
            $nombreUsuario = $row['nombre'];

            // Guarda el nombre de usuario en la sesión
            $_SESSION['nombre'] = $nombreUsuario;

            // Redirige al usuario a la página deseada
            header("Location: index.php");
            exit();
        } else {
            // Error en la consulta SQL o no se encontró el usuario
            echo "Error al obtener el nombre de usuario: " . $conex->error;
        }*/
        header("Location: index.php");
    } else {
        // La contraseña es incorrecta
        $error_message = '<div class="alert">La contraseña es incorrecta.</div>';
    }
    // Close the database connection
    $conex->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body class="body">
<?php include "includes/navbar.php"; ?>
<div class="container">
    <h2 class="titulo">Inicio de Sesión</h2>
    <div class="form-group">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label class="label">Contraseña: <input type="password" name="contrasena" class="input" placeholder="Introduce tu contraseña" required></label>
            <button type="submit" name="submit" class="button">Continuar</button>
        </form>
    </div>
    <?php
    // Display the error message if the email is not registered
    if (!empty($error_message)) {
        echo $error_message;
    }
    ?>
    <div class="separator">
        <span class="line"></span>
        <span class="text">¿Has olvidado tu contraseña?</span>
        <span class="line"></span>
    </div>
    <div class="contenedorBtnRegistrarse">
        <a href="cambioContrasena.php" class="btnRegistrarse">Cambiar contraseña</a>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
