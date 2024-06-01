<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice</title>
    <link rel="stylesheet" href="css/indexprueba.css?v=<?php echo time(); ?>">
    <script src="js/index.js"></script>
    <script src="js/slider.js"></script>
</head>

<body>

    <?php
    include "includes/navbar.php";
    ?>

    <!--SLIDER IMÁGENES-->

    <div id="res">

    </div>

    <!--TEXTO COLABORA-->

    <div class="textoIntro">

        <div class="titulo-colabora">
            <div class="antes"></div>
            <h1>Colabora con nosotros</h1>
            <div class="despues"></div>
        </div>
    </div>

    <!--CONTENEDOR IMÁGENES Y TEXTO-->

    <div class="contenedorGrande">

        <div class="contenedorImagenes">
            <div class="imagen1">
                <img src="imgs/protectoras-de-animales-de-espana-estudio-sobre-abandono (1).jpg" alt="">
                <img src="imgs/5934-dsc0072 (1).jpg" alt="" class="background-img">
            </div>
            <div class="imagen2">
                <img src="imgs/cosas-donar-refugio-animales-portada-668x400x80xX-1 (1).jpg" alt="">
                <img src="imgs/64b849094b431 (1).jpeg" alt="" class="background-img">
            </div>
            <div class="imagen3">
                <img src="imgs/pet-adoption (1).jpg" alt="">
                <img src="imgs/20210219-La-Perla (1).jpg" alt="" class="background-img">
            </div>
            <div class="imagen4">
                <img src="imgs/protectora-cuidando-animales (1).jpeg" alt="">
                <img src="imgs/ADOPCION-DE-MASCOTAS-SUGERENCIAS (1).jpg" alt="" class="background-img">
            </div>

        </div>

        <div class="contenedorTexto">
            <div class="donacionTitulo">
                <h4>Ayúdanos a Cuidar, Proteger y Amar: Por qué tu Donación Marca la Diferencia</h4>
            </div>
            <div class="donacionTexto">
                <p class="texto1">En nuestra misión de salvar y mejorar la vida de los animales más vulnerables, tu apoyo es fundamental. Cada donación que recibimos es una contribución directa al bienestar y la supervivencia de los animales que rescatamos y cuidamos. Pero, ¿por qué es tan crucial tu donación?</p><br>

                <h4 class="titulo1">1. Vida y Esperanza Renovadas:</h4>
                <p class="texto2">Tu donación es la chispa que enciende una nueva vida para los animales que llegan a nuestra puerta en busca de ayuda desesperada. Con tu generosidad, les proporcionamos refugio, atención veterinaria, alimentación adecuada y, lo más importante, amor incondicional.</p>

                <h4 class="titulo2">2. Rescate y Rehabilitación:</h4>
                <p class="texto3">Cada animal rescatado tiene su propia historia de lucha y supervivencia. Tu contribución nos permite llevar a cabo operativos de rescate, brindar atención médica inmediata y proporcionar el entorno seguro y amoroso que necesitan para recuperarse física y emocionalmente.</p>

                <h4 class="titulo3">3. Programas de Esterilización y Educación:</h4>
                <p class="texto4">La prevención es fundamental en nuestra lucha por detener el sufrimiento animal. Con tus donaciones, podemos llevar a cabo programas de esterilización masiva para controlar la población de animales sin hogar y educar a la comunidad sobre la importancia del cuidado responsable de los animales.</p>
            </div>
        </div>

    </div>

    <!--BOTÓN CONOCER-->

    <div class="boton-conocer">
        <a href="#"><button>Ayúdanos</button></a>
    </div>

    <!--TEXTO ALGUNO DE NUESTROS ANIMALES-->

    <div class="textoTitulo2">
        <div class="antes"></div>
        <h1>Alguno de nuestros animales</h1>
        <div class="despues"></div>
    </div>


    <!-- CAJA ANIMAL 1
    <div id="contenedor"></div>

    <div id="overlay" class="oculto"></div>


    <div id="ventana-emergente" class="oculto">
        <div id="contenido-ventana">
            <span class="cerrar">&times;</span>
            <div class="informacion-titulo">
                <h3>Información del animal</h3>
            </div>
            <div class="animal-info">
                <img id="animal-img" src="" alt="Imagen del Animal">
                <div class="NombreAnimal">
                    <h4>Nombre del Animal:</h4>
                </div>
                <p id="animal-nombre"></p>
                <div class="TipoAnimal">
                    <h4>Tipo de Animal:</h4>
                </div>
                <p id="animal-tipo"></p>
                <div class="SexoAnimal">
                    <h4>Sexo de Animal:</h4>
                </div>
                <p id="animal-sexo"></p>
                <div class="EdadAnimal">
                    <h4>Edad de Animal:</h4>
                </div>
                <p id="animal-edad"></p>
                <div class="DescripcionAnimal">
                    <h4>Conóceme:</h4>
                </div>
                <p id="animal-descripcion"></p>

            </div>
        </div>
    </div>

    -->

    <!--CAJAS SLIDER-->

    <div id="contenedorFormOrdenador">
        <button id="anterior">Anterior</button>

        <div class="container">
            <div class="animal-info carrusel active">
                <a href="donacion.php">
                    <div class="text-info">
                        <div class="NombreAnimal">
                            <h4>Nombre del Animal:</h4>
                            <p id="animal-nombre-1">Animal 1</p>
                        </div>
                        <div class="TipoAnimal">
                            <h4>Tipo de Animal:</h4>
                            <p id="animal-tipo-1">Tipo 1</p>
                        </div>
                        <div class="SexoAnimal">
                            <h4>Sexo de Animal:</h4>
                            <p id="animal-sexo-1">Sexo 1</p>
                        </div>
                        <div class="EdadAnimal">
                            <h4>Edad de Animal:</h4>
                            <p id="animal-edad-1">Edad 1</p>
                        </div>
                        <div class="DescripcionAnimal">
                            <h4>Conóceme:</h4>
                            <p id="animal-descripcion-1">Descripción 1</p>
                        </div>
                    </div>
                    <img id="animal-img-1" src="imgs/Vera_01.jpg" alt="Imagen del Animal 1">
                </a>
            </div>

            <div class="animal-info carrusel">
                <a href="login.php">
                    <div class="text-info">
                        <div class="NombreAnimal">
                            <h4>Nombre del Animal:</h4>
                            <p id="animal-nombre-2">Animal 2</p>
                        </div>
                        <div class="TipoAnimal">
                            <h4>Tipo de Animal:</h4>
                            <p id="animal-tipo-2">Tipo 2</p>
                        </div>
                        <div class="SexoAnimal">
                            <h4>Sexo de Animal:</h4>
                            <p id="animal-sexo-2">Sexo 2</p>
                        </div>
                        <div class="EdadAnimal">
                            <h4>Edad de Animal:</h4>
                            <p id="animal-edad-2">Edad 2</p>
                        </div>
                        <div class="DescripcionAnimal">
                            <h4>Conóceme:</h4>
                            <p id="animal-descripcion-2">Descripción 2</p>
                        </div>
                    </div>
                    <img id="animal-img-2" src="imgs/Mustang_01.jpg" alt="Imagen del Animal 2">
                </a>
            </div>

            <div class="animal-info carrusel">
                <a href="login.php">
                    <div class="text-info">
                        <div class="NombreAnimal">
                            <h4>Nombre del Animal:</h4>
                            <p id="animal-nombre-3">Animal 3</p>
                        </div>
                        <div class="TipoAnimal">
                            <h4>Tipo de Animal:</h4>
                            <p id="animal-tipo-3">Tipo 3</p>
                        </div>
                        <div class="SexoAnimal">
                            <h4>Sexo de Animal:</h4>
                            <p id="animal-sexo-3">Sexo 3</p>
                        </div>
                        <div class="EdadAnimal">
                            <h4>Edad de Animal:</h4>
                            <p id="animal-edad-3">Edad 3</p>
                        </div>
                        <div class="DescripcionAnimal">
                            <h4>Conóceme:</h4>
                            <p id="animal-descripcion-3">Descripción 3</p>
                        </div>
                    </div>
                    <img id="animal-img-3" src="imgs/Trueno_01.jpg" alt="Imagen del Animal 3">
                </a>
            </div>
        </div>

        <button id="siguiente">Siguiente</button>
    </div>



    <?php
    include "includes/footer.php";
    ?>

</body>

</html>