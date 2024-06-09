<?php
// Establecer conexión a la base de datos (sustituye los valores con tus credenciales)
$servername = "localhost:3366";
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
$tipoJuguete = $_POST['tipoJuguete'];
$material = $_POST['material'];
$tamanio = $_POST['tamanio'];
$color = $_POST['color'];
$descripcion = $_POST['descripcion'];
$instrucciones = $_POST['instrucciones'];
$durabilidad = $_POST['durabilidad'];
$reviews = $_POST['reviews'];
$precio = $_POST['precio'];
$durabilidadGrafico = $_POST['durabilidadGrafico'];
$impactoAmbientalGrafico = $_POST['impactoAmbientalGrafico'];
$facilidadLimpiezaGrafico = $_POST['facilidadLimpiezaGrafico'];
$estiloGrafico = $_POST['estiloGrafico'];
$reviewsGrafico = $_POST['reviewsGrafico'];
$numComentarios = $_POST['numComentarios'];
$urgente = $_POST['urgente'];

$tablas = array("accesoriosPerros", "accesoriosGatos", "accesoriosRoedores", "accesoriosAves", "accesoriosReptiles", "accesoriosPeces");

// Inicializar una variable para almacenar los datos de la tabla encontrada
$tablaEncontrada = null;

foreach ($tablas as $tabla) {
    $sql2 = "SELECT * FROM $tabla WHERE tipoJuguete = '$tipoJuguete'";
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
    $sql = "SELECT * FROM $tablaEncontrada WHERE tipoJuguete = '$tipoJuguete'"; 
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Existen resultados, comparar valores y actualizar si es necesario
            $row = $result->fetch_assoc();

            // Construir la consulta de actualización dinámicamente
            $sql_update = "UPDATE $tablaEncontrada SET ";
            $updates = array();

            // Comparar cada campo y agregarlo a la consulta si es diferente
            if ($row['material'] != $material) $updates[] = "material='$material'";
            if ($row['tamanio'] != $tamanio) $updates[] = "tamanio='$tamanio'";
            if ($row['color'] != $color) $updates[] = "color='$color'";
            if ($row['descripcion'] != $descripcion) $updates[] = "descripcion='$descripcion'";
            if ($row['instrucciones'] != $instrucciones) $updates[] = "instrucciones='$instrucciones'";
            if ($row['durabilidad'] != $durabilidad) $updates[] = "durabilidad='$durabilidad'";
            if ($row['reviews'] != $reviews) $updates[] = "reviews='$reviews'";
            if ($row['precio'] != $precio) $updates[] = "precio='$precio'";
            if ($row['durabilidadGrafico'] != $durabilidadGrafico) $updates[] = "durabilidadGrafico='$durabilidadGrafico'";
            if ($row['impactoAmbientalGrafico'] != $impactoAmbientalGrafico) $updates[] = "impactoAmbientalGrafico='$impactoAmbientalGrafico'";
            if ($row['facilidadLimpiezaGrafico'] != $facilidadLimpiezaGrafico) $updates[] = "facilidadLimpiezaGrafico='$facilidadLimpiezaGrafico'";
            if ($row['estiloGrafico'] != $estiloGrafico) $updates[] = "estiloGrafico='$estiloGrafico'";
            if ($row['reviewsGrafico'] != $reviewsGrafico) $updates[] = "reviewsGrafico='$reviewsGrafico'";
            if ($row['numComentarios'] != $numComentarios) $updates[] = "numComentarios='$numComentarios'";
            if ($row['urgente'] != $urgente) $updates[] = "urgente='$urgente'";

            // Verificar si hay algo que actualizar
            if (count($updates) > 0) {
                $sql_update .= implode(", ", $updates);
                $sql_update .= " WHERE tipoJuguete='$tipoJuguete'";

                // Ejecutar la consulta de actualización
                if ($conn->query($sql_update) === TRUE) {
                    header("Location: comparadorAdmin2.php");
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
