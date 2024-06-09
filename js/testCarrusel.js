document.addEventListener('DOMContentLoaded', function(){

    let btnSiguiente = document.getElementById('siguiente');
    let btnAnterior = document.getElementById('anterior');
    let btnEnviar = document.getElementById('enviar');

    let elementosCarrusel = document.querySelectorAll('.carrusel');

    let indiceActual = 0;

    //FUNCIONES

    //MOSTRAR LOS ELEMENTOS_dependiendo del indice y de la clase que tenga en el html
    function mostrarElementosCarrusel(indice){
        //recorremos todos los elementos del carrusel
        for(let i = 0; i < elementosCarrusel.length; i++){
            if (i === indice){
                //si el indice actual es igual al indice dado -> se añadirá la clase ACTIVE (HTML) para que se pueda mostrar el elemento
                elementosCarrusel[i].classList.add('active');
            }else{
                //por el contrario, si no es igual el indice, se le quitará al elemento la clase ACTIVE(HTML) y se dejará de mostrar
                elementosCarrusel[i].classList.remove('active');
            }
        }
    }

    //ACTUALIZAR INDICE DEL BTN SIGUIENTE
    function actualizarIndiceSiguiente(indiceIn){
        if(indiceIn < elementosCarrusel.length-1){
            indiceIn++;
        }
        return indiceIn;
    }

    //ACTUALIZAR INDICE BTN ANTERIOR
    function actualizarIndiceAnterior(indiceIn){
        if(indiceIn > 0){
            indiceIn--;
        }
        return indiceIn;
    }

    //ESTADOS DE LOS BOTONES
    function actualizarEstadoBotones(indiceIn){
        if (indiceIn == 0){
            btnAnterior.disabled = true;
            btnEnviar.style.display = 'none';
        }else{
            btnAnterior.disabled = false;
        }

        if(indiceIn == elementosCarrusel.length -1){
            btnSiguiente.disabled = true;
            btnEnviar.style.display = 'block';
        }else{
            btnSiguiente.disabled = false;
            btnEnviar.style.display = 'none';
        }
    }

    //BTN ANTERIOR
    btnAnterior.addEventListener('click', function(){
        indiceActual = actualizarIndiceAnterior(indiceActual);
        actualizarEstadoBotones(indiceActual);
        mostrarElementosCarrusel(indiceActual);
    });

    //BTN SIGUIENTE
    btnSiguiente.addEventListener('click', function(){
        indiceActual = actualizarIndiceSiguiente(indiceActual);
        actualizarEstadoBotones(indiceActual);
        mostrarElementosCarrusel(indiceActual);
    });

    //INCIALIZAMOS EL CARRUSEL MOSTRANDO EL PRIMER ELEMNTO DEL CARRUSEL
    mostrarElementosCarrusel(indiceActual);
    actualizarEstadoBotones(indiceActual);

    //FORMULARIO _ BTN-ENVIAR
    let resultado = document.getElementById('resultadoRespuestaTest2');
    let btnCerrar = document.getElementById('btnCerrar2');

    btnEnviar.addEventListener('click', function(event){
        event.preventDefault(); // para que no se mande antes de tiempo

        let nombre = document.getElementById('name').value;

        let btnOpciones = document.querySelectorAll('input[type="radio"]:checked'); // cogemos el valor solo de los elementos que hayan sido seleccionados por el usuario

        condicionalesMascotaIdeal(nombre);

        // Mostrar el resultado
        resultado.classList.add('show');
    }); // cerrar la funcion del btn enviar

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
