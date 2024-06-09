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
    echo "Error: No se encontró palabraImgDonar en la sesión.";
    exit;
}

// Obtener datos de usuario de la sesión
$email = $_SESSION['correo'];
$name = $_SESSION['nombre'];

// Obtener el número de pedido
$orderNumber = isset($_SESSION['order_number']) ? $_SESSION['order_number'] : '';

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

// Recuperar detalles del pedido
$orderDetails = null;
if ($orderNumber) {
    $sql = "SELECT * FROM donaciones WHERE orderNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $orderNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $orderDetails = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Donar</title>
    <link rel="stylesheet" href="css/donar.css?v=<?php echo time(); ?>">
</head>
<body class="body">
    <?php include "includes/navbar.php"; ?>
    <div class="container div">
        <h2 class="h2">Formulario de Compra</h2>

        <form id="paymentForm" class="form" action="processDonar.php" method="POST">
    <label for="cardName" class="label">Nombre en la Tarjeta</label>
    <input type="text" id="cardName" class="input" name="cardName" placeholder="Ej. Juan Pérez" required pattern="[A-Za-z\s]+" title="Solo letras y espacios permitidos">

    <label for="cardNumber" class="label">Número de Tarjeta</label>
    <input type="text" id="cardNumber" class="input" name="cardNumber" placeholder="0000 0000 0000 0000" required pattern="\d{4}\s?\d{4}\s?\d{4}\s?\d{4}" maxlength="19" title="Debe tener 16 dígitos numéricos">

    <label for="expDate" class="label">Fecha de Expiración (MM/AA)</label>
    <input type="text" id="expDate" class="input" name="expDate" placeholder="MM/AA" required pattern="(0[1-9]|1[0-2])\/\d{2}" maxlength="5" title="Debe estar en formato MM/AA">

    <label for="cvv" class="label">CVV</label>
    <input type="text" id="cvv" class="input" name="cvv" placeholder="000" required pattern="\d{3}" maxlength="3" title="Debe tener 3 dígitos numéricos">

    <button type="submit" class="button button-comparar">Finalizar donación</button>
</form>


        <!-- Mostrar detalles del pedido -->
    </div>
    <div class="respuesta-donacion hidden">
    


                <?php if ($_SESSION['donation_message'] === "Donación completada con éxito. Muchísimas gracias :)"): ?>
                    <?php echo htmlspecialchars($_SESSION['donation_message']); ?>
            <div class="donation-details">
                <h3>Detalles de la Donación</h3>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($orderDetails['nombre']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($orderDetails['email']); ?></p>
                <p><strong>Nombre en la Tarjeta:</strong> <?php echo htmlspecialchars($orderDetails['cardName']); ?></p>
                <p><strong>Últimos 4 Dígitos:</strong> <?php echo htmlspecialchars($orderDetails['lastFourDigits']); ?></p>
                <p><strong>Fecha de Expiración:</strong> <?php echo htmlspecialchars($orderDetails['expDate']); ?></p>
                <p><strong>Número de Pedido:</strong> <?php echo htmlspecialchars($orderDetails['orderNumber']); ?></p>
                <a href="comparadorUsuario.php"><button class="button">Salir</button></a>
            </div>
        <?php else: ?>
            <div class="respuesta-donacion">
                <div class="donation-message error">
                    <?php echo htmlspecialchars($_SESSION['donation_message']); ?>
                </div>
                <button onclick="ocultarMensaje()" class="button">Volver a intentar</button>
            </div>
        <?php endif; ?>


        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
    var buttonComparar = document.querySelector('.button-comparar');
    var respuestaDonacion = document.querySelector('.respuesta-donacion');

    buttonComparar.addEventListener('click', function() {
        respuestaDonacion.classList.remove('hidden');
    });
});
function ocultarMensaje() {
        document.querySelector('.respuesta-donacion').style.display = 'none';
    }
        </script>
    <?php include "includes/footer.php"; ?>
</body>
<!--<div class="chart-container">
        <div class="chart1-container">
            <h3 class="h3">Media de evaluación integral de los productos</h3>
            <canvas id="durabilityChart" class="canvas"></canvas>
        </div>
        <div>
            <h3 class="h3">Porcentaje de comparación entre productos, evaluación general</h3>
            <canvas id="reviewsChart" class="canvas"></canvas>
        </div>
    </div>-->
</html>

