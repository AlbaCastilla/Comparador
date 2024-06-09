<?php
// Establecer conexión a la base de datos (sustituye los valores con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comparadorbd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombreAnimal = $_POST['NombreAnimal2'];
$edad = $_POST['Edad2'];
$tamanio = $_POST['Tamanio2'];
$peso = $_POST['Peso2'];
$descripcion = $_POST['Descripcion2'];
$raza = $_POST['Raza2'];
$genero = $_POST['Genero2'];
$dimension = $_POST['Dimension2'];
$etapa = $_POST['Etapa2'];

$tablas = array("perros", "gatos", "roedores", "aves", "reptiles", "peces");

// Inicializar una variable para almacenar los datos de la tabla encontrada
$tablaEncontrada = null;

foreach ($tablas as $tabla) {
    $sql2 = "SELECT * FROM $tabla WHERE NombreAnimal = '$nombreAnimal'";
    $result2 = $conn->query($sql2);

    if ($result2) {
        if ($result2->num_rows > 0) {
            $tablaEncontrada = $tabla;
            break;
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
        exit;
    }
}

// Consulta SQL para obtener los valores actuales
if ($tablaEncontrada) {
    $sql = "SELECT * FROM $tablaEncontrada WHERE NombreAnimal = '$nombreAnimal'"; 
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Existen resultados, comparar valores y actualizar si es necesario
            $row = $result->fetch_assoc();

            // Construir la consulta de actualización dinámicamente
            $sql_update = "UPDATE $tablaEncontrada SET ";
            $updates = array();

            // Comparar cada campo y agregarlo a la consulta si es diferente
            if ($row['edad'] != $edad) $updates[] = "Edad='$edad'";
            if ($row['tamanio'] != $tamanio) $updates[] = "Tamanio='$tamanio'";
            if ($row['peso'] != $peso) $updates[] = "Peso='$peso'";
            if ($row['descripcion'] != $descripcion) $updates[] = "Descripcion='$descripcion'";
            if ($row['raza'] != $raza) $updates[] = "Raza='$raza'";
            if ($row['genero'] != $genero) $updates[] = "Genero='$genero'";
            if ($row['dimension'] != $dimension) $updates[] = "Dimension='$dimension'";
            if ($row['etapa'] != $etapa) $updates[] = "Etapa='$etapa'";

            // Verificar si hay algo que actualizar
            if (count($updates) > 0) {
                $sql_update .= implode(", ", $updates);
                $sql_update .= " WHERE NombreAnimal='$nombreAnimal'";

                // Ejecutar la consulta de actualización
                if ($conn->query($sql_update) === TRUE) {
                    header("Location: animalesFiltrosAdmin.php");
                    exit();
                } else {
                    echo "Error al actualizar el registro: " . $conn->error;
                }
            } else {
                echo "No hay cambios para actualizar.";
            }
        } else {
            echo "No se encontraron resultados.";
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
} else {
    echo "No se encontró la tabla correspondiente.";
}

// Cerrar conexión
$conn->close();
?>
