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
$email = $_SESSION['email'];
$name = $_SESSION['nombre'];

/*// Verificar el estado de la donación
$donationStatus = isset($_SESSION['donation_status']) ? $_SESSION['donation_status'] : '';
$orderNumber = isset($_SESSION['order_number']) ? $_SESSION['order_number'] : '';
*/


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Donar</title>
    <link rel="stylesheet" href="css/donar.css">
</head>
<body class="body">
    <?php include "includes/navbar.php"; ?>
    <div class="container div">
        <h2 class="h2">Formulario de Compra</h2>
        <form id="paymentForm" class="form" action="processDonar.php" method="POST">
            <label for="cardName" class="label">Nombre en la Tarjeta</label>
            <input type="text" id="cardName" class="input" name="cardName" required>

            <label for="cardNumber" class="label">Número de Tarjeta</label>
            <input type="text" id="cardNumber" class="input" name="cardNumber" required>

            <label for="expDate" class="label">Fecha de Expiración (MM/AA)</label>
            <input type="text" id="expDate" class="input" name="expDate" required>

            <label for="cvv" class="label">CVV</label>
            <input type="text" id="cvv" class="input" name="cvv" required>

            <button type="submit" class="button">Comprar</button>
        </form>
        
    </div>
    <?php include "includes/footer.php"; ?>
</body>

</html>
