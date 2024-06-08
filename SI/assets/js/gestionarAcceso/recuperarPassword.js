// Formulario de la pagina Recover
const form = document.getElementById("form");

// Campos a validar
const email = document.getElementById("email");

//campos de error
const errorEmail = document.getElementById("errorEmail");

// Expresiones regulares
const expresiones = {
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

// Eventos
form.addEventListener("submit", (e) => {
    
    e.preventDefault();

    let entrar = true;
    let warnings = "";

    if (!expresiones.email.test(email.value)){
        warnings += `El Email electrónico no es válido.\n`;
        entrar = false;
        errorEmail.innerHTML = '<b>¡El Email no es valido! \n Ejemplo de Email valido: xxxx@gmail.com</b>';
        email.style.borderColor ='red';
    }

    if (!entrar) {   
        alert(warnings);
    }else{
        
        //se guardan los datos del formulario en formData
        const formData = new FormData(form);
    
        //usamos la API fetch para enviar datos al recuperarPassword.php 
        fetch('../../controllers/gestionarAcceso/verificarEmail.php ',{
            //metodo de envio
            method : 'POST',
            //datos enviados
            body: formData
        })
        //se indica que la respuesta obtenida es en formato json
        .then(response => response.json())
        .then(data => {
            
            // console.log(data)

            
            if (data.message == "Estudiante verificado con éxito")
            {
                // Redirigir a la pantalla nueva con el ID como parámetro en la URL
                const id = data.student_id;
                const securityQuestion = data.security_question;
                const email = data.email;

                window.location = `../../views/gestionarAcceso/recuperarPassword2.php?id=${id}&securityQuestion=${securityQuestion}&email=${email}`;
            }
            else
            {
                alert("No se ha encontrado un estudiante con este correo");
            }
            
        })
        .catch(error => console.error(error));
    }

})