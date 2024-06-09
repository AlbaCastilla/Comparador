<?php
// Inicia la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['nombre'])) {
    // Redirigir si el nombre no está definido en la sesión
    header("Location: login.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link rel="stylesheet" href="css/reviews.css?v=<?php echo time(); ?>">
</head>
<body class="body">
<?php include "includes/navbar.php"; ?>
    <div class="form-container">
        <h2 class="h2">Enviar Comentario</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="li">
                <label class="label" for="comentario">Comentario:</label>
                <input class="input-text" type="text" id="comentario" name="comentario" required>
            </div>
            <div class="li">
                <label class="label" for="estrellas">Valoración:</label>
                <select class="select" id="estrellas" name="estrellas" required>
                    <option value="1">1 estrella</option>
                    <option value="2">2 estrellas</option>
                    <option value="3">3 estrellas</option>
                    <option value="4">4 estrellas</option>
                    <option value="5">5 estrellas</option>
                </select>
            </div>
            <label class="labelCheckbox">
                <input class="input" type="checkbox" name="incluirFoto" onchange="toggleFileInput()">
                <div class="textCheckbox">¿Quiere incluir una foto?</div>
            </label>
            <div id="fileInputContainer" class="fileInputContainer">
                <div class="li">
                    <label class="label" for="foto">Foto:</label>
                    <input class="input-file" type="file" id="foto" name="foto">
                </div>
            </div>
            <div class="submit-button-container">
                <input class="submit-button" type="submit" value="Enviar">
            </div>
        </form>

        <?php
        $conex = mysqli_connect("localhost", "root", "", "comparadorbd");

        if ($conex) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Procesa el formulario
                $comentario = $_POST["comentario"];
                $estrellas = $_POST["estrellas"];

                // Maneja la subida de imagen si el checkbox está marcado
                if (isset($_POST['incluirFoto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                    $imagen_nombre = $_FILES['foto']['name'];
                    $imagen_tmp = $_FILES['foto']['tmp_name'];
                    $imagen_ruta = "imgsReviews/" . $imagen_nombre; // Asegúrate de que el directorio existe
        
                    // Mueve la imagen a la carpeta deseada
                    if (!move_uploaded_file($imagen_tmp, $imagen_ruta)) {
                        echo "<div class='message'>Error al subir la imagen.</div>";
                    }
                } else {
                    $imagen_ruta = NULL;
                }


                // Inserta el comentario, la fecha y la ruta de la imagen en la base de datos
                $sql = "INSERT INTO comentarios (nombreUsuario, comentario, estrellas, rutaImagen,  fecha) VALUES ('$nombreUsuario', '$comentario', '$estrellas', '$imagen_ruta', CURRENT_TIMESTAMP)";
                if (mysqli_query($conex, $sql)) {
                    echo "<div class='message'>Comentario enviado correctamente.</div>";
                    // Redirige para evitar el reenvío del formulario
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                } else {
                    echo "<div class='message'>Error al enviar el comentario: " . mysqli_error($conex) . "</div>";
                }
            }
        }
        ?>
    </div>

    <!-- Aquí se mostrarán los comentarios -->
    <div class="comment-section">
        <?php
        $conex = mysqli_connect("localhost:3366", "root", "", "comparadorbd");

        if ($conex) {
            // Modifica la consulta SQL para ordenar los comentarios por fecha en orden descendente
            $sql_select = "SELECT * FROM comentarios ORDER BY fecha DESC";
            $result = mysqli_query($conex, $sql_select);

            // Verifica si hay resultados
            if (mysqli_num_rows($result) > 0) {
                // Muestra los comentarios uno por uno
                echo "<h2 class='h2 titulo-antes-comentarios'>Comentarios</h2>";
                echo "<div class='contenedorComentarios'>";
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    $class = ($count > 6) ? 'comments-container hidden' : 'comments-container';
                    echo "<div class='$class'>";
                    if (!empty($row['rutaImagen'])) {
                        echo "<div class='comment-image'><img src='" . $row['rutaImagen'] . "' ></div>";
                    }
                    echo "<div class='comment-text'>";
                    echo "<p class='moveLeft p'>" . date('d/m/Y', strtotime($row['fecha'])) . "</p>"; // Fecha
                    //echo "<p class='p'>" . date('H:i', strtotime($row['fecha'])) . "</p>"; // Hora q tmbn se puede introducir
                    echo "<p class='p'><strong>" . $row['nombreUsuario'] . "</strong></p>";
                    echo "<p class='p'>" . $row['comentario'] . "</p>";
                    echo "<p class='moveLeft p'><div class='estrella-container estrella-grande'>" . str_repeat('★', $row['estrellas']) . str_repeat('☆', 5 - $row['estrellas']) .  "</div></p>";
                    echo "</div>"; // Cierra comment-text
                    echo "</div>"; // Cierra comments-container
                }
                echo "</div>";
                if ($count > 6) {
                    echo "<button class='load-more' onclick='showAllComments()'>Mostrar más comentarios</button>";
                }
            } else {
                echo "<p class='p'>No hay comentarios aún.</p>";
            }
        }
        ?>
    </div>

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
        function toggleFileInput() {
            var checkbox = document.querySelector('input[name="incluirFoto"]');
            var fileInputContainer = document.getElementById('fileInputContainer');
            fileInputContainer.style.display = checkbox.checked ? 'block' : 'none';
        }

        function showAllComments() {
            var hiddenComments = document.querySelectorAll('.comments-container.hidden');
            hiddenComments.forEach(function(comment) {
                comment.classList.remove('hidden');
            });
            var loadMoreButton = document.querySelector('.load-more');
            loadMoreButton.style.display = 'none';
        }
    </script>
    <?php include "includes/footer.php"; ?>
</body>
</html>
