<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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

// Obtener los valores de palabraImg1 y palabraImg2 del formulario
$usuario= $_SESSION["correo"];
$palabraImg1 = $_POST['palabraImg1'];
$palabraImg2 = $_POST['palabraImg2'];

// Preparar la consulta SQL para insertar los datos en la tabla comparaciones
$sql = "INSERT INTO guardarcomparaciones (usuario, card1palabraImg, card2palabraImg) VALUES ('$usuario','$palabraImg1', '$palabraImg2')";

if ($conn->query($sql) === TRUE) {
    echo "La comparación se guardó correctamente";
} else {
    echo "Error al guardar la comparación: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

<!--/*
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se han recibido los datos necesarios
        if (isset($_POST['usuario']) && isset($_POST['card1palabraImg']) && isset($_POST['card2palabraImg'])) {
            // Obtener los datos del formulario
            $usuario = $_POST['usuario'];
            $card1palabraImg = $_POST['card1palabraImg'];
            $card2palabraImg = $_POST['card2palabraImg'];

            // Realizar cualquier validación adicional aquí

            // Conectar a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "comparadorbd";

            // Crear la conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Preparar la consulta SQL para insertar los datos
            $sql = "INSERT INTO guardarComparaciones (usuario, card1palabraImg, card2palabraImg) VALUES ('$usuario', '$card1palabraImg', '$card2palabraImg')";

            // Ejecutar la consulta y verificar si se realizó correctamente
            if ($conn->query($sql) === TRUE) {
                echo "Datos insertados correctamente.";
            } else {
                echo "Error al insertar datos: " . $conn->error;
            }

            // Cerrar la conexión
            $conn->close();
        } else {
            echo "Faltan datos en el formulario.";
        }
    }-->

<!--<form id="guardar-form" method="post" action="guardar_comparaciones.php">
        <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['correo']; ?>">
        <input type="hidden" id="tablacard1" name="tablacard1">
        <input type="hidden" id="tablacard2" name="tablacard2">
        <input type="hidden" id="card1palabraImg" name="card1palabraImg" value="${details1.palabraImg}">
        <input type="hidden" id="card2palabraImg" name="card2palabraImg" value="${details2.palabraImg}">
        <button type="submit" class="button">Guardar Comparación</button>
    </form>*/-->