document.addEventListener('DOMContentLoaded', function(){

    let btnSiguiente = document.getElementById('siguiente');
    let btnAnterior = document.getElementById('anterior');

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
        }else{
            btnAnterior.disabled = false;
        }

        if(indiceIn == elementosCarrusel.length -1){
            btnSiguiente.disabled = true;
        }else{
            btnSiguiente.disabled = false;
        }
    }

    //BTN ANTERIOR
    btnAnterior.addEventListener('click', function(){
        indiceActual = actualizarIndiceAnterior(indiceActual);
        actualizarEstadoBotones(indiceActual);
        mostrarElementosCarrusel(indiceActual);
    })

    //BTN SIGUIENTE
    btnSiguiente.addEventListener('click', function(){
        indiceActual = actualizarIndiceSiguiente(indiceActual);
        actualizarEstadoBotones(indiceActual);
        mostrarElementosCarrusel(indiceActual);
    })

    //INCIALIZAMOS EL CARRUSEL MOSTRANDO EL PRIMER ELEMNTO DEL CARRUSEL
    mostrarElementosCarrusel(indiceActual);
    actualizarEstadoBotones(indiceActual);
});
