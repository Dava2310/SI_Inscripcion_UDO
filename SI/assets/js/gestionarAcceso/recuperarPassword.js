const form = document.getElementById("form");

// Expresiones regulares
const expresiones = {
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

function emailIsValid() {
    const email = document.getElementById("email");
    const errorEmail = document.getElementById("errorEmail");

    if (!expresiones.email.test(email.value)) {
        errorEmail.innerHTML = '<b>¡El Email no es valido! \n Ejemplo de Email valido: xxxx@gmail.com</b>';
        email.style.borderColor = 'red';
        return false;
    }
    return true;
}

// Evento de enviar Formulario
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Verificacion 
    if (!emailIsValid()) {
        return;
    }

    const formData = new FormData(form);

    try {
        const data = await sendRequest(formData, '../../controllers/gestionarAcceso/verificarEmail.php');
        handleEmailVerificationResponse(data);
    } catch (error) {
        handleError(error);
    }
});

// Enviar solicitud
async function sendRequest(formData, url) {
    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });
    return handleResponse(response);
}

// Manejar respuesta de verificación de correo electrónico
function handleEmailVerificationResponse(data) {
    console.log(data);

    const mensajesValidos = ["Estudiante verificado con éxito", "Usuario verificado con éxito"];

    if (mensajesValidos.includes(data.message)) {
        const id = data.student_id || data.user_id;
        const { security_question: securityQuestion, email } = data;

        window.location = `../../views/gestionarAcceso/recuperarPassword2.php?id=${id}&securityQuestion=${securityQuestion}&email=${email}`;
    } else {
        alert("No se ha encontrado un usuario con este correo");
    }
}

// Procesar/Sintetizar Respuesta
async function handleResponse(response) {
    const data = await response.json();
    if (!response.ok) {
        throw new Error(data.message || `Error en la solicitud: ${response.status}`);
    }
    return data;
}

// Manejar Errores
function handleError(error) {
    console.error('Error en la solicitud:', error);
    alert(error.message || 'No se pudo encontrar al usuario');
}
