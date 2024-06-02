document.addEventListener("DOMContentLoaded", function () {
    const anterior = document.getElementById("anterior");
    const siguiente = document.getElementById("siguiente");
    const carruselItems = document.querySelectorAll(".animal-info.carrusel");
    let indiceActual = 0;

    function mostrarItem(indice) {
        carruselItems.forEach((item, i) => {
            if (i === indice) {
                item.classList.add("active");
                item.style.transform = "translateX(0)";
            } else if (i < indice) {
                item.classList.remove("active");
                item.style.transform = "translateX(-100%)";
            } else {
                item.classList.remove("active");
                item.style.transform = "translateX(100%)";
            }
        });
    }

    anterior.addEventListener("click", function () {
        indiceActual = (indiceActual > 0) ? indiceActual - 1 : carruselItems.length - 1;
        mostrarItem(indiceActual);
    });

    siguiente.addEventListener("click", function () {
        indiceActual = (indiceActual < carruselItems.length - 1) ? indiceActual + 1 : 0;
        mostrarItem(indiceActual);
    });

    mostrarItem(indiceActual);
});
