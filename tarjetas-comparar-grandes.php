<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/tarjetas_comparar_grande.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        if(isset($_GET['card1palabraImg'])) {
            $card1palabraImg = $_GET['card1palabraImg'];
        }

        if(isset($_GET['card2palabraImg'])) {
            $card2palabraImg = $_GET['card2palabraImg'];
        }

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

        

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
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
        }

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
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
        }
        ?>
    </div>
    <div class="caja-graficos">
    <div class="chart-container">
        <div class="chart1-container">
            <h3 class="h3">Media de evaluación integral de los productos</h3>
            <canvas id="durabilityChart" class="canvas">
                <script>
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
        const data = {
            labels: ['Durabilidad', 'Facilidad de limpieza', 'Impacto ambiental', 'Estilo'],
            datasets: [{
                label: '<?php echo $details1["tipoJuguete"]; ?>',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: [<?php echo $details1["durabilidadGrafico"]; ?>, <?php echo $details1["facilidadLimpiezaGrafico"]; ?>, <?php echo $details1["impactoAmbientalGrafico"]; ?>, <?php echo $details1["estiloGrafico"]; ?>]
            }, {
                label: '<?php echo $details2["tipoJuguete"]; ?>',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                data: [<?php echo $details2["durabilidadGrafico"]; ?>, <?php echo $details2["facilidadLimpiezaGrafico"]; ?>, <?php echo $details2["impactoAmbientalGrafico"]; ?>, <?php echo $details2["estiloGrafico"]; ?>]
            }]
        };

        // Configurar opciones para los gráficos
        const options = {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10,
                    ticks: {
                        stepSize: 5,
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        };

        // Crear y mostrar los gráficos
        const ctx = document.getElementById('durabilityChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

                </script>
            </canvas>
        </div>
        <div>
            <h3 class="h3">Porcentaje de comparación entre productos, evaluación general</h3>
            <canvas id="reviewsChart" class="canvas"></canvas>
        </div>
    </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>
