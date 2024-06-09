<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos
    $servername = "localhost:3306";
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
    $nombreAnimal = $_POST['NombreAnimal'];
    $edad = $_POST['Edad'];
    $tamanio = $_POST['tamanio'];
    $peso = $_POST['Peso'];
    $descripcion = $_POST['Descripcion'];
    $raza = $_POST['Raza'];
    $genero = $_POST['Genero'];
    $dimension = $_POST['Dimension'];
    $etapa = $_POST['Etapa'];

    // Manejar la subida de la imagen
    $target_dir = "imgsAnimales/";
    $imageFileType = strtolower(pathinfo(basename($_FILES["Imagen"]["name"]), PATHINFO_EXTENSION));
    $target_file = $target_dir . $nombreAnimal . '.' . $imageFileType;

    if (move_uploaded_file($_FILES["Imagen"]["tmp_name"], $target_file)) {
        // Subida exitosa, ahora guardar los datos en la base de datos
        $sql = "INSERT INTO $tabla (NombreAnimal, Edad, Tamanio, Peso, Descripcion, Raza, Genero, Dimension, Etapa ) 
                VALUES ('$nombreAnimal', '$edad', '$tamanio', '$peso', '$descripcion', '$raza', '$genero', '$dimension', '$etapa')";

        if ($conn->query($sql) === TRUE) {
            header("Location: animalesFiltrosAdmin.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error al subir la imagen";
    }

    $conn->close();
}
?>
