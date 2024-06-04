<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

// Recoger datos del formulario
$tabla = $_POST['tabla'];
$tipoJuguete = $_POST['tipoJuguete'];
$material = $_POST['material'];
$tamanio = $_POST['tamanio'];
$color = $_POST['color'];
$descripcion = $_POST['descripcion'];
$instrucciones = $_POST['instrucciones'];
$palabraImg = $_POST['palabraImg'];
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

// Manejar la subida de la imagen
$target_dir = "imgsComparador/";
$imageFileType = strtolower(pathinfo(basename($_FILES["imagen"]["name"]), PATHINFO_EXTENSION));
$target_file = $target_dir . $palabraImg . '.' . $imageFileType;

if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    // Subida exitosa, ahora guardar los datos en la base de datos
    $sql = "INSERT INTO $tabla (tipoJuguete, material, tamanio, color, descripcion, instrucciones, palabraImg, durabilidad, reviews, precio, durabilidadGrafico, impactoAmbientalGrafico, facilidadLimpiezaGrafico, estiloGrafico, reviewsGrafico, numComentarios, urgente) 
            VALUES ('$tipoJuguete', '$material', '$tamanio', '$color', '$descripcion', '$instrucciones', '$palabraImg', '$durabilidad', '$reviews', '$precio', '$durabilidadGrafico', '$impactoAmbientalGrafico', '$facilidadLimpiezaGrafico', '$estiloGrafico', '$reviewsGrafico', '$numComentarios','$urgente')";

    if ($conn->query($sql) === TRUE) {
        header("Location: comparadorAdmin2.php");
                    exit();
    } else {
         echo "Error:  . $sql . <br> . $conn->error)";
    }
} else {
    echo "Error al subir la imagen)";
}

}
$conn->close();
?>
