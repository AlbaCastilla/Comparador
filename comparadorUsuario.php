<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accesorios de Mascotas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/comparadorUsuario.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

});
window.addEventListener('resize', function() {
    const canvas = document.getElementById('durabilityChart');
    const containerWidth = canvas.parentElement.offsetWidth;
    canvas.width = containerWidth;
});
   window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    const compareButton = document.getElementById('compare-button');
    const topButton = document.getElementById('top-button');
    const topButtonBtn = document.getElementById('top-button-btn');
    const footer = document.getElementById('footer');
    
    // Mostrar/ocultar el botón de "Volver Arriba"
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block";
    } else {
        topButton.style.display = "none";
    }

    // Obtener la posición del pie de página
    const footerRect = footer.getBoundingClientRect();
    const footerVisible = footerRect.top < window.innerHeight && footerRect.bottom >= 0;

    // Mostrar/ocultar el botón de "Comparar" y cambiar el color del botón de "Volver Arriba"
    if (footerVisible) {
        compareButton.style.display = "none";
        topButtonBtn.style.backgroundColor = "white";
        topButtonBtn.style.color = "black";
    } else {
        compareButton.style.display = "block";
        topButtonBtn.style.backgroundColor = "#5B8869"; 
        topButtonBtn.style.color = "white";
    }
}

    let selectedCards = [];

    function toggleSelectCard(card, palabraImg) {
        card.classList.toggle('selected');
        const index = selectedCards.indexOf(palabraImg);
        if (index > -1) {
            selectedCards.splice(index, 1);
        } else {
            if (selectedCards.length < 2) {
                selectedCards.push(palabraImg);
            } else {
                alert('Solo puedes seleccionar dos tarjetas para comparar');
                card.classList.toggle('selected');
            }
        }
        //alert('Tarjetas seleccionadas: ' + JSON.stringify(selectedCards));
    }

    async function fetchCardDetails(palabraImg) {
        console.log("funciona funcion de llamar");
        //alert('Tarjetas seleccionadas: ' + palabraImg);
        const response = await fetch(`get_card_details.php?palabraImg=${palabraImg}`);
        const data = await response.json();
        return data;
    }

    function getStars(count) {
    let stars = '';
    // Calcula cuántas estrellas llenas y cuántas vacías necesitas
    const fullStars = Math.floor(count);
    const emptyStars = 5 - fullStars;
    // Agrega las estrellas llenas
    for (let i = 0; i < fullStars; i++) {
        stars += '&#9733;'; // Agrega el símbolo de estrella llena
    }
    // Agrega las estrellas vacías
    for (let i = 0; i < emptyStars; i++) {
        stars += '&#9734;'; // Agrega el símbolo de estrella vacía
    }
    return stars;
}

function donateCard(event, palabraImg) {
    event.stopPropagation(); // Detener la propagación del evento para que no active el contenedor padre
    console.log("PalabraImg seleccionada para donar:", palabraImg);
    if (palabraImg != undefined) {
        donateCardConnect(palabraImg);
    }
}

async function donateCardConnect(palabraImg) {
    console.log("Enviando petición con palabraImg:", palabraImg);
    try {
        const response = await fetch(`cogerpalabraImgDonar.php?palabraImg=${palabraImg}`);
        if (response.ok) {
            console.log("Donación completada con éxito");
            window.location.href = "donar.php"; // Redirigir a donar.php
        } else {
            console.error("Error en la donación");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
}


function guardarComparacion(palabraImg1,palabraImg2) {
    

    const formData = new FormData();
    formData.append('palabraImg1', palabraImg1);
    formData.append('palabraImg2', palabraImg2);

    fetch('guardar_comparaciones.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            // La comparación se guardó correctamente
            console.log(response);
            console.log('Comparación guardada exitosamente');
        } else {
            // Hubo un error al guardar la comparación
            console.error('Error al guardar la comparación');
        }
    })
    .catch(error => {
        console.error('Error de red:', error);
    });
}


    async function compareCards() {
        if (selectedCards.length !== 2) {
            alert('Selecciona exactamente dos tarjetas para comparar');
            return;
        }
        
        const details1 = await fetchCardDetails(selectedCards[0]);
        const details2 = await fetchCardDetails(selectedCards[1]);

        const details1ReviewsPercent = (details1.reviewsGrafico / details1.numComentarios) * 100;
        const details2ReviewsPercent = (details2.reviewsGrafico / details2.numComentarios) * 100;

        /*SE PUEDE AÑADIR TMBN INDTRUCCIONES, TAMAÑO Y COLOR*/
        document.getElementById('compare-container').innerHTML = `
    <div class="compare-card div">
        <h2 class="h2">${details1.tipoJuguete}</h2>
        <div class="div-img-comparador div">
            <img src="imgsComparador/${details1.palabraImg}.jpg" alt="${details1.tipoJuguete}" class="img">
        </div>
        <div class="compare-card-text div">
            <p class="p">Material: ${details1.material}</p>
            <p class="p">Descripción: ${details1.descripcion}</p>
            <p class="p">Durabilidad: ${getStars(details1.durabilidad)}</p>
            <p class="p">Reseñas: ${getStars(details1.reviews)}</p>   
            <p class="p">Precio: ${details1.precio} €</p>
        </div>
        <button class="button">Donar</button>
    </div>
    <div class="compare-card div">
        <h2 class="h2">${details2.tipoJuguete}</h2>
        <div class="div-img-comparador div">
            <img src="imgsComparador/${details2.palabraImg}.jpg" alt="${details2.tipoJuguete}" class="img">
        </div>
        <div class="compare-card-text div">
            <p class="p">Material: ${details2.material}</p>
            <p class="p">Descripción: ${details2.descripcion}</p>
            <p class="p">Durabilidad: ${getStars(details2.durabilidad)}</p>
            <p class="p">Reseñas: ${getStars(details2.reviews)}</p> 
            <p class="p">Precio: ${details2.precio} €</p>
        </div>
        <button class="button">Donar</button>
    </div>
    <div class="chart-container div">
        <div class="chart1-container div">
            <h3 class="h3">Media de evaluación integral de los productos</h3>
            <canvas id="durabilityChart" class="canvas"></canvas>
        </div>
        <div class="div">
            <h3 class="h3">Porcentaje de comparación entre productos, evaluación general</h3>
            <canvas id="reviewsChart" class="canvas"></canvas>
        </div>
    </div>
    <button id="btnParaGuardarComparacionEnTabla" class="button" onclick="guardarComparacion('${details2.palabraImg}','${details1.palabraImg}')" type="button">Guardar Comparación</button>

    
`;


        const data = {
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

            // Configurar opciones para los gráficos
            const options = {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10, // Valor máximo del eje y
                        ticks: {
                            stepSize: 5, // Mostrar todos los números
                            callback: function(value) {
                                return value; // Mostrar todos los números del 0 al 10
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

            const reviewsData = {
            labels: [details1.tipoJuguete, details2.tipoJuguete],
            datasets: [{
                label: 'Reseñas',
                backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)'],
                borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                borderWidth: 1,
                data: [details1ReviewsPercent, details2ReviewsPercent]
            }]
        };

        const reviewsOptions = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                        }
                    }
                }
            }
        };

        const reviewsCtx = document.getElementById('reviewsChart').getContext('2d');
        new Chart(reviewsCtx, {
            type: 'pie',
            data: reviewsData,
            options: reviewsOptions
        });


        // Reiniciar el estado de las selecciones
        selectedCards = [];
        document.querySelectorAll('.card').forEach(card => card.classList.remove('selected'));
        // Scroll hasta la sección de comparación
        document.getElementById('compare-container').scrollIntoView({ behavior: 'smooth' });
    }

    function resetSelection() {
        selectedCards = [];
        document.querySelectorAll('.card').forEach(card => card.classList.remove('selected'));
        document.getElementById('compare-container').innerHTML = '';
    }

    function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
    </script>
</head>
<body class="body">
<?php
    include "includes/navbar.php";
?>
    <h1 class="h1 titulo-principal-comparador">Accesorios de Mascotas</h1>
    <div id="botones-accesorios" class="div">
        <a href="#parte-accesorios-perros" class="a">Accesorios Perros</a>
        <a href="#parte-accesorios-gatos" class="a">Accesorios Gatos</a>
        <a href="#parte-accesorios-roedores" class="a">Accesorios Roedores</a>
        <a href="#parte-accesorios-aves" class="a">Accesorios Aves</a>
        <a href="#parte-accesorios-reptiles" class="a">Accesorios Reptiles</a>
        <a href="#parte-accesorios-peces" class="a">Accesorios Peces</a>
    </div>

    <div id="compare-button" class="compare-button div">
        <button onclick="compareCards()" class="button">Comparar</button>
    </div>
    

    <?php
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

    // Consultas para obtener los juguetes y accesorios
    $sqlPerros = "SELECT palabraImg, tipoJuguete, descripcion, precio, urgente FROM accesoriosPerros";
    $sqlGatos = "SELECT palabraImg, tipoJuguete, descripcion, precio, urgente FROM accesoriosGatos";
    $sqlRoedores = "SELECT palabraImg, tipoJuguete, descripcion, precio, urgente FROM accesoriosRoedores";
    $sqlAves = "SELECT palabraImg, tipoJuguete, descripcion, precio, urgente FROM accesoriosAves";
    $sqlReptiles = "SELECT palabraImg, tipoJuguete, descripcion, precio, urgente FROM accesoriosReptiles";
    $sqlPeces = "SELECT palabraImg, tipoJuguete, descripcion, precio, urgente FROM accesoriosPeces";

    $resultPerros = $conn->query($sqlPerros);
    $resultGatos = $conn->query($sqlGatos);
    $resultRoedores = $conn->query($sqlRoedores);
    $resultAves = $conn->query($sqlAves);
    $resultReptiles = $conn->query($sqlReptiles);
    $resultPeces = $conn->query($sqlPeces);
    ?>

<div class="titulo-comparador div">
    <h2 id="parte-accesorios-perros h2">Accesorios para Perros</h2>
</div>
<div class="cards-container div">
<?php
if ($resultPerros->num_rows > 0) {
    while($row = $resultPerros->fetch_assoc()) {
        echo '<div class="card div" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"> <img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<button class="button" onclick="donateCard(event, \'' . $row["palabraImg"] . '\')">Donar</button>';
        echo '</div>';
    }
} else {
    echo "0 resultados";
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-gatos" class="h2">Accesorios para Gatos</h2></div>
<div class="cards-container div">
<?php
if ($resultGatos->num_rows > 0) {
    while($row = $resultGatos->fetch_assoc()) {
        echo '<div class="card div" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo "0 resultados";
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-roedores" class="h2">Accesorios para Roedores</h2></div>
<div class="cards-container div">
<?php
if ($resultRoedores->num_rows > 0) {
    while($row = $resultRoedores->fetch_assoc()) {
        echo '<div class="card div" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo "0 resultados";
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-aves" class="h2">Accesorios para Aves</h2></div>
<div class="cards-container div">
<?php
if ($resultAves->num_rows > 0) {
    while($row = $resultAves->fetch_assoc()) {
        echo '<div class="card div" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo "0 resultados";
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-reptiles" class="h2">Accesorios para Reptiles</h2></div>
<div class="cards-container div">
<?php
if ($resultReptiles->num_rows > 0) {
    while($row = $resultReptiles->fetch_assoc()) {
        echo '<div class="card div" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo "0 resultados";
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-peces" class="h2">Accesorios para Peces</h2></div>
<div class="cards-container div">
<?php
if ($resultPeces->num_rows > 0) {
    while($row = $resultPeces->fetch_assoc()) {
        echo '<div class="card div" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo "0 resultados";
}
?>
</div>

    

    <div id="compare-container" class="compare-container div"></div>


    <div id="top-button" class="top-button div">
    <button onclick="scrollToTop()" id="top-button-btn" class="button ">Volver Arriba</button>
</div>
<div id="footer">
<?php
    include "includes/footer.php";
?>
</div>
</body>
</html>

<?php
$conn->close();
?>
