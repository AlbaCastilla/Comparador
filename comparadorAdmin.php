
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
    <link rel="stylesheet" href="css/comparadorAdmin.css?v=<?php echo time(); ?>">
    
    <script src="https://kit.fontawesome.com/07ca607712.js" crossorigin="anonymous"></script>
    <script>

window.onscroll = scrollFunction;
function scrollFunction() {
    const topButton = document.getElementById('top-button');
    const topButtonBtn = document.getElementById('top-button-btn');
    const footer = document.getElementById('footer');
    const modifAccesorioButtonBtn = document.getElementById('modificar-accesorio-btn');
    const addAccesorioButtonBtn = document.getElementById('add-accesorio-btn');
    
    // Mostrar/ocultar el botón de "Volver Arriba"
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block";
    } else {
        topButton.style.display = "none";
    }

    // Obtener la posición del pie de página
    const footerRect = footer.getBoundingClientRect();
    const footerVisible = footerRect.top < window.innerHeight && footerRect.bottom >= 0;

    if (footerVisible) {
        if (modifAccesorioButtonBtn && addAccesorioButtonBtn) {
            modifAccesorioButtonBtn.style.display = "none";
            addAccesorioButtonBtn.style.display = "none";
        }
        topButtonBtn.style.backgroundColor = "white";
        topButtonBtn.style.color = "black";
    } else {
        if (modifAccesorioButtonBtn && addAccesorioButtonBtn) {
            modifAccesorioButtonBtn.style.display = "block";
            addAccesorioButtonBtn.style.display = "block";
        }
        topButtonBtn.style.backgroundColor = "#5B8869"; 
        topButtonBtn.style.color = "white";
    }

    // Asegurarse de que la decoración del texto se mantiene sin subrayado
    topButtonBtn.style.textDecoration = "none";
    if (modifAccesorioButtonBtn) {
        modifAccesorioButtonBtn.style.textDecoration = "none";
    }
    if (addAccesorioButtonBtn) {
        addAccesorioButtonBtn.style.textDecoration = "none";
    }
}



    function addAccessorioAnimal() {
            document.getElementById('formularioAccesorio').style.display = 'block';
        }

    function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

/*function donateCard(card, palabraImg){
    event.stopPropagation();
    console.log("PalabraImg seleccionada para donar:", palabraImg); // Agregar esta línea para verificar palabraImg
    if(palabraImg!=undefined){
    //eliminateCardConnect(palabraImg);}
    donateCardConnect(palabraImg);
}}*/

function eliminateCard(card, palabraImg){
    event.stopPropagation();
    console.log("PalabraImg seleccionada para eliminar:", palabraImg); // Agregar esta línea para verificar palabraImg
    if(palabraImg!=undefined){
    //eliminateCardConnect(palabraImg);}
    eliminateCardConnect(palabraImg);
    }
}
function toggleSelectCard(card, palabraImg) {
  
    console.log("PalabraImg seleccionada:", palabraImg); // Agregar esta línea para verificar palabraImg
    card.classList.toggle('selected');
    fetchCardDetails(palabraImg);
    document.getElementById('addAccesorio').style.display = 'none';
    document.getElementById('formularioAccesorio').style.display = 'none';
    document.getElementById('modificarAccesorio').style.display = 'block';
    document.getElementById('formularioAccesorioModificar').style.display = 'block';
    
}

/*async function donateCardConnect(palabraImg){
    console.log("llega a la funcion de consulta", palabraImg);
  const response2 = await fetch(`processDonar.php?palabraImg=${palabraImg}`);
}*/

async function eliminateCardConnect(palabraImg){
    //console.log("llega a la funcion de consulta", $palabraImg);
    //const response1 = await fetch(`eliminarAccesorio.php?palabraImg=${palabraImg}`);
    console.log("llega a la funcion de consulta", palabraImg);
  const response1 = await fetch(`eliminarAccesorio.php?palabraImg=${palabraImg}`);
  // Procesar la respuesta de la petición
  

}




async function fetchCardDetails(palabraImg) {

    const response = await fetch(`modify_accesorio.php?palabraImg=${palabraImg}`);
        const data = await response.json();
        
        modifyAccessorio(data);
    }

    function modifyAccessorio(data){
        console.log("a continuacion se mostraran los daros")
        console.log(data);
            
        document.getElementById("tipoJugueteModificar").value = data.tipoJuguete;
        document.getElementById("materialModificar").value = data.material;
        document.getElementById("tamanioModificar").value = data.tamanio;
        document.getElementById("colorModificar").value = data.color;
        document.getElementById("descripcionModificar").value = data.descripcion;
        document.getElementById("instruccionesModificar").value = data.instrucciones;
        //document.getElementById("palabraImgModificar").value = data.palabraImg;
        //document.getElementById("imagen").value = data.imagen;
        /*if(data.imagen) {
            const currentImage = document.getElementById("currentImage");
            currentImage.src = data.imagen;
            currentImage.style.display = 'block';
        } else {
            document.getElementById("currentImage").style.display = 'none';
        }*/
        document.getElementById("durabilidadModificar").value = data.durabilidad;
        document.getElementById("reviewsModificar").value = data.reviews;
        document.getElementById("precioModificar").value = data.precio;
        document.getElementById("durabilidadGraficoModificar").value = data.durabilidadGrafico;
        document.getElementById("impactoAmbientalGraficoModificar").value = data.impactoAmbientalGrafico;
        document.getElementById("facilidadLimpiezaGraficoModificar").value = data.facilidadLimpiezaGrafico;
        document.getElementById("estiloGraficoModificar").value = data.estiloGrafico;
        document.getElementById("reviewsGraficoModificar").value = data.reviewsGrafico;
        document.getElementById("numComentariosModificar").value = data.numComentarios;
        document.getElementById("urgenteModificar").value = data.urgente;
    }

function closeForm() {
    document.getElementById('formularioAccesorio').style.display = 'none';
    document.getElementById('formularioAccesorioModificar').style.display = 'none';
    document.getElementById('modificarAccesorio').style.display = 'none';
    document.getElementById('addAccesorio').style.display = 'block';
    var cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
        card.classList.remove('selected');
    });
}

    </script>
</head>
<body class="body">
<?php
    include "includes/navbar.php";
?>
    <h1 class="h1 titulo-principal-comparador-admin">Accesorios de Mascotas</h1>
    <div id="botones-accesorios" class="div">
        <a href="#parte-accesorios-perros" class="a">Accesorios Perros</a>
        <a href="#parte-accesorios-gatos" class="a">Accesorios Gatos</a>
        <a href="#parte-accesorios-roedores" class="a">Accesorios Roedores</a>
        <a href="#parte-accesorios-aves" class="a">Accesorios Aves</a>
        <a href="#parte-accesorios-reptiles" class="a">Accesorios Reptiles</a>
        <a href="#parte-accesorios-peces" class="a">Accesorios Peces</a>
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

<div class="titulo-comparador div"><h2 id="parte-accesorios-perros" class="h2">Accesorios para Perros</h2></div>
<div class="cards-container div">
<?php
if ($resultPerros->num_rows > 0) {
    while($row = $resultPerros->fetch_assoc()) {
        $cardClass = ($row["urgente"] == 0) ? 'card no-urgente' : 'card';
            
        // Imprimir el div de la tarjeta con la clase correspondiente
        echo '<div class="div ' . $cardClass . '" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<button id="boton-eliminar-accesorio"  onclick="eliminateCard(this, \'' . $row["palabraImg"] . '\')"';
        echo '<i class="fa-solid fa-trash"></i>';
        echo '</button>';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="donar.php" class="a"><button class="button" onclick="donateCard(this, \'' . $row["palabraImg"] . '\')">';
        echo 'Donar</button></a>';
        echo '</div>';
    }
} else {
    echo '<p class="p">Actualmente no tenemos demanda de ningun accesorio para perros</p>';
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-gatos" class="h2">Accesorios para Gatos</h2></div>
<div class="cards-container div">
<?php
if ($resultGatos->num_rows > 0) {
    while($row = $resultGatos->fetch_assoc()) {
        $cardClass = ($row["urgente"] == 0) ? 'card no-urgente' : 'card';
            
        // Imprimir el div de la tarjeta con la clase correspondiente
        echo '<div class="div ' . $cardClass . '" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<button id="boton-eliminar-accesorio"  onclick="eliminateCard()"';
        echo '<i class="fa-solid fa-trash"></i>';
        echo '</button>';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo '<p class="p">Actualmente no tenemos demanda de ningun accesorio para gatos</p>';
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-roedores" class="h2">Accesorios para Roedores</h2></div>
<div class="cards-container div">
<?php
if ($resultRoedores->num_rows > 0) {
    while($row = $resultRoedores->fetch_assoc()) {
        // Agregar la clase "no-urgente" si es necesario
        $cardClass = ($row["urgente"] == 0) ? 'card no-urgente' : 'card';
        
        // Imprimir el div de la tarjeta con la clase correspondiente
        echo '<div class="' . $cardClass . '" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<button id="boton-eliminar-accesorio"  onclick="eliminateCard()"';
        echo '<i class="fa-solid fa-trash"></i>';
        echo '</button>';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo '<p class="p">Actualmente no tenemos demanda de ningun accesorio para roedores</p>';
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-aves" class="h2">Accesorios para Aves</h2></div>
<div class="cards-container div">
<?php
if ($resultAves->num_rows > 0) {
    while($row = $resultAves->fetch_assoc()) {
        $cardClass = ($row["urgente"] == 0) ? 'card no-urgente' : 'card';
        
        // Imprimir el div de la tarjeta con la clase correspondiente
        echo '<div class="' . $cardClass . '" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<button id="boton-eliminar-accesorio"  onclick="eliminateCard()"';
        echo '<i class="fa-solid fa-trash"></i>';
        echo '</button>';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo '<p class="p">Actualmente no tenemos demanda de ningun accesorio para aves</p>';
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-reptiles" class="h2">Accesorios para Reptiles</h2></div>
<div class="cards-container div">
<?php
if ($resultReptiles->num_rows > 0) {
    while($row = $resultReptiles->fetch_assoc()) {
        $cardClass = ($row["urgente"] == 0) ? 'card no-urgente' : 'card';
        
        // Imprimir el div de la tarjeta con la clase correspondiente
        echo '<div class="' . $cardClass . '" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<button id="boton-eliminar-accesorio"  onclick="eliminateCard()"';
        echo '<i class="fa-solid fa-trash"></i>';
        echo '</button>';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo '<p class="p">Actualmente no tenemos demanda de ningun accesorio para reptiles</p>';
}
?>
</div>

<div class="titulo-comparador div"><h2 id="parte-accesorios-peces" class="h2">Accesorios para Peces</h2></div>
<div class="cards-container div cards-peces">
<?php
if ($resultPeces->num_rows > 0) {
    while($row = $resultPeces->fetch_assoc()) {
        $cardClass = ($row["urgente"] == 0) ? 'card no-urgente' : 'card';
        
        // Imprimir el div de la tarjeta con la clase correspondiente
        echo '<div class="' . $cardClass . '" onclick="toggleSelectCard(this, \'' . $row["palabraImg"] . '\')">';
        echo '<button id="boton-eliminar-accesorio"  onclick="eliminateCard()"';
        echo '<i class="fa-solid fa-trash"></i>';
        echo '</button>';
        echo '<h2 class="h2">' . $row["tipoJuguete"] . '</h2>';
        echo '<div class="caja-imagenes-comparador div"><img src="imgsComparador/' . $row["palabraImg"] . '.jpg" alt="' . $row["tipoJuguete"] . '" class="img"></div>';
        echo '<p class="p">' . $row["descripcion"] . '</p>';
        echo '<p class="p">Precio: ' . $row["precio"] . ' €</p>';
        echo '<a href="comparador.php" class="a"><button class="button">Donar</button></a>';
        echo '</div>';
    }
} else {
    echo '<p class="p">Actualmente no tenemos demanda de ningun accesorio para peces</p>';
}
?>
</div>

    
    </div>

    <div id="addAccesorio" class="addAccesorio div">
    <a class="a" href="#formularioAccesorio">
        <button class="button" id="add-accesorio-btn" onclick="addAccessorioAnimal()">Añadir accesorio nuevo</button>
    </a>
</div>

<div class="div" id="modificarAccesorio" style="display:none;">
    <a class="a" href="#formularioAccesorioModificar">
        <button class="button" id="modificar-accesorio-btn">Modificar accesorio</button>
    </a>
</div>

<div id="formularioAccesorio" style="display:none;" class="div">
    <form id="formAccesorio" action="add_accesorio.php" method="post" enctype="multipart/form-data" class="form">
        <label for="tabla" class="label">Seleccionar Tabla:</label><br>
        <select id="tabla" name="tabla" required class="select">
            <option value="accesoriosAves">Accesorios Aves</option>
            <option value="accesoriosGatos">Accesorios Gatos</option>
            <option value="accesoriosPerros">Accesorios Perros</option>
            <option value="accesoriosReptiles">Accesorios Reptiles</option>
            <option value="accesoriosRoedores">Accesorios Roedores</option>
            <option value="accesoriosPeces">Accesorios Peces</option>
        </select><br>
        <label for="tipoJuguete" class="label">Tipo de Juguete:</label><br>
        <input type="text" id="tipoJuguete" name="tipoJuguete" required class="input"><br>
        <label for="material" class="label">Material:</label><br>
        <input type="text" id="material" name="material" required class="input"><br>
        <label for="tamanio" class="label">Tamaño:</label><br>
        <input type="text" id="tamanio" name="tamanio" required class="input"><br>
        <label for="color" class="label">Color:</label><br>
        <input type="text" id="color" name="color" required class="input"><br>
        <label for="descripcion" class="label">Descripción:</label><br>
        <input type="text" id="descripcion" name="descripcion" required class="input"><br>
        <label for="instrucciones" class="label">Instrucciones:</label><br>
        <input type="text" id="instrucciones" name="instrucciones" required class="input"><br>
        <label for="palabraImg" class="label">Palabra para Imagen:</label><br>
        <input type="text" id="palabraImg" name="palabraImg" required class="input"><br>
        <label for="imagen" class="label">Imagen:</label><br>
        <input type="file" id="imagen" name="imagen" accept="image/*" required class="input"><br>
        <label for="durabilidad" class="label">Durabilidad:</label><br>
        <input type="number" step="0.1" id="durabilidad" name="durabilidad" required class="input"><br>
        <label for="reviews" class="label">Reviews:</label><br>
        <input type="number" step="0.1" id="reviews" name="reviews" required class="input"><br>
        <label for="precio" class="label">Precio:</label><br>
        <input type="number" step="0.1" id="precio" name="precio" required class="input"><br>
        <label for="durabilidadGrafico" class="label">Durabilidad (Gráfico):</label><br>
        <input type="number" id="durabilidadGrafico" name="durabilidadGrafico" required class="input"><br>
        <label for="impactoAmbientalGrafico" class="label">Impacto Ambiental (Gráfico):</label><br>
        <input type="number" id="impactoAmbientalGrafico" name="impactoAmbientalGrafico" required class="input"><br>
        <label for="facilidadLimpiezaGrafico" class="label">Facilidad de Limpieza (Gráfico):</label><br>
        <input type="number" id="facilidadLimpiezaGrafico" name="facilidadLimpiezaGrafico" required class="input"><br>
        <label for="estiloGrafico" class="label">Estilo (Gráfico):</label><br>
        <input type="number" id="estiloGrafico" name="estiloGrafico" required class="input"><br>
        <label for="reviewsGrafico" class="label">Reviews (Gráfico):</label><br>
        <input type="number" id="reviewsGrafico" name="reviewsGrafico" required class="input"><br>
        <label for="numComentarios" class="label">Número de Comentarios:</label><br>
        <input type="number" id="numComentarios" name="numComentarios" required class="input"><br>
        <label for="urgente" class="label">Urgente:</label><br>
        <input type="number" id="urgente" name="urgente" required class="input"><br>
        <input type="submit" value="Hecho" class="submit">
        <button type="button" onclick="closeForm()" class="button">Cerrar</button>
    </form>
</div>
<div id="formularioAccesorioModificar" class="formularioAccesorioModificar div " style="display:none;">
    <form id="formAccesorioModificar" class="formAccesorioModificar" action="modify_accesorio_sustituir.php" method="post" enctype="multipart/form-data">
        <label for="tipoJuguete" class="label">Tipo de Juguete:</label><br>
        <input type="text" id="tipoJugueteModificar" name="tipoJuguete" required class="input"><br>
        <label for="material" class="label">Material:</label><br>
        <input type="text" id="materialModificar" name="material" required class="input"><br>
        <label for="tamanio" class="label">Tamaño:</label><br>
        <input type="text" id="tamanioModificar" name="tamanio" required class="input"><br>
        <label for="color" class="label">Color:</label><br>
        <input type="text" id="colorModificar" name="color" required class="input"><br>
        <label for="descripcion" class="label">Descripción:</label><br>
        <input type="text" id="descripcionModificar" name="descripcion" required class="input"><br>
        <label for="instrucciones" class="label">Instrucciones:</label><br>
        <input type="text" id="instruccionesModificar" name="instrucciones" required class="input"><br>
        <!--<label for="palabraImg" class="label">Palabra para Imagen:</label><br>
        <input type="text" id="palabraImgModificar" name="palabraImg" required class="input"><br>
        <label for="imagen" class="label">Imagen:</label><br>
        <input type="file" id="imagen" name="imagen" accept="image/*" required class="input"><br>-->
        <label for="durabilidad" class="label">Durabilidad:</label><br>
        <input type="number" step="0.1" id="durabilidadModificar" name="durabilidad" required class="input"><br>
        <label for="reviews" class="label">Reviews:</label><br>
        <input type="number" step="0.1" id="reviewsModificar" name="reviews" required class="input"><br>
        <label for="precio" class="label">Precio:</label><br>
        <input type="number" step="0.01" id="precioModificar" name="precio" required class="input"><br>
        <label for="durabilidadGrafico" class="label">Durabilidad (Gráfico):</label><br>
        <input type="number" id="durabilidadGraficoModificar" name="durabilidadGrafico" required class="input"><br>
        <label for="impactoAmbientalGrafico" class="label">Impacto Ambiental (Gráfico):</label><br>
        <input type="number" id="impactoAmbientalGraficoModificar" name="impactoAmbientalGrafico" required class="input"><br>
        <label for="facilidadLimpiezaGrafico" class="label">Facilidad de Limpieza (Gráfico):</label><br>
        <input type="number" id="facilidadLimpiezaGraficoModificar" name="facilidadLimpiezaGrafico" required class="input"><br>
        <label for="estiloGrafico" class="label">Estilo (Gráfico):</label><br>
        <input type="number" id="estiloGraficoModificar" name="estiloGrafico" required class="input"><br>
        <label for="reviewsGrafico" class="label">Reviews (Gráfico):</label><br>
        <input type="number" id="reviewsGraficoModificar" name="reviewsGrafico" required class="input"><br>
        <label for="numComentarios" class="label">Número de Comentarios:</label><br>
        <input type="number" id="numComentariosModificar" name="numComentarios" required class="input"><br>
        <label for="urgente" class="label">Urgente:</label><br>
        <input type="number" id="urgenteModificar" name="urgente" required class="input"><br>
        <input type="submit" value="Hecho" class="submit">
        <button type="button" onclick="closeForm()" class="button">Cerrar</button>
    </form>
</div>


    
    <div id="top-button" class="top-button div">
    <button class="button" id="top-button-btn" onclick="scrollToTop()">Volver Arriba</button>
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

