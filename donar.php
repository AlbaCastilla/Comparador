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

// Obtener datos de usuario de la sesión
$email = $_SESSION['email'];
$name = $_SESSION['nombre'];

// Verificar el estado de la donación
$donationStatus = isset($_SESSION['donation_status']) ? $_SESSION['donation_status'] : '';
$orderNumber = isset($_SESSION['order_number']) ? $_SESSION['order_number'] : '';

// Limpiar estado de la donación
unset($_SESSION['donation_status']);
unset($_SESSION['order_number']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Donar</title>
    <link rel="stylesheet" href="css/donar.css">
</head>
<?php
    include "includes/navbar.php";
?>
<body class="body">
    <div class="container div">
        <h2 class="heading h2">Formulario de Compra</h2>
        <?php if ($donationStatus === 'success'): ?>
            <div class="confirmation-message">
                Donación completada con éxito. Número de pedido: <?php echo htmlspecialchars($orderNumber); ?>
            </div>
        <?php elseif ($donationStatus === 'error'): ?>
            <div class="error-message">
                Hubo un error al procesar tu donación. Por favor, intenta nuevamente.
            </div>
        <?php endif; ?>
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
</body>
<?php
    include "includes/footer.php";
?>
</html>
