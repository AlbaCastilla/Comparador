

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
// Datos de conexión a la base de datos
$servername = "localhost:3366";
$username = "root";
$password = "";
$dbname = "comparadorbd";


//VERSION BUENA


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la palabraImg de la solicitud GET
$nombreAnimal = $_GET['NombreAnimal'];

// Array con el nombre de las tablas donde buscar
$tablas = array("perros", "gatos", "roedores", "reptiles", "peces", "aves");

// Inicializar una variable para almacenar los datos del producto
$producto = null;

// Buscar la palabraImg en cada tabla
foreach ($tablas as $tabla) {
    // Consulta para obtener los detalles del producto según la palabraImg
    $sql = "SELECT * FROM $tabla WHERE NombreAnimal='$nombreAnimal'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // La palabraImg fue encontrada en esta tabla
        // Obtener la fila de resultado como un array asociativo
        $row = $result->fetch_assoc();
        // Almacenar los datos del producto encontrado y salir del bucle
        $producto = $row;
        break;
    }
}

if ($producto !== null) {
    // Devolver los datos del producto como respuesta JSON
    header('Content-Type: application/json');
    echo json_encode($producto);
} else {
    // No se encontraron resultados
    echo json_encode(array('error' => 'No se encontraron resultados'));
}

// Cerrar conexión
$conn->close();
?>
