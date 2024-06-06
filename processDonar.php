<?php
// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comparadorbd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario y de la sesión
$name = $_SESSION['nombre'];
$email = $_SESSION['email'];
$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$expDate = $_POST['expDate'];
$cvv = $_POST['cvv'];

// Extraer los últimos 4 dígitos de la tarjeta
$lastFourDigits = substr($cardNumber, -4);

// Verificar que los últimos 4 dígitos consistan solo en números
if (!preg_match('/^\d{4}$/', $lastFourDigits)) {
    // Si no son solo números, puedes manejar el error aquí
    $_SESSION['donation_status'] = "error";
    header("location: donar.php");
    exit; // Terminar el script o manejar el error de otra manera
}

// Generar número de pedido único
$orderNumber = uniqid('ORDER_');

// Insertar datos en la base de datos
$sql = "INSERT INTO donaciones (nombre, email, cardName, lastFourDigits, expDate, orderNumber) VALUES ('$name', '$email', '$cardName', '$lastFourDigits', '$expDate', '$orderNumber')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['donation_status'] = "success";
    $_SESSION['order_number'] = $orderNumber;
} else {
    $_SESSION['donation_status'] = "error";
}

$conn->close();
header("location: donar.php");
exit;
?>
