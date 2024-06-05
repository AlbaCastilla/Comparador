<?php
// Start the session at the beginning
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$error_message = ""; // Inicializar la variable de mensaje de error

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['correo'];

    // Connect to the database
    $conex = new mysqli('localhost', 'root', '', 'comparadorbd');

    // Check for connection errors
    if ($conex->connect_error) {
        die("Error de conexión: " . $conex->connect_error);
    }

    // Escape special characters to prevent SQL injection
    $email = $conex->real_escape_string($email);

    // Store the email in session
    $_SESSION['correo'] = $email;


    // Query to check if the email exists in the database
    $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
    $result = $conex->query($sql);

    if ($result->num_rows > 0) {
        // Email exists in the database, redirect to login2.php
        header("Location: login2.php");
        exit();
    } else {
        // Email does not exist in the database, show error message
        $error_message = "El correo no está registrado.";
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
    <h2 class="h2">Inicio de Sesión</h2>
    <div class="form-group">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label class="label">Correo electrónico: <input type="email" name="correo" class="input" placeholder="Introduce tu correo" required></label>
            <button type="submit" name="submit" class="button">Continuar</button>
        </form>
    </div>
    <?php
    // Display the error message if the email is not registered
    if (!empty($error_message)) {
        echo '<div class="alert">' . $error_message . '</div>';
    }
    ?>
    <div class="separator">
        <span class="line"></span>
        <span class="text">¿Eres nuevo?</span>
        <span class="line"></span>
    </div>
    <div class="contenedorBtnRegistrarse">
        <a href="registrarse.php" class="btnRegistrarse">Registrarse</a>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
