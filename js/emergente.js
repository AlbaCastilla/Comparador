window.addEventListener("DOMContentLoaded", function() {

    fetch('json/data.json')
        .then(response => response.json())
        .then(data => {
            crearCajas(data);
        })
        .catch(error => console.error('Error:', error));
  
    function crearCajas(data) {
        let contenedor = document.getElementById('contenedor');
    
        data.forEach((item, index) => {
            let caja = document.createElement('div');
            caja.classList.add('caja');
            // Asignar un ID único a cada caja
            caja.id = 'caja-' + index;
            let cajaContenido = `
                <div class="caja-dentro">
                    <img src="${item.image}" alt="${item.name}">
                    <p class="texto">${item.name}</p>
                </div>
                <button class="caja-boton">More info</button>
            `;
            caja.innerHTML = cajaContenido;
            contenedor.appendChild(caja);
        });
    
        let cajaBotones = document.querySelectorAll(".caja-boton");
        let ventanaEmergente = document.getElementById("ventana-emergente");
        let overlay = document.getElementById("overlay");
        let animalImg = document.getElementById("animal-img");
        let animalSexo = document.getElementById("animal-sexo")
        let animalNombre = document.getElementById("animal-nombre");
        let animalTipo = document.getElementById("animal-tipo");
        let animalEdad = document.getElementById("animal-edad");
        let animalDescripcion = document.getElementById("animal-descripcion");
        let cerrarBoton = document.querySelector(".cerrar");
    
        cajaBotones.forEach(function(cajaBoton, index) {
            cajaBoton.addEventListener("click", function () {
                let animalInfo = data[index]; // Usamos el índice para obtener los datos de la caja correspondiente
                animalImg.src = animalInfo.image;
                animalNombre.textContent = animalInfo.name;
                animalTipo.textContent = animalInfo.animal;
                animalSexo.textContent = animalInfo.sexo;
                animalDescripcion.textContent = animalInfo.descripcion;
                animalEdad.textContent = animalInfo.edad;
                ventanaEmergente.style.display = "block";
                overlay.style.display = "block";
            });
        });
    
        cerrarBoton.addEventListener("click", function () {
            ventanaEmergente.style.display = "none";
            overlay.style.display = "none";
        });
    
        overlay.addEventListener("click", function () {
            ventanaEmergente.style.display = "none";
            overlay.style.display = "none";
        });
    }
});
