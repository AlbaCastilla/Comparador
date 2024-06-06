<!DOCTYPE html>
<html class="html">
<head class="head">
    <title class="title">Consulta de animales</title>
    <script class="script" src="js/emergenteAnimales.js"></script>
    <link class="link" rel="stylesheet" href="css/animalesFiltros.css">
</head>
<?php
        include "includes/navbar.php";
    ?>
<body class="body">

<div class="tituloFiltros div">
    <h2 class="h2">FILTROS DE BUSQUEDA</h2>
</div>

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
</form>

<div class="contenedorTarjetasAnimales div">
    <?php
    //CONEXION A LA BASE DE DATOS
    $host = "localhost";
    $user = "root";
    $password = "";
    $baseDatos = "comparadorbd"; // base de datos buena
    $puerto = 3366;

    $conexion = mysqli_connect($host, $user, $password, $baseDatos, $puerto);

    //definimos las tablas creadas para cada animal en una ESTRUCTURA -> array
    $tablas = ["Perros", "Gatos", "Roedores", "Reptiles", "Peces", "Aves"]; //esto en ningun momento lo estoy utilizando, pero lo dejo para tenerlo de referencia, y por si acaso en algun momento nos hace falta utilizarlo


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
                                <p class='p'><img class='img' id='card-imgAnimales' src= imgsAnimales/" . $row["NombreAnimal"] . ".jpg </p>
                                
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
                        echo "<div class='card div'>
                                <h4 class='h4'>" . $row["NombreAnimal"] . "</h4>
                                <p class='p'><img class='img' id='card-imgAnimales' src= imgsAnimales/" . $row["NombreAnimal"] . ".jpg </p>
                                
                                                
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
                } else {
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
<div class="footer div">
<?php
        include "includes/footer.php";
    ?>
    </div>
</body>
</html>
