<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/tarjetas_comparar_grande.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>document.addEventListener("DOMContentLoaded", function() {
    // Selecciona el elemento body
    var body = document.querySelector("body");

    // Oculta el cursor predeterminado
    body.style.cursor = "none";

    // Crea un nuevo elemento de imagen para el cursor
    var customCursor = new Image();
    customCursor.src = "cursor.png";
    customCursor.style.position = "fixed"; // Asegura que el cursor se muestre correctamente
    customCursor.style.pointerEvents = "none"; // Evita que el cursor personalizado capture eventos de ratón
    customCursor.style.zIndex = "9999"; 
    // Establece el tamaño del cursor personalizado
    var tamañoCursor = 20; // Tamaño del cursor personalizado en píxeles
    customCursor.width = tamañoCursor;
    customCursor.height = tamañoCursor;

    // Escucha eventos de movimiento del ratón
    body.addEventListener("mousemove", function(event) {
        // Actualiza la posición del cursor personalizado
        customCursor.style.left = (event.clientX - tamañoCursor / 2) + "px";
        customCursor.style.top = (event.clientY - tamañoCursor / 2) + "px";
    });

    // Agrega el cursor personalizado al cuerpo del documento
    body.appendChild(customCursor);

});</script>
</head>
<body class="body">
    <?php include "includes/navbar.php"; ?>
    <div class="caja-contenido">
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

        function getStars($count) {
            $stars = '';
            $fullStars = floor($count);
            $emptyStars = 5 - $fullStars;
            for ($i = 0; $i < $fullStars; $i++) {
                $stars .= '★';
            }
            for ($i = 0; $i < $emptyStars; $i++) {
                $stars .= '☆';
            }
            return $stars;
        }

        $card1palabraImg = $_GET['card1palabraImg'] ?? '';
        $card2palabraImg = $_GET['card2palabraImg'] ?? '';

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

        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);

        $row1 = $result1->fetch_assoc();
        $row2 = $result2->fetch_assoc();

        if ($row1) {
            echo "<div class='compare-card'>";
            echo "<h2 class='titulo'>" . $row1['tipoJuguete'] . "</h2>";
            echo "<div class='img-contenedor'>";
            echo "<img src='imgsComparador/" . $row1['palabraImg'] . ".jpg' alt='" . $row1['tipoJuguete'] . "' class='img'>";
            echo "</div>";
            echo "<div class='texto'>";
            echo "<p class='parrafo'>Material: " . $row1['material'] . "</p>";
            echo "<p class='parrafo'>Descripción: " . $row1['descripcion'] . "</p>";
            echo "<p class='parrafo'>Durabilidad: " . getStars($row1['durabilidad']) . "</p>";
            echo "<p class='parrafo'>Reseñas: " . getStars($row1['reviews']) . "</p>";
            echo "<p class='parrafo'>Precio: " . $row1['precio'] . " €</p>";
            echo "</div>";
            echo "<button class='boton'>Donar</button>";
            echo "</div>";
        }

        if ($row2) {
            echo "<div class='compare-card'>";
            echo "<h2 class='titulo'>" . $row2['tipoJuguete'] . "</h2>";
            echo "<div class='img-contenedor'>";
            echo "<img src='imgsComparador/" . $row2['palabraImg'] . ".jpg' alt='" . $row2['tipoJuguete'] . "' class='img'>";
            echo "</div>";
            echo "<div class='texto'>";
            echo "<p class='parrafo'>Material: " . $row2['material'] . "</p>";
            echo "<p class='parrafo'>Descripción: " . $row2['descripcion'] . "</p>";
            echo "<p class='parrafo'>Durabilidad: " . getStars($row2['durabilidad']) . "</p>";
            echo "<p class='parrafo'>Reseñas: " . getStars($row2['reviews']) . "</p>";
            echo "<p class='parrafo'>Precio: " . $row2['precio'] . " €</p>";
            echo "</div>";
            echo "<button class='boton'>Donar</button>";
            echo "</div>";
        }
        ?>
    </div>
    <div class="caja-graficos">
        <div class="chart-container">
            <div class="chart1-container">
                <h3 class="h3">Media de evaluación integral de los productos</h3>
                <canvas id="durabilityChart" class="canvas"></canvas>
            </div>
            <div>
                <h3 class="h3">Porcentaje de comparación entre productos, evaluación general</h3>
                <canvas id="reviewsChart" class="canvas"></canvas>
            </div>
        </div>
    </div>

    <script>
    <?php if ($row1 && $row2): ?>
        const details1 = {
            reviews: <?php echo $row1['reviews']; ?>,
            tipoJuguete: '<?php echo $row1['tipoJuguete']; ?>',
            durabilidadGrafico: <?php echo $row1['durabilidadGrafico']; ?>,
            facilidadLimpiezaGrafico: <?php echo $row1['facilidadLimpiezaGrafico']; ?>,
            impactoAmbientalGrafico: <?php echo $row1['impactoAmbientalGrafico']; ?>,
            estiloGrafico: <?php echo $row1['estiloGrafico']; ?>
        };

        const details2 = {
            reviews: <?php echo $row2['reviews']; ?>,
            tipoJuguete: '<?php echo $row2['tipoJuguete']; ?>',
            durabilidadGrafico: <?php echo $row2['durabilidadGrafico']; ?>,
            facilidadLimpiezaGrafico: <?php echo $row2['facilidadLimpiezaGrafico']; ?>,
            impactoAmbientalGrafico: <?php echo $row2['impactoAmbientalGrafico']; ?>,
            estiloGrafico: <?php echo $row2['estiloGrafico']; ?>
        };

        const dataDurability = {
            labels: ['Durabilidad', 'Facilidad de limpieza', 'Impacto ambiental', 'Estilo'],
            datasets: [{
                label: details1.tipoJuguete,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: [details1.durabilidadGrafico, details1.facilidadLimpiezaGrafico, details1.impactoAmbientalGrafico, details1.estiloGrafico]
            }, {
                label: details2.tipoJuguete,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                data: [details2.durabilidadGrafico, details2.facilidadLimpiezaGrafico, details2.impactoAmbientalGrafico, details2.estiloGrafico]
            }]
        };

        const dataReviews = {
            labels: ['Reseñas'],
            datasets: [{
                label: details1.tipoJuguete,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: [details1.reviews]
            }, {
                label: details2.tipoJuguete,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                data: [details2.reviews]
            }]
        };

        const options = {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        };

        const ctxDurability = document.getElementById('durabilityChart').getContext('2d');
        new Chart(ctxDurability, {
            type: 'bar',
            data: dataDurability,
            options: options
        });

        const ctxReviews = document.getElementById('reviewsChart').getContext('2d');
        new Chart(ctxReviews, {
            type: 'bar',
            data: dataReviews,
            options: options
        });
    <?php endif; ?>
    </script>
    <?php include "includes/footer.php"; ?>
</body>
</html>