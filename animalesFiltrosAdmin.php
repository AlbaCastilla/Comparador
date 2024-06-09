    <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
    <!DOCTYPE html>
    <html class="html">
    <head class="head">
        <title class="title">Consulta de animales</title>
        <script class="script" src="js/emergenteAnimales.js"></script>
        <link class="link" rel="stylesheet" href="css/animalesFiltrosAdmin.css">
    </head>
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
     function eliminateCard(nombreAnimal) {
    event.stopPropagation();
    console.log("Nombre del animal seleccionado para eliminar:", nombreAnimal); // Agregar esta línea para verificar el nombre del animal
    if (nombreAnimal != undefined) {
        eliminateCardConnect(nombreAnimal);
    }
}

async function eliminateCardConnect(nombreAnimal) {
    console.log("llega a la función de consulta", nombreAnimal);
    const response1 = await fetch(`eliminarAnimal.php?NombreAnimal=${nombreAnimal}`);
    // Procesar la respuesta de la petición
}


document.addEventListener('DOMContentLoaded', function() {
    // Obtener todas las tarjetas de animales
    let tarjetasAnimales = document.querySelectorAll('.card');
    let lastSelectedCard = null;

    // Agregar un evento de clic a cada tarjeta de animal
    tarjetasAnimales.forEach(function(tarjeta) {
        tarjeta.addEventListener('click', function() {
            // Obtener el nombre del animal de la tarjeta seleccionada
            let nombreAnimal = tarjeta.getAttribute('data-nombre');

            // Imprimir el nombre del animal en la consola
            console.log("Nombre del animal seleccionado: " + nombreAnimal);

            // Si se hace clic en la misma tarjeta, se quita la clase 'selected' y se oculta el formulario
            if (lastSelectedCard === tarjeta) {
                tarjeta.classList.remove('selected');
                lastSelectedCard = null;
                document.getElementById('form-container2').style.display = 'none';
            } else {
                // Ocultar el formulario 2 (supongo que lo estás mostrando aquí)
                var formContainer2 = document.getElementById('form-container2');
                formContainer2.style.display = 'block';
                sacarAnimal(nombreAnimal);

                // Remover la clase 'selected' de todas las tarjetas
                tarjetasAnimales.forEach(function(tarjeta) {
                    tarjeta.classList.remove('selected');
                });

                // Agregar la clase 'selected' a la tarjeta seleccionada
                tarjeta.classList.add('selected');
                lastSelectedCard = tarjeta;
            }
        });

        // Agregar evento de eliminación al botón de eliminación en cada tarjeta
        let deleteButton = tarjeta.querySelector('.deleteButton');
        deleteButton.addEventListener('click', function(event) {
            eliminateCard(nombreAnimal);
        });
    });
    document.getElementById('button-izquierdo-inferior').addEventListener('click', function() {
        var formContainer2 = document.getElementById('form-container2');
        formContainer2.style.display = 'block';
        formContainer2.scrollIntoView({ behavior: 'smooth' });
    });
    document.getElementById('button-derecho-inferior').addEventListener('click', function() {
        var formContainer2 = document.getElementById('form-container');
        formContainer2.style.display = 'block';
        formContainer2.scrollIntoView({ behavior: 'smooth' });
    });
});


async function sacarAnimal(nombreAnimal) {
    console.log(nombreAnimal);
    const response = await fetch(`get_animal_data.php?NombreAnimal=${nombreAnimal}`);
    const data = await response.json();

    console.log(data);
    showData(data);
}
function showData(data){
document.getElementById("nombre2").value = data.NombreAnimal;
document.getElementById("edad2").value = data.Edad;
document.getElementById("tamanio2").value = data.Tamanio;
document.getElementById("peso2").value = data.Peso;
document.getElementById("descripcion2").value = data.Descripcion;
document.getElementById("raza2").value = data.Raza;
document.getElementById("genero2").value = data.Genero;
document.getElementById("dimension2").value = data.Dimension;
document.getElementById("etapa2").value = data.Etapa;

}
        function mostrarFormulario() {
                var formContainer = document.getElementById('form-container');
                formContainer.style.display = 'block';
            }

        

         /*   function mostrarFormularioModificar(tarjeta) {
    // Obtener los datos del animal seleccionado desde la tarjeta
    let datosAnimal = {
        nombre: tarjeta.querySelector('.h4').textContent,
        edad: tarjeta.getAttribute('data-edad'),
        dimension: tarjeta.getAttribute('data-dimension'),
        etapa: tarjeta.getAttribute('data-etapa'),
        peso: tarjeta.getAttribute('data-peso'),
        raza: tarjeta.getAttribute('data-raza'),
        genero: tarjeta.getAttribute('data-genero'),
        descripcion: tarjeta.getAttribute('data-descripcion')
    };

    // Crear el formulario dinámicamente
    let formulario = document.createElement('form');
    formulario.setAttribute('method', 'POST');
    formulario.setAttribute('action', 'actualizar_animal.php'); // Ajusta la URL de acción según tu configuración
    formulario.classList.add('form');

    // Crear los campos del formulario y agregar los datos del animal
    for (let key in datosAnimal) {
        let label = document.createElement('label');
        label.textContent = key.charAt(0).toUpperCase() + key.slice(1); // Convertir la primera letra en mayúscula
        label.setAttribute('for', key);
        
        let input = document.createElement('input');
        input.setAttribute('type', 'text'); // Puedes ajustar el tipo según el tipo de dato
        input.setAttribute('id', key);
        input.setAttribute('name', key);
        input.setAttribute('value', datosAnimal[key]);

        // Agregar el campo al formulario
        formulario.appendChild(label);
        formulario.appendChild(input);
    }

    // Crear y agregar el botón de enviar
    let submitButton = document.createElement('button');
    submitButton.setAttribute('type', 'submit');
    submitButton.textContent = 'Guardar';
    formulario.appendChild(submitButton);

    // Agregar el formulario al DOM
    document.body.appendChild(formulario);
}




    // Agregar un evento de clic a cada tarjeta de animal
    tarjetasAnimales.forEach(function(tarjeta) {
        tarjeta.addEventListener('click', function() {
            // Obtener el nombre del animal de la tarjeta seleccionada
            let nombreAnimal = tarjeta.getAttribute('data-nombre-animal');
            
            // Obtener la tabla del animal de la tarjeta seleccionada
            let tablaAnimal = tarjeta.getAttribute('data-tabla-animal');

            // Mostrar el nombre del animal seleccionado y su tabla en la consola
            console.log("Nombre del animal seleccionado: " + nombreAnimal);
            console.log("Tabla del animal seleccionado: " + tablaAnimal);
        });
    });*/

    </script>

    <?php
    include "includes/navbar.php";
    ?>
    <body class="body">

    <div class="tituloFiltros div">
        <h2 class="h2">FILTROS DE BUSQUEDA</h2>
    </div>
    <button class='button-izquierdo-inferior' id="button-izquierdo-inferior" href="#form-container2">Modificar</button>

    <button class="button-derecho-inferior" id="button-derecho-inferior">Añadir Animal</button>

    <input type="hidden" id="nombreAnimalSeleccionado">

    <form class="form" method="POST" action="">
        <div class="contenedorSelect div">

            <label class="label" for="animales">ANIMALES:</label>
            <select class="select" id="animales" name="animal">
                <option class="option" value="">--Seleccione una opcion--</option>
                <option class="option" value="todos">TODOS</option>
                <option class="option" value="perros">Perros</option>
                <option class="option" value="gatos">Gatos</option>
                <option class="option" value="roedores">Roedores</option>
                <option class="option" value="reptiles">Reptiles</option>
                <option class="option" value="peces">Peces</option>
                <option class="option" value="aves">Aves</option>
            </select>

            <label class="label" for="genero">GÉNERO:</label>
            <select class="select" id="genero" name="genero">
                <option class="option" value="">--Seleccione una opcion--</option>
                <option class="option" value="macho">Macho</option>
                <option class="option" value="hembra">Hembra</option>
            </select>

            <label class="label" for="dimension">TAMAÑO:</label>
            <select class="select" id="dimension" name="dimension">
                <option class="option" value="">--Seleccione una opcion--</option>
                <option class="option" value="pequeño">Pequeño</option>
                <option class="option" value="mediano">Mediano</option>
                <option class="option" value="grande">Grande</option>
            </select>

            <label class="label" for="etapa">ETAPA:</label>
            <select class="select" id="etapa" name="etapa">
                <option class="option" value="">--Seleccione una opcion--</option>
                <option class="option" value="cachorro">Cachorro</option>
                <option class="option" value="joven">Joven</option>
                <option class="option" value="adulto">Adulto</option>
                <option class="option" value="mayor">Mayor</option>
            </select>

            <input class="input" type="submit" value="Mostrar" id="btnconsultar">

        </div>
    </form>*/

    <div class="contenedorTarjetasAnimales div">
        <?php
        //CONEXION A LA BASE DE DATOS
        $host = "localhost";
        $user = "root";
        $password = "";
        $baseDatos = "comparadorbd"; // base de datos buena
        $puerto = 3306;

        $conexion = mysqli_connect($host, $user, $password, $baseDatos, $puerto);

        //definimos las tablas creadas para cada animal en una ESTRUCTURA -> array
        $tablas = ["perros", "gatos", "roedores", "reptiles", "peces", "aves"]; //esto en ningun momento lo estoy utilizando, pero lo dejo para tenerlo de referencia, y por si acaso en algun momento nos hace falta utilizarlo


        //comprobacion de conexion a la bd
        if ($conexion){

            if ($_SERVER['REQUEST_METHOD'] == "POST") { //comprobamos que la solicitud de datos que se sacarán de la base de datos se realicen mediante el método post

                $animal = $_POST["animal"]; //cogemos el valor que ha elegido el usuario del campo animal
                $genero = $_POST["genero"]; //cogemos el valor del genero elegido por el usuario
                $dimension = $_POST["dimension"]; //valor de la dimension por el usuario
                $etapa = $_POST["etapa"]; //valor de la etapa elegida por el usuario

                $tablasAnimales = array();//en la variable tablasAnimales, estamos guardando las tablas de la base de datos en un array vacio

                $result = $conexion->query("SHOW TABLES"); //obtenemos todas las TABLAS de la base de datos,
                // es decir -> este objeto contiene todos los resultados dados por el mysqli_result
                while ($row = $result->fetch_array()) {//la variable row -> son las filas devueltas por la consulta
                    $tablasAnimales[] = $row[0];//los resultados obtenidos de la base de datos los guardamos en el array tablasAnimales
                }


                // Comprobamos que el valor que haya escogido el usuario ($animal) esté en la variable $tablasAnimales
                if ($animal == "todos") {
                    foreach ($tablas as $animal) {
                        $sql = "SELECT * FROM $animal WHERE 1";
                        if (!empty($genero)) {
                            $sql .= " AND Genero = '" . $genero . "'";
                        }
                        if (!empty($dimension)) {
                            $sql .= " AND Dimension = '" . $dimension . "'";
                        }
                        if (!empty($etapa)) {
                            $sql .= " AND Etapa = '" . $etapa . "'";
                        }

                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<h2 class='tituloTipoAnimal h2'>$animal</h2>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='card div'>
                                    <h4 class='h4'>" . $row["NombreAnimal"] . "</h4>
                                    <button class='deleteButton' onclick='eliminateCard()'><i class='fa-solid fa-trash'></i></button>
                                    <p class='p'><img class='img' id='card-imgAnimales' src= imgsAnimales/" . $row["NombreAnimal"] . ".jpg </p>
                                    
                                    <button class='masInfo button'
                                        data-nombre='" . $row["NombreAnimal"] . "' 
                                        data-img='imgsAnimales/" . $row["NombreAnimal"] . ".jpg
    ' 
                                        data-edad='" . $row["Edad"] . "' 
                                        data-dimension='" . $row["Dimension"] . "' 
                                        data-etapa='" . $row["Etapa"] . "' 
                                        data-peso='" . $row["Peso"] . "' 
                                        data-raza='" . $row["Raza"] . "' 
                                        data-genero='" . $row["Genero"] . "'
                                        data-descripcion='" . $row["Descripcion"] . "'
                                    >Más Info</button>                                
                                </div>";
                            }
                        }
                    }
                } else if (in_array($animal, $tablasAnimales)) {

                    //CONSULTA SQL con los filtros seleccionados, para ver cual esta seleccionado y cual no y q funcione de igual manera
                    $sql = "SELECT * FROM " . $animal . " WHERE 1";
                    if (!empty($genero)) {
                        $sql .= " AND Genero = '" . $genero . "'";
                    }
                    if (!empty($dimension)) {
                        $sql .= " AND Dimension = '" . $dimension . "'";
                    }
                    if (!empty($etapa)) {
                        $sql .= " AND Etapa = '" . $etapa . "'";
                    }

                    // Guardamos en una variable el resultado de la consulta con la base de datos
                    $resultadoConsulta = $conexion->query($sql);

                    if ($resultadoConsulta->num_rows > 0) {
                        echo "<h2 class='tituloTipoAnimal h2'>$animal</h2>";
                        while ($row = $resultadoConsulta->fetch_assoc()) {
                            echo "<div class='card div'>
                            <button class='deleteButton' onclick='eliminateCard()'><i class='fa-solid fa-trash'></i></button>
                                <h4 class='h4'>" . $row["NombreAnimal"] . "</h4>
                                <p class='p'><img class='img' id='card-imgAnimales' src= imgsAnimales/" . $row["NombreAnimal"] . ".jpg </p>
                                
                                <!--Con el btn de mostrar mas informacion le pasamos todos los datos para que se muestren una vez q el usuario le de al boton-->
                                <button class='masInfo button'
                                            data-nombre='" . $row["NombreAnimal"] . "' 
                                            data-img='imgsAnimales/" . $row["NombreAnimal"] . ".jpg' 
                                            data-edad='" . $row["Edad"] . "' 
                                            data-dimension='" . $row["Dimension"] . "' 
                                            data-etapa='" . $row["Etapa"] . "' 
                                            data-peso='" . $row["Peso"] . "' 
                                            data-raza='" . $row["Raza"] . "' 
                                            data-genero='" . $row["Genero"] . "'
                                            data-descripcion='" . $row["Descripcion"] . "'
                                >Más Info</button>                                     
                    </div>";
                        }


                    }else{
                        echo "No hay resultados para la selección";
                    }
                }


                //A PARTIR DE AQUI ES EL CODIGO PARA QUE APAREZCAN TODOS LOS ANIMALES
            }else {
                //si no se ha enviado el formulario (metodo post) q nos parezcan todos los animales
                foreach ($tablas as $animal) {
                    $sql = "SELECT * FROM $animal";
                    $result = $conexion->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2 class='tituloTipoAnimal h2'>$animal</h2>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card div' data-nombre='" . $row["NombreAnimal"] . "'>"; // Agregamos el atributo data-nombre aquí
                            echo "<button class='deleteButton' onclick='eliminateCard()'><i class='fa-solid fa-trash'></i></button>";
                            echo "<h4 class='h4'>" . $row["NombreAnimal"] . "</h4>";
                            echo "<p class='p'><img class='img' id='card-imgAnimales' src='imgsAnimales/" . $row["NombreAnimal"] . ".jpg'></p>";
                            echo "<button class='masInfo button'
                                        data-nombre='" . $row["NombreAnimal"] . "' 
                                        data-img='imgsAnimales/" . $row["NombreAnimal"] . ".jpg' 
                                        data-edad='" . $row["Edad"] . "' 
                                        data-dimension='" . $row["Dimension"] . "' 
                                        data-etapa='" . $row["Etapa"] . "' 
                                        data-peso='" . $row["Peso"] . "' 
                                        data-raza='" . $row["Raza"] . "' 
                                        data-genero='" . $row["Genero"] . "'
                                        data-descripcion='" . $row["Descripcion"] . "'
                                    >Más Info</button>";
                            echo "</div>";
                        }
                    }
                    
    else {
                        echo "no hay animales en nuestra base de datos q coincidan con $animal";
                    }
                }
            }
        }

        //cerramos la conexion con la base de datos en mysql
        $conexion -> close();
        ?>
    </div>

    <!--VENTANA EMERGENTE-->
    <div class="fondoEnsombrecido div" id="fondoEnsombrecido">

        <div class="ventanaEmergente div" id="ventanaEmergente">

            <div class="contenedor div">

                <div class="btnCerrar div" id="btnCerrar">
                    <span class="span" id="btnCerrarEmergente">&times;</span>
                </div>

                <div class="columna1-info div">
                    <h2 class="h2" id="tituloNombreEmergente"></h2>
                    <p class="p" id="descriptionEmergente"></p>
                    <p class="p"><strong>EDAD:</strong> <span class="span" id="edadEmergente"></span> años</p>
                    <p class="p"><strong>RAZA:</strong> <span class="span" id="razaEmergente"></span></p>
                    <p class="p"><strong>GÉNERO:</strong> <span class="span" id="generoEmergente"></span></p>
                    <p class="p"><strong>TAMAÑO:</strong> <span class="span" id="dimensionEmergente"></span></p>
                    <p class="p"><strong>ETAPA:</strong> <span class="span" id="etapaEmergente"></span></p>
                    <p class="peso p"><strong>Peso:</strong> <span class="span" id="pesoEmergente"></span> g</p>
                    <p class="p"><strong>DESCRIPCIÓN:</strong> <span class="span" id="descripcionEmergente"></span></p>
                </div>

                <div class="columna2-foto div">
                    <img class="img" id="imgAnimalEmergente" src="" alt="Animal Image" />
                </div>
            </div>
        </div>
    </div>
    <div id="form-container" class="form-container">
            <form id="animal-form"  action="add_Animal.php" method="post" enctype="multipart/form-data" class="form">
                <label for="tabla">Selecciona la tabla:</label>
                <select id="tabla" name="tabla" required>
                    <option value="gatos">Gatos</option>
                    <option value="perros">Perros</option>
                    <option value="roedores">Roedores</option>
                    <option value="aves">Aves</option>
                    <option value="reptiles">Reptiles</option>
                    <option value="peces">Peces</option>
                </select><br><br>

                <label for="nombre">Nombre del Animal:</label>
                <input type="text" id="nombre" name="NombreAnimal" required><br><br>

                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="Edad"><br><br>

                <label for="tamanio">Tamaño:</label>
                <input type="number" id="tamanio" name="tamanio"><br><br>

                <label for="peso">Peso:</label>
                <input type="number" id="peso" name="Peso"><br><br>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="Descripcion"></textarea><br><br>

                <label for="raza">Raza:</label>
                <input type="text" id="raza" name="Raza"><br><br>

                <label for="genero">Género:</label>
                <input type="text" id="genero" name="Genero"><br><br>

                <label for="dimension">Dimensión:</label>
                <input type="text" id="dimension" name="Dimension" maxlength="8"><br><br>

                <label for="etapa">Etapa:</label>
                <input type="text" id="etapa" name="Etapa" maxlength="20"><br><br>

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="Imagen" accept="image/*"><br><br>


                <button type="submit">Guardar</button>
            </form>
        </div>


        <div id="form-container2" class="form-container2">
    <form id="animal-form2" action="modify_Animal.php" method="post" class="form2">
        <label for="nombre2">Nombre del Animal:</label>
        <input type="text" id="nombre2" name="NombreAnimal2" required><br><br>

        <label for="edad2">Edad:</label>
        <input type="text" id="edad2" name="Edad2"><br><br>

        <label for="tamanio2">Tamaño:</label>
        <input type="text" id="tamanio2" name="Tamanio2"><br><br>

        <label for="peso2">Peso:</label>
        <input type="text" id="peso2" name="Peso2"><br><br>

        <label for="descripcion2">Descripción:</label>
        <textarea id="descripcion2" name="Descripcion2"></textarea><br><br>

        <label for="raza2">Raza:</label>
        <input type="text" id="raza2" name="Raza2"><br><br>

        <label for="genero2">Género:</label>
        <input type="text" id="genero2" name="Genero2"><br><br>

        <label for="dimension2">Dimensión:</label>
        <input type="text" id="dimension2" name="Dimension2" maxlength="8"><br><br>

        <label for="etapa2">Etapa:</label>
        <input type="text" id="etapa2" name="Etapa2" maxlength="20"><br><br>

        <button type="submit">Guardar</button>
    </form>
</div>

    <div class="footer div">
        <?php
        include "includes/footer.php";
        ?>
    </div>
    </body>
    </html>