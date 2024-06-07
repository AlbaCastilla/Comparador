<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comparadorbd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Verificar si se ha enviado el parámetro "card1palabraImg" en la URL
if(isset($_GET['card1palabraImg'])) {
    // Obtener el valor de card1palabraImg
    $card1palabraImg = $_GET['card1palabraImg'];
    // Asignar el valor a la variable $palabraImg para usarlo en la consulta SQL
}

// Verificar si se ha enviado el parámetro "card2palabraImg" en la URL
if(isset($_GET['card2palabraImg'])) {
    // Obtener el valor de card2palabraImg
    $card2palabraImg = $_GET['card2palabraImg'];
    // Asignar el valor a la variable $palabraImg para usarlo en la consulta SQL
}

// Consulta SQL para obtener los detalles del objeto con palabraImg correspondiente a card1palabraImg
$sql1 = "SELECT * FROM accesoriosPerros WHERE palabraImg = '$card1palabraImg'
         UNION
         SELECT * FROM accesoriosGatos WHERE palabraImg = '$card1palabraImg'
         UNION
         SELECT * FROM accesoriosRoedores WHERE palabraImg = '$card1palabraImg'
         UNION
         SELECT * FROM accesoriosAves WHERE palabraImg = '$card1palabraImg'
         UNION
         SELECT * FROM accesoriosReptiles WHERE palabraImg = '$card1palabraImg'
         UNION
         SELECT * FROM accesoriosPeces WHERE palabraImg = '$card1palabraImg'";

// Consulta SQL para obtener los detalles del objeto con palabraImg correspondiente a card2palabraImg
$sql2 = "SELECT * FROM accesoriosPerros WHERE palabraImg = '$card2palabraImg'
         UNION
         SELECT * FROM accesoriosGatos WHERE palabraImg = '$card2palabraImg'
         UNION
         SELECT * FROM accesoriosRoedores WHERE palabraImg = '$card2palabraImg'
         UNION
         SELECT * FROM accesoriosAves WHERE palabraImg = '$card2palabraImg'
         UNION
         SELECT * FROM accesoriosReptiles WHERE palabraImg = '$card2palabraImg'
         UNION
         SELECT * FROM accesoriosPeces WHERE palabraImg = '$card2palabraImg'";

// Ejecutar las consultas SQL
$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);

// Verificar si se obtuvieron resultados para card1palabraImg
if ($result1->num_rows > 0) {
    // Mostrar los detalles del objeto con palabraImg correspondiente a card1palabraImg
    while ($row1 = $result1->fetch_assoc()) {
        echo "<div class='compare-card div'>";
        echo "<h2 class='h2'>" . $row1['tipoJuguete'] . "</h2>";
        echo "<div class='div-img-comparador div'>";
        echo "<img src='imgsComparador/" . $row1['palabraImg'] . ".jpg' alt='" . $row1['tipoJuguete'] . "' class='img'>";
        echo "</div>";
        echo "<div class='compare-card-text div'>";
        echo "<p class='p'>Material: " . $row1['material'] . "</p>";
        echo "<p class='p'>Descripción: " . $row1['descripcion'] . "</p>";
        /*echo "<p class='p'>Durabilidad: " . getStars($row1['durabilidad']) . "</p>";
        echo "<p class='p'>Reseñas: " . getStars($row1['reviews']) . "</p>";*/
        echo "<p class='p'>Precio: " . $row1['precio'] . " €</p>";
        echo "</div>";
        echo "<button class='button'>Donar</button>";
        echo "</div>";
    }
}

// Verificar si se obtuvieron resultados para card2palabraImg
if ($result2->num_rows > 0) {
    // Mostrar los detalles del objeto con palabraImg correspondiente a card2palabraImg
    while ($row2 = $result2->fetch_assoc()) {
        echo "<div class='compare-card div'>";
        echo "<h2 class='h2'>" . $row2['tipoJuguete'] . "</h2>";
        echo "<div class='div-img-comparador div'>";
        echo "<img src='imgsComparador/" . $row2['palabraImg'] . ".jpg' alt='" . $row2['tipoJuguete'] . "' class='img'>";
        echo "</div>";
        echo "<div class='compare-card-text div'>";
        echo "<p class='p'>Material: " . $row2['material'] . "</p>";
        echo "<p class='p'>Descripción: " . $row2['descripcion'] . "</p>";
        /*echo "<p class='p'>Durabilidad: " . getStars($row2['durabilidad']) . "</p>";
        echo "<p class='p'>Reseñas: " . getStars($row2['reviews']) . "</p>";*/
        echo "<p class='p'>Precio: " . $row2['precio'] . " €</p>";
        echo "</div>";
        echo "<button class='button'>Donar</button>";
        echo "</div>";
    }
}
?>
