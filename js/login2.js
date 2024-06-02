document.addEventListener('DOMContentLoaded', function() {

    let loginCorreo = document.getElementById("parteCorreo");
    let loginContrasena = document.getElementById ("parteContrasena");
    let avisoNoRegistrado = document.getElementById("avisoNoRegistradoLogin");
    let btnContinuar = document.getElementById("btnContinuar");

    // Inicialmente ocultar los mensajes y secciones
    loginContrasena.classList.add('dont-show');
    avisoNoRegistrado.classList.add('dont-show');

    btnContinuar.addEventListener('click', function() {
        let correoInput = document.getElementById("correo").value;
        console.log('Correo ingresado:', correo);
        if ((correoInput.trim() !== "")&&(correoInput.trim() !== "correo")) {

            let formData = new FormData();
            formData.append('correo', correoInput);

            // Enviar la solicitud con fetch
            fetch('verificarCorreoUsuario.php', {
                method: 'POST',
                body: formData, // Utilizar FormData como cuerpo de la solicitud
            })
            .then(response => {
                if (!response.ok) {
                    console.log("error en el then");
                }
                return response.json();
            })
            .then(data => {
                let correoLimpio = limpiarCadena(correoInput);
                let dataLimpia = limpiarCadena(data);
                if (correoLimpio === dataLimpia) {
                    console.log(data);
                    loginContrasena.classList.remove('dont-show');
                    loginCorreo.classList.add('dont-show');
                } else {
                    console.log(data);
                    // Si el correo no está registrado, mostrar el aviso
                    avisoNoRegistrado.classList.remove('dont-show');
                }
            })
            .catch(error => {
                console.log("error");
            });
        } else {
            alert("El campo está vacío");
        }

    });

    function limpiarCadena(cadena) {
        // Eliminar espacios en blanco al principio y al final
        cadena = cadena.trim();
        // Eliminar comillas simples y dobles
        cadena = cadena.replace(/['"]+/g, '');
        // Eliminar caracteres especiales utilizando una expresión regular
        cadena = cadena.replace(/[^\w\s]/gi, ''); // Solo se permiten caracteres alfanuméricos y espacios
        return cadena;
    }

})