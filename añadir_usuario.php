<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$conex = mysqli_connect("localhost:3306", "root", "", "comparadorbd") ;

if($conex){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $correo= $_POST["correo"];
            $contrasena = $_POST["contrasena"];

            if (empty($nombre) || empty($correo) || empty($contrasena)) {
                echo "Todos los campos son obligatorios.";
            } else{
                $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
                $result = mysqli_query($conex, $sql);
        
                if (mysqli_query($conex, $sql)) {
                    echo "Usuario insertado correctamente.";
                    header("location: login.php");
                } else {
                    echo "Error al insertar el usuario: " . mysqli_error($conex);
                }
            }
            mysqli_close($conex);
        }
} else {
        echo "Error de conexión";
}

?>