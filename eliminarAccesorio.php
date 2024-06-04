<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comparadorbd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

$palabraImg = $_GET['palabraImg'];
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$tablas = ['accesoriosPerros', 'accesoriosGatos', 'accesoriosRoedores', 'accesoriosAves', 'accesoriosReptiles', 'accesoriosPeces'];
$tablaEncontrada = null;

/*HAY UN BREAK ME LO HA HECHO CHATTY PQ NO FUNCIONABA, CAMBIARLO UN BUCLE BEIN
foreach ($tablas as $tabla) {
    $sql = "SELECT * FROM $tabla WHERE palabraImg = '$palabraImg'";
    $result = $conn->query($sql);
    echo $tabla;
    if ($result->num_rows > 0) {
        $tablaEncontrada = $tabla;
        echo "tabla encontrada";
        break;
    }
}

if ($tablaEncontrada === null) {
    die("No se encontró la tabla correspondiente.");
}

$sql3 = "DELETE FROM $tablaEncontrada WHERE tipoJuguete = '$palabraImg'";
$conn->multi_query($sql3);

$conn->close();
*/






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

// Obtener la palabraImg de la solicitud GET
$palabraImg = $_GET['palabraImg'];

// Array con el nombre de las tablas donde buscar
$tablas = array("accesoriosPerros", "accesoriosGatos", "accesoriosRoedores", "accesoriosAves", "accesoriosReptiles", "accesoriosPeces");

// Inicializar una variable para almacenar la tabla encontrada
$tablaEncontrada = null;

// Buscar la palabraImg en cada tabla
foreach ($tablas as $tabla) {
    // Consulta para verificar si la palabraImg existe en la tabla
    $sql = "SELECT * FROM $tabla WHERE palabraImg='$palabraImg'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // La palabraImg fue encontrada en esta tabla
        $tablaEncontrada = $tabla;
        break;
    }
}

if ($tablaEncontrada !== null) {
    // Si se encontró la tabla, proceder a eliminar el registro
    $sqlDelete = "DELETE FROM $tablaEncontrada WHERE palabraImg='$palabraImg'";
    if ($conn->query($sqlDelete) === TRUE) {
        echo json_encode(array('success' => 'Registro eliminado con éxito'));
    } else {
        echo json_encode(array('error' => 'Error al eliminar el registro: ' . $conn->error));
    }
} else {
    // No se encontró la palabraImg en ninguna tabla
    echo json_encode(array('error' => 'No se encontró la palabraImg en las tablas especificadas'));
}

// Cerrar conexión
$conn->close();


?>