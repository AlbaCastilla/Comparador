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

// Verificar la existencia de palabraImgDonar en la sesión
if (!isset($_SESSION["palabraImgDonar"])) {
    $_SESSION['donation_message'] = "Error: No se encontró palabraImgDonar en la sesión.";
    header("Location: donar.php");
    exit;
}

// Datos de conexión a la base de datos
$servername = "localhost:3366";
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
$palabraImg = $_SESSION["palabraImgDonar"];
$name = $_SESSION['nombre'];
$email = $_SESSION['correo'];
$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$expDate = $_POST['expDate'];
$cvv = $_POST['cvv'];

// Extraer los últimos 4 dígitos de la tarjeta
$lastFourDigits = substr($cardNumber, -4);

// Verificar que los últimos 4 dígitos consistan solo en números
if (!preg_match('/^\d{4}$/', $lastFourDigits)) {
    $_SESSION['donation_message'] = "Error: Número de tarjeta inválido.";
    header("Location: donar.php");
    exit;
}

// Generar número de pedido único
$orderNumber = uniqid('ORDER_');

// Insertar datos en la base de datos
$sql = "INSERT INTO donaciones (nombre, email, cardName, lastFourDigits, expDate, orderNumber, palabraImgDonar) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssss', $name, $email, $cardName, $lastFourDigits, $expDate, $orderNumber, $palabraImg);

if ($stmt->execute()) {
    // Guardar el número de pedido en la sesión
    $_SESSION['order_number'] = $orderNumber;
    $_SESSION['donation_message'] = "Donación completada con éxito. Muchísimas gracias :)";
} else {
    $_SESSION['donation_message'] = "Hubo un error al procesar tu donación. Por favor, intenta nuevamente.";
}

$stmt->close();
$conn->close();

header("Location: donar.php");
exit;
?>
