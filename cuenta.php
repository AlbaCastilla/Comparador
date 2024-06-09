<!DOCTYPE html>
<html class="html">
<head class="head">
    <meta class="meta" charset="UTF-8">
    <meta class="meta" name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="title">Document</title>
    <link rel="stylesheet" href="css/cuenta.css?v=<?php echo time(); ?>" class="link-css">
    <script class="script" src="https://kit.fontawesome.com/07ca607712.js" crossorigin="anonymous"></script>
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
<?php
// Iniciar la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include "includes/navbar.php";
?>

<div class="div user-info">
    <i class="i fa-solid fa-user"></i>
    <p class="p user-name"> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
    <p class="p user-email"> <?php echo htmlspecialchars($_SESSION['correo']); ?></p>
    <form class="form logout-form" action="logout.php" method="POST">
        <button class="button logout-button" type="submit">Salir de sesión</button>
    </form>
</div>

<div class="recibos-caja div">
<?php
// Conexión a la base de datos
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

// Consulta SQL para obtener los datos de donaciones del usuario logueado
$emailUsuario = $_SESSION['correo'];
$sql = "SELECT * FROM donaciones WHERE email = '$emailUsuario'";
$result = $conn->query($sql);

// Si hay al menos una fila en el resultado
if ($result->num_rows > 0) {
    echo "<h3 class='titulo-recibos h3'>Recibos de Donaciones</h3>";
    echo "<div class='caja-recibos-cuenta'>";
    // Iterar sobre cada fila del resultado
    $contador_recibos = 0;
    while($row = $result->fetch_assoc()) {
        // Mostrar los datos como un recibo
        echo "<div class='recibo div" . ($contador_recibos >= 3 ? " recibos-adicionales" : "") . "'>";
        echo "<p class='fecha p'>" . date("d/m/Y", strtotime($row["reg_date"])) . "</p>"; // Fecha en la esquina izquierda
        echo "<p class='p nombre'><strong>" . htmlspecialchars($row["nombre"]) . "</strong></p>";
        echo "<p class='p email'><strong>" . htmlspecialchars($row["email"]) . "</strong></p>";
        echo "<div class='datos-tarjeta-caja div'>";
        echo "<p class='tarjeta-info p'><strong>Nombre en la Tarjeta: </strong>" . htmlspecialchars($row["cardName"]) . "</p>";
        echo "<p class='tarjeta-info p'><strong>Últimos 4 Dígitos: </strong>" . htmlspecialchars($row["lastFourDigits"]) . "</p>";
        echo "<p class='tarjeta-info p'><strong>Fecha de Expiración: </strong>" . htmlspecialchars($row["expDate"]) . "</p>";
        echo "</div>";
        echo "<p class='p order-number'><strong>" . htmlspecialchars($row["orderNumber"]) . "</strong></p>";
        echo "<p class='hora p'>" . date("H:i", strtotime($row["reg_date"])) . "</p>"; // Hora abajo
        echo "</div>";

        // Incrementar contador de recibos
        $contador_recibos++;
    }
    echo "</div>";

    // Si hay más de 3 recibos, mostrar el botón "Ver más"
    if ($contador_recibos > 3) {
        echo "<button id='verMasDonaciones' class='ver-mas-button' onclick='showMoreDonaciones()'><i class='fa-solid fa-angle-down'></i></button>";
    }
} else {
    echo "<p class='p no-donaciones'>No se encontraron donaciones para este usuario.</p>";
}
?>
<div class="comparaciones-guardadas">
<h3>Comparaciones Guardadas</h3>
<div class="comparaciones-container">
    <?php
    // Conexión a la base de datos
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

    // Consulta SQL para obtener las comparaciones guardadas del usuario logueado
    $correoUsuario = $_SESSION['correo'];
    $sql = "SELECT card1palabraImg, card2palabraImg FROM guardarComparaciones WHERE usuario = '$correoUsuario'";
    $result = $conn->query($sql);

    // Si hay al menos una fila en el resultado
    if ($result->num_rows > 0) {
        // Iterar sobre cada fila del resultado
        while($row = $result->fetch_assoc()) {
            // Mostrar las comparaciones guardadas

            echo "<div class='comparacion'><a href='tarjetas-comparar-grandes.php?card1palabraImg=" . urlencode($row['card1palabraImg']) . "&card2palabraImg=" . urlencode($row['card2palabraImg']) . "'>" . $row['card1palabraImg'] . " vs ". $row['card2palabraImg'] ."</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron comparaciones guardadas para este usuario.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
    
</div>
</div>
</div>
<div class="footer">
<?php
include "includes/footer.php";
?>
</div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Selecciona el botón "Ver más"
    var verMasButton = document.getElementById('verMasDonaciones');
    // Selecciona el icono dentro del botón
    var iconoFlecha = verMasButton.querySelector('i');
    
    // Escucha el evento de clic en el botón "Ver más"
    verMasButton.addEventListener('click', function() {
        // Selecciona todos los elementos con la clase "recibos-adicionales"
        var hiddenDonaciones = document.querySelectorAll('.recibos-adicionales');
        // Itera sobre los elementos ocultos y muestra solo los primeros tres
        var contador = 0;
        hiddenDonaciones.forEach(function(donacion) {
            if (contador < 3) {
                donacion.classList.remove('recibos-adicionales');
                contador++;
            } else {
                donacion.classList.add('recibos-adicionales');
            }
        });
        
        // Si ya no quedan elementos ocultos para mostrar
        if (document.querySelectorAll('.recibos-adicionales').length === 0) {
            // Cambia la clase del icono de la flecha hacia arriba
            iconoFlecha.classList.remove('fa-angle-down');
            iconoFlecha.classList.add('fa-angle-up');
            
            // Escucha el evento de clic en el botón "Ver más" para recargar la página
            verMasButton.addEventListener('click', function() {
                location.reload();
            });
        }
    });
});

    document.getElementById('verMasDonaciones').addEventListener('click', function() {
        console.log("hello")
    showMoreDonaciones();
});
        
        function showMoreDonaciones() {
    let hiddenDonaciones = document.querySelectorAll('recibos-adicionales');
    console.log(hiddenDonaciones);
    hiddenDonaciones.forEach(function(donacion) {
        console.log("hola")
        donacion.classList.remove('recibos-adicionales');
    });
    
}
    
    </script>
    
</html>
