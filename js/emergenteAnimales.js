document.addEventListener('DOMContentLoaded', function(){

    let ventanaEmergente = document.getElementById('ventanaEmergente');
    let btnMasInfo = document.querySelectorAll('.masInfo'); // cogemos todos los botones con la clase masInfo que hayan sido pulsados
    let fondoEnsombrecido = document.getElementById('fondoEnsombrecido');
    let btnCerrar = document.getElementById('btnCerrarEmergente');

    // Verificar si el usuario está logueado
    if (typeof isLoggedIn !== 'undefined' && isLoggedIn) {
        // El usuario está logueado, mostramos la ventana emergente
        btnMasInfo.forEach(btnMasInfo => {
            btnMasInfo.addEventListener('click', function (){

                //cogemos los datos del animal del cual el usuario haya pulsado el btn de mas info
                    //utilizamos el getAttribute pq lo pasamos con el objeto datda desde el boton
                let nombre = btnMasInfo.getAttribute('data-nombre');
                let img = btnMasInfo.getAttribute('data-img');
                let edad = btnMasInfo.getAttribute('data-edad');
                let dimension = btnMasInfo.getAttribute('data-dimension');
                let etapa = btnMasInfo.getAttribute('data-etapa');
                let peso = btnMasInfo.getAttribute('data-peso');
                let raza = btnMasInfo.getAttribute('data-raza');
                let genero = btnMasInfo.getAttribute('data-genero');
                let descripcion = btnMasInfo.getAttribute('data-descripcion');


                //mostramos los datos (q han sido pasados por el btnMasInfo
                document.getElementById('tituloNombreEmergente').textContent = nombre;
                document.getElementById('imgAnimalEmergente').src = img;
                document.getElementById('edadEmergente').textContent = edad;
                document.getElementById('dimensionEmergente').textContent = dimension;
                document.getElementById('etapaEmergente').textContent = etapa;
                document.getElementById('pesoEmergente').textContent = peso;
                document.getElementById('razaEmergente').textContent = raza;
                document.getElementById('generoEmergente').textContent = genero;
                document.getElementById('descripcionEmergente').textContent = descripcion;


                fondoEnsombrecido.style.display = 'flex'; //cuando le hayamos dado al boton de enviar, se desplegara la respuesta con un fondo negro de fondo
                ventanaEmergente.style.display = 'block';
            });
        });
    } else {
        // El usuario no está logueado, redirigir a la página de login.php
        window.location.href = "login.php";
    }

    btnCerrar.addEventListener('click', function (){
        fondoEnsombrecido.style.display = 'none';
        ventanaEmergente.style.display = 'none';
    });

});
