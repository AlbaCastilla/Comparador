<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Datos de conexión a la base de datos
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "comparadorbd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la palabraImg de la solicitud GET
if (isset($_GET['palabraImg'])) {
    $palabraImg = $_GET['palabraImg'];

    // Guardar la palabraImg en la sesión
    $_SESSION["palabraImgDonar"] = $palabraImg;

    // Confirmar que la sesión se ha guardado
    if (isset($_SESSION["palabraImgDonar"])) {
        echo "PalabraImg guardada en sesión: " . $_SESSION["palabraImgDonar"];
    } else {
        echo "Error: No se pudo guardar la palabraImg en la sesión.";
    }

    // Redirigir a donar.php
    header("Location: donar.php");
    exit;
} else {
    echo "Error: No se proporcionó palabraImg.";
}

// Cerrar conexión
$conn->close();
?>

