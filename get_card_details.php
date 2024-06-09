<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost:3366";
$username = "root";
$password = "";
$dbname = "comparadorbd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if(!isset($_GET["palabraImg"])){
    exit("Not found");
}

$palabraImg = $conn->real_escape_string($_GET['palabraImg']);

$sql = "SELECT * FROM accesoriosPerros WHERE palabraImg = '$palabraImg'
        UNION
        SELECT * FROM accesoriosGatos WHERE palabraImg = '$palabraImg'
        UNION
        SELECT * FROM accesoriosRoedores WHERE palabraImg = '$palabraImg'
        UNION
        SELECT * FROM accesoriosAves WHERE palabraImg = '$palabraImg'
        UNION
        SELECT * FROM accesoriosReptiles WHERE palabraImg = '$palabraImg'
        UNION
        SELECT * FROM accesoriosPeces WHERE palabraImg = '$palabraImg'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$conn->close();
?>
