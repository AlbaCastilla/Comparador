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

// Obtener el nombreAnimal de la solicitud GET
$nombreAnimal = $_GET['nombreAnimal'];

// Array con el nombre de las tablas donde buscar
$tablas = array("perros", "gatos", "roedores", "aves", "reptiles", "peces");

// Inicializar una variable para almacenar la tabla encontrada
$tablaEncontrada = null;

// Buscar el nombreAnimal en cada tabla
foreach ($tablas as $tabla) {
    // Consulta para verificar si el nombreAnimal existe en la tabla
    $sql = "SELECT * FROM $tabla WHERE NombreAnimal='$nombreAnimal'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El nombreAnimal fue encontrado en esta tabla
        $tablaEncontrada = $tabla;
        break;
    }
}

if ($tablaEncontrada !== null) {
    // Si se encontró la tabla, proceder a eliminar el registro
    $sqlDelete = "DELETE FROM $tablaEncontrada WHERE NombreAnimal='$nombreAnimal'";
    if ($conn->query($sqlDelete) === TRUE) {
        echo json_encode(array('success' => 'Registro eliminado con éxito'));
    } else {
        echo json_encode(array('error' => 'Error al eliminar el registro: ' . $conn->error));
    }
} else {
    // No se encontró el nombreAnimal en ninguna tabla
    echo json_encode(array('error' => 'No se encontró el nombreAnimal en las tablas especificadas'));
}

// Cerrar conexión
$conn->close();

?>
