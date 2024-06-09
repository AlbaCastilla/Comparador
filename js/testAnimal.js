document.addEventListener('DOMContentLoaded', function () {
    let btnEnviar = document.getElementById('btnEnviar');
    let resultado = document.getElementById('resultadoTest');
    let fondoEnsombrecido = document.getElementById('fondoEnsombrecido');
    let btnCerrar = document.getElementById('btnCerrar');

    let btnSiguiente = document.getElementById('btnSiguiente');



    btnEnviar.addEventListener('click', function (event) {
        event.preventDefault();

        let nombre = document.getElementById('name').value;//NOMBRE INSERTADO EN EL FORMULARIO

        let btnOpciones = document.querySelectorAll('input[type="radio"]:checked'); //cogemos el valor solo de los elementos que hayan sido seleccionados por el usuario
        if (btnOpciones.length === 0) {
            console.log('No se ha seleccionado ninguna opción.');
            //si nunguna de las opciones ha sido seleccionada por el usuario, se mostrará el mensaje por consola
            return;
        }


        fondoEnsombrecido.style.display = 'flex'; //cuando le hayamos dado al boton de enviar, se desplegara la respuesta con un fondo negro de fondo

        condicionalesMascotaIdeal(nombre);

        btnCerrar.addEventListener('click', function () {
            fondoEnsombrecido.style.display = 'none';
        });
    });

    function condicionalesMascotaIdeal(nombre) {
        let tamanio = document.querySelector('input[name="tamanioMascota"]:checked').value;
        let alergias = document.querySelector('input[name="alergias"]:checked').value;
        let tiempo = document.querySelector('input[name="tiempo"]:checked').value;
        let espacio = document.querySelector('input[name="espacio"]:checked').value;
        let actividad = document.querySelector('input[name="actividad"]:checked').value;
        let gastos = document.querySelector('input[name="gastos"]:checked').value;
        let vidaMascota = document.querySelector('input[name="vidaMascota"]:checked').value;


        let mascotaIdeal = "";

        //combinaciones respuestas
        if ((espacio === 'intermedio' || espacio === 'casaJardin') && (alergias !== 'siPerros') && (vidaMascota === 'socializacion') && (tamanio === 'mediana' || tamanio === 'grande') && (tiempo !== 'menosUnaHora') && (actividad !== 'baja')) {
            mascotaIdeal = "PERRO!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'apartamentoPequenio' || espacio === 'intermedio') && (alergias !== 'siGatos') && (vidaMascota !== 'socializacion') && (tamanio === 'mediana') && (tiempo !== 'masDeDos')) {
            mascotaIdeal = "GATO!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL ES UN: ${mascotaIdeal}`;
        }
        else if ((espacio === 'apartamentoPequenio') && (alergias === 'no') && (vidaMascota !== 'socializacion') && (tamanio === 'pequeña') && (tiempo === 'menosUnaHora')) {
            mascotaIdeal = "PEZ!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL PARECE SER UN: ${mascotaIdeal}`;
        }
        else if ((espacio === 'apartamentoPequenio' || espacio === 'intermedio') && (alergias !== 'siAves') && (vidaMascota === 'companero') && (tamanio === 'pequeña') && (tiempo !== 'menosUnaHora') && (actividad !== 'baja')) {
            mascotaIdeal = "AVE!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'apartamentoPequenio') && (alergias === 'no') && (vidaMascota !== 'socializacion') && (tamanio === 'pequeña') && (tiempo !== 'masDeDos')) {
            mascotaIdeal = "REPTIL!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL ES UN: ${mascotaIdeal}`;
        }
        else if ((espacio === 'intermedio' || espacio === 'apartamentoPequenio') && (alergias !== 'siRoedores') && (vidaMascota === 'companero') && (tamanio === 'pequeña') && (tiempo === 'menosUnaHora') && (actividad === 'baja')) {
            mascotaIdeal = "ROEDOR!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'casaJardin') && (alergias === 'no') && (tiempo === 'masDeDos') && (actividad === 'baja') && (vidaMascota === 'noPrefer')) {
            resultado.textContent = 'Con tus condiciones, toda mascota estaría genial contigo!!';
        }
        else if ((espacio === 'casaJardin') && (alergias === 'no') && (vidaMascota === 'companero') && (tamanio === 'grande') && (tiempo === 'masDeDos') && (actividad === 'media')) {
            mascotaIdeal = "PERRO!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'intermedio') && (alergias !== 'siAves') && (vidaMascota === 'companero') && (tamanio === 'pequeña') && (tiempo === 'masDeDos') && (actividad === 'media')) {
            mascotaIdeal = "AVE!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'casaJardin') && (alergias !== 'siRoedores') && (vidaMascota === 'companero') && (tamanio === 'mediana') && (tiempo === 'menosUnaHora') && (actividad === 'media')) {
            mascotaIdeal = "ROEDOR!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'apartamentoPequenio' || espacio === 'intermedio') && (alergias !== 'siGatos') && (vidaMascota === 'companero') && (tamanio === 'pequeña') && (tiempo === 'masDeDos') && (actividad === 'baja')) {
            mascotaIdeal = "GATO!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else if ((espacio === 'apartamentoPequenio') && (alergias === 'no') && (vidaMascota === 'companero') && (tamanio === 'pequeña') && (tiempo === 'menosUnaHora') && (actividad === 'baja')) {
            mascotaIdeal = "PEZ!";
            resultado.textContent = `Hola ${nombre}, tu MASCOTA IDEAL es un: ${mascotaIdeal}`;
        }
        else {
            resultado.textContent = `NO HEMOS ENCONTRADO UNA MASCOTA IDEAL PARA TI`;
        }


    }
});
