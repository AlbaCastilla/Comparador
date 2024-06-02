window.addEventListener('DOMContentLoaded',function(){

    let login1 = document.querySelector('.login1');
    let login2 = document.querySelector('.login2'); 
    let avisoNoRegistrado= document.querySelector('.noRegistrado');
    let btnContinuar =document.getElementById("btnContinuar");
    let errorContrasena = document.querySelector('.errorContrasena');
    

    login2.classList.add('dont-show');
    avisoNoRegistrado.classList.add('dont-show');
    errorContrasena.classList.add('dont-show');

    btnContinuar.addEventListener('click', function(){
        login1.classList.add('dont-show');
        login2.classList.remove('dont-show');

        peticion("login.php",avisoNoRegistrado);
    })
})
    function peticion(url, avisoNoRegistrado){
        let correo = this.document.getElementById("correo").value//si me da error puede ser pq haya metido un id dentro d un label
        let data_send = new FormData();
     //con el FORMDATA, solamente enviamos los datos que el usuario registra o envia, no todos los datos

    data_send.append('correo', correo);//siempre q hago un append meto un identificador y luego el valor que vamos a meter en el FormData


        fetch(url, {
            method: 'POST',
            body: data_send
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Hubo un problema con la solicitud.');
            }
        })
        .then(datos => {
            // Mostrar resultados o realizar alguna acción si la solicitud fue exitosa
            console.log(datos);
        })
        .catch(error => {
            // Mostrar el mensaje de error si la solicitud falla
            avisoNoRegistrado.classList.remove('dont-show');
            console.error('Error:', error);
        });
    }

