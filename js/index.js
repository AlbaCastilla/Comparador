window.addEventListener('DOMContentLoaded', function() {

    let imagenes = ["fondoIndex1 (1).jpeg", "fondoIndex1.jpg", "fondoIndex2.jpg"];
    let miDivRes = document.getElementById("res");
    let indiceActual = 0;

    function mostrarImg() {
        miDivRes.innerHTML = '<img src="imgs/' + imagenes[indiceActual] + '">';
        indiceActual = (indiceActual + 1) % imagenes.length; // Utilizamos el operador módulo para asegurarnos de que el índice esté dentro del rango de las imágenes
    }

    mostrarImg(); // Llamamos a la función inicialmente para mostrar la primera imagen

    setInterval(mostrarImg, 3500); // Cambiar de imagen cada 3.5 segundos (3500 milisegundos)

    

    

});
