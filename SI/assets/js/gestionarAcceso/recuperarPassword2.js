// Formulario de la pagina
const form = document.getElementById("form")

// Campos del formulario
const email = document.getElementById("email")
const securityQuestion = document.getElementById("securityQuestion")
const password = document.getElementById("password")
const repassword = document.getElementById("repassword")
const ID = document.getElementById("ID")

// Campos de error
const errorPassword = document.getElementById("errorPassword")
const errorRepassword = document.getElementById("errorRepassword")

/*

    Este evento permite recojer los datos de la URl que fueron sobre escritos por la pagina anterior
    Permitiendo saber cual era la pregunta de seguridad y el correo del usuario

*/

// Expresiones regulares por las cuales serán evaluados los datos
const expresiones = {
    password: /^.{10,}$/, // No está vacío y al menos 10 caracteres
};

window.addEventListener('DOMContentLoaded', (event) => {
    // Obtener el ID del usuario de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const security_question = urlParams.get('securityQuestion');
    const emailValue = urlParams.get('email');

    // Asigna el valor de Email al campo del formulario correspondiente
    email.value = emailValue;
    email.readOnly = true;

    // Asigna la pregunta de seguridad ingresada por el usuario al formulario correspondiente
    securityQuestion.value = security_question;
    securityQuestion.readOnly = true;

    ID.value = id;
});

// El evento que se dispara cuando el formulario es enviado
form.addEventListener("submit", (e) =>
{
    let entrar = true
    let warnings = ""

    // Validacion de los campos de contraseña
    if (!expresiones.password.test(password.value)) {
        warnings += "La contraseña no es valida"
        entrar = false
        password.style.borderColor = 'red'
        errorPassword.innerHTML = errorPassword.innerHTML = 'La contraseña tienen que ser mínimo 10 careacteres!'
    }
    else
    {
        password.style.borderColor = ''
        errorPassword.innerHTML = ''
    }

    if (!expresiones.password.test(repassword.value)) {
        warnings += "La contraseña no es valida"
        entrar = false
        repassword.style.borderColor = 'red'
        errorRepassword.innerHTML = 'La contraseña tienen que ser mínimo 10 careacteres!'
    }
    else
    {
        repassword.style.borderColor = ''
        errorRepassword.innerHTML = ''
    }

    // Validacion de que ambas contraseñas deben coincidir
    if (password.value != repassword.value)
    {
        warnings += "Las contraseñas no coinciden"
        entrar = false
        repassword.style.borderColor = 'red'
        errorRepassword.innerHTML = 'Las contraseñas no coinciden'
    }
    else
    {
        repassword.style.borderColor = ''
        errorRepassword.innerHTML = ''
    }

    if (entrar) {
        // En este momento, los datos del formulario son validos para llevarlos al controlador
        e.preventDefault()

        // Se guardan los datos del formulario en un FormData
        const formData = new FormData(form)

        // Llamada al controlador mediante la API Fetch
        fetch('../../controllers/gestionarAcceso/recuperarPassword.php ',{
            //metodo de envio
            method : 'POST',
            //datos enviados
            body: formData
        })
        //se indica que la respuesta obtenida es en formato json
        .then(response => response.json())
        .then(data => {

            console.log(data)

            //data contiene la respuesta obtenida de recuperarPassword.php 
            if(data.message == "Modificacion con exito"){
                alert(data.message);
                window.location="../../views/gestionarAcceso/iniciarSesion.php"
            }else{
                alert(data.message)
            }
        })
        .catch(error => console.error(error));
    }
    else
    {
        e.preventDefault();
        alert(warnings);
    }
})