document.addEventListener('DOMContentLoaded', function() {

    let loginCorreo = document.getElementById("parteCorreo");
    
    let avisoNoRegistrado = document.getElementById("avisoNoRegistradoLogin");
    let btnContinuar = document.getElementById("btnContinuar");

    // Inicialmente ocultar los mensajes y secciones
    avisoNoRegistrado.classList.add('dont-show');

    btnContinuar.addEventListener('click', function() {
        loginCorreo.classList.add('dont-show');
    });
})