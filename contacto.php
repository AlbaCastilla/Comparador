<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>

    <link class="link" rel="stylesheet" href="css/testAnimales.css">
    <script class="script" src="js/testAnimal.js"></script>
    <script class="script" src="js/testCarrusel.js"></script>


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
    </script>
</head>
    <?php
        include "includes/navbar.php";
    ?>
<body class="body">

<section class="section">
    <div class="div grupo1">
        <img class="img huellaTitulo" src="imgsTEST/huella.png" alt="imagen">

        <div class="div titulo">
            <h2 class="h2 t-stroke t-shadow">DESCUBRE TU ANIMAL IDEAL</h2>
        </div>
        <br class="br">
    </div>

    <div class="div grupo2">
        <form class="form" name="descubreTuAnimal" id="descubreTuAnimal">

            <div class="div nombre">
                <!--NOMBRE-->
                <label class="label" for="name">1. Nombre</label> <br class="br">
                <input class="input" id="name" type="text" name="name"  placeholder="Introduce tu nombre" required>
                <br class="br">
            </div>


            <div class="div tamanio">
                <!--1ª PREGUNTA-->
                <p class="p"> 2. ¿Cuál es el tamaño ideal que debería tener tu mascota?</p>
                <input class="input" type="radio" name="tamanioMascota" value="pequeña" required>
                <label class="label" for="pequeña">Pequeña</label><br class="br">

                <input class="input" type="radio" name="tamanioMascota" value="mediana" required>
                <label class="label" for="mediana">Mediana</label><br class="br">

                <input class="input" type="radio" name="tamanioMascota" value="grande" required>
                <label class="label" for="grande">Grande</label>
                <br class="br">
            </div>



            <div class="div alergias">
                <!--2ª PREGUNTA-->
                <p class="p"> 3. ¿Tienes alergias a algún tipo de animal?</p>
                <input class="input" type="radio" name="alergias" value="no" required>
                <label class="label" for="no">No tengo alergias</label><br class="br">

                <input class="input" type="radio" name="alergias" value="siPerros" required>
                <label class="label" for="siPerros">Soy alérgico a los perros</label><br class="br">

                <input class="input" type="radio" name="alergias" value="siGatos" required>
                <label class="label" for="siGatos">Soy alérgico a los gatos </label><br class="br">
                <br class="br">
            </div>



            <div class="div tiempo">
                <!--3ª PREGUNTA-->
                <p class="p"> 4. ¿Cuánto tiempo puedes dedicarle diariamente a cuidar y jugar con tu mascota?</p>
                <input class="input" type="radio" name="tiempo" value="menosUnaHora" required>
                <label class="label" for="menosUnaHora">Menos de una hora</label><br class="br">

                <input class="input" type="radio" name="tiempo" value="unaYDos" required>
                <label class="label" for="unaYDos">Entre una y dos horas</label><br class="br">

                <input class="input" type="radio" name="tiempo" value="masDeDos" required>
                <label class="label" for="masDeDos">Más de dos horas</label><br class="br">
                <br class="br">
            </div>



            <div class="div espacio">
                <!--4ª PREGUNTA-->
                <p class="p"> 5. ¿Vives en un espacio amplio como una casa con jardín o en un apartamento pequeño?</p>
                <input class="input" type="radio" name="espacio" value="casaJardin" required>
                <label class="label" for="casaJardin">Casa con jardín</label><br class="br">

                <input class="input" type="radio" name="espacio" value="apartamentoPequenio" required>
                <label class="label" for="apartamentoPequenio">Apartamento pequeño</label><br class="br">

                <input class="input" type="radio" name="espacio" value="intermedio" required>
                <label class="label" for="intermedio">Espacio intermedio</label><br class="br">
                <br class="br">
            </div>



            <div class="div actividad">
                <!--5ª PREGUNTA-->
                <p class="p"> 6. ¿Sueles tener actividad física al aire libre?</p>
                <input class="input" type="radio" name="actividad" value="baja" required>
                <label class="label" for="baja">Con poca frecuencia</label><br class="br">

                <input class="input" type="radio" name="actividad" value="moderada" required>
                <label class="label" for="moderada">Lo justo y necesario</label><br class="br">

                <input class="input" type="radio" name="actividad" value="alta" required>
                <label class="label" for="alta">Con mucha frecuencia</label><br class="br">
                <br class="br">
            </div>



            <div class="div gastos">
                <!--6ª PREGUNTA-->
                <p class="p"> 7. ¿Estás dispuesto a cubrir los gastos necesarios de tu mascota?</p>

                <input class="input" type="radio" name="gastos" value="si" required>
                <label class="label" for="si">Sí, estoy dispuesto</label><br class="br">

                <input class="input" type="radio" name="gastos" value="depende" required>
                <label class="label" for="depende">Depende de los costes que conlleve</label><br class="br">

                <input class="input" type="radio" name="gastos" value="no" required>
                <label class="label" for="no">No estoy seguro</label> <br class="br">
                <br class="br">
            </div>



            <div class="div vidaM">
                <!--7ª PREGUNTA-->
                <p class="p"> 8. ¿Te gustaría que tu mascota requiera mucho entretenimiento o prefieres una más independiente?</p>
                <input class="input" type="radio" name="vidaMascota" value="socializacion" required>
                <label class="label" for="socializacion">Prefiero una mascota que requiera entretenimiento y socialización</label> <br class="br">

                <input class="input" type="radio" name="vidaMascota" value="independiente" required>
                <label class="label" for="independiente">Prefiero una mascota más independiente</label><br class="br">

                <input class="input" type="radio" name="vidaMascota" value="noPrefer" required>
                <label class="label" for="noPrefer">No tengo preferencia</label><br class="br">
                <br class="br">
            </div>

            <br class="br">
            <button class="button" id="btnEnviar" type="submit" value="Enviar">Enviar</button>


            <div class="div grupo3">
                <img class="img" src="imgsTEST/mascotasTest.jpg" alt="imgMascotas">
            </div>
        </form>

        <div class="div" id="fondoEnsombrecido">
            <div class="div" id="cajaRespuestaTest">
                <p class="p" id="resultadoTest"></p>  <!--resultado del test-->
                <input class="input" id="btnCerrar" type="image" src="imgsTEST/huella.png" alt="imgCerrar" value="Cerrar">
            </div>
        </div>

    </div>
</section>





<!--CARRUSEL DE IMAGENES Y PREGUNTAS PARA EL TAMAÑO DEL ORDENADOR-->
<div class="div" id="contenedorFormOrdenador">
    <button class="button" id="anterior">Anterior</button>

    <div class="div carrusel active">
        <div class="div pregunta">
            <!--NOMBRE-->
            <br class="br">
            <label class="label" for="name">1. Nombre</label> <br class="br">
            <input class="input" id="name" type="text" name="name"  placeholder="Introduce tu nombre" required>
        </div>

        <img class="img" src="imgsTEST/conejos.jpg" alt="imagen1">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--TAMAÑO-->
            <p class="p"> 2. ¿Cuál es el tamaño ideal que debería tener tu mascota?</p><br class="br">
            <input class="input" type="radio" name="tamanioMascota" value="pequeña" required>
            <label class="label" for="pequeña">Pequeña</label><br class="br">

            <input class="input" type="radio" name="tamanioMascota" value="mediana" required>
            <label class="label" for="mediana">Mediana</label><br class="br">

            <input class="input" type="radio" name="tamanioMascota" value="grande" required>
            <label class="label" for="grande">Grande</label>
        </div>

        <img class="img" src="imgsTEST/gatoYperro.jpg" alt="imagen2">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--ALERGIAS-->
            <p class="p"> 3. ¿Tienes alergias a algún tipo de animal?</p><br class="br">
            <input class="input" type="radio" name="alergias" value="no" required>
            <label class="label" for="no">No tengo alergias</label><br class="br">

            <input class="input" type="radio" name="alergias" value="siPerros" required>
            <label class="label" for="siPerros">Soy alérgico a los perros</label><br class="br">

            <input class="input" type="radio" name="alergias" value="siGatos" required>
            <label class="label" for="siGatos">Soy alérgico a los gatos </label>
        </div>

        <img class="img" src="imgsTEST/alergiasMascotas.jpeg" alt="imagen3">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--TIEMPO-->
            <p class="p"> 4. ¿Cuánto tiempo puedes dedicarle diariamente a cuidar y jugar con tu mascota?</p><br class="br">
            <input class="input" type="radio" name="tiempo" value="menosUnaHora" required>
            <label class="label" for="menosUnaHora">Menos de una hora</label><br class="br">

            <input class="input" type="radio" name="tiempo" value="unaYDos" required>
            <label class="label" for="unaYDos">Entre una y dos horas</label><br class="br">

            <input class="input" type="radio" name="tiempo" value="masDeDos" required>
            <label class="label" for="masDeDos">Más de dos horas</label>
        </div>

        <img class="img" src="imgsTEST/tiempoMascotas.jpg" alt="imagen4">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--ESPACIO-->
            <p class="p"> 5. ¿Vives en un espacio amplio como una casa con jardín o en un apartamento pequeño?</p><br class="br">
            <input class="input" type="radio" name="espacio" value="casaJardin" required>
            <label class="label" for="casaJardin">Casa con jardín</label><br class="br">

            <input class="input" type="radio" name="espacio" value="apartamentoPequenio" required>
            <label class="label" for="apartamentoPequenio">Apartamento pequeño</label><br class="br">

            <input class="input" type="radio" name="espacio" value="intermedio" required>
            <label class="label" for="intermedio">Espacio intermedio</label>
        </div>

        <img class="img" src="imgsTEST/gatoEspacio.jpg" alt="imagen5">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--ACTIVIDAD-->
            <p class="p"> 6. ¿Sueles tener actividad física al aire libre?</p><br class="br">
            <input class="input" type="radio" name="actividad" value="baja" required>
            <label class="label" for="baja">Con poca frecuencia</label><br class="br">

            <input class="input" type="radio" name="actividad" value="moderada" required>
            <label class="label" for="moderada">Lo justo y necesario</label><br class="br">

            <input class="input" type="radio" name="actividad" value="alta" required>
            <label class="label" for="alta">Con mucha frecuencia</label>
        </div>

        <img class="img" src="imgsTEST/perroPlaya.jpg" alt="imagen6">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--GASTOS-->
            <p class="p"> 7. ¿Estás dispuesto a cubrir los gastos necesarios de tu mascota?</p><br class="br">

            <input class="input" type="radio" name="gastos" value="si" required>
            <label class="label" for="si">Sí, estoy dispuesto</label><br class="br">

            <input class="input" type="radio" name="gastos" value="depende" required>
            <label class="label" for="depende">Depende de los costes que conlleve</label><br class="br">

            <input class="input" type="radio" name="gastos" value="no" required>
            <label class="label" for="no">No estoy seguro</label>
        </div>

        <img class="img" src="imgsTEST/cuidadosMascota.jpg" alt="imagen7">
    </div>


    <div class="div carrusel">
        <div class="div pregunta">
            <!--VIDA MASCOTA-->
            <p class="p"> 8. ¿Prefieres una mascota más sociable o más independiente?</p><br class="br">
            <input class="input" type="radio" name="vidaMascota" value="socializacion" required>
            <label class="label" for="socializacion">Prefiero una mascota sociable</label><br class="br">

            <input class="input" type="radio" name="vidaMascota" value="independiente" required>
            <label class="label" for="independiente">Prefiero una mascota más independiente</label><br class="br">

            <input class="input" type="radio" name="vidaMascota" value="noPrefer" required>
            <label class="label" for="noPrefer">No tengo preferencia</label>
        </div>

        <img class="img" src="imgsTEST/mascotaSocIndep.jpg" alt="imagen8">
    </div>

    <button class="button" id="siguiente">Siguiente</button>


</div>

<input class="input" type="submit" id="enviar" value="Enviar Formulario">



<div class="div" id="resultadoRespuestaTest2"></div>



</body>
    <?php
        include "includes/footer.php";
    ?>
</html>