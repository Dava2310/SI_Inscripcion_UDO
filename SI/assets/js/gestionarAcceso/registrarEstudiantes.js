import { validarDatos } from "../validaciones/estudiante.js";

const form = document.getElementById("form");

form.addEventListener("submit", async e => {
    e.preventDefault();

    const isInvalidFrontEndData = validateFrontEndData();

    if (isInvalidFrontEndData) {
        return alert(isInvalidFrontEndData.message);
    }

    // Envio de Formulario
    try {
        const formData = new FormData(form);
        const data = await sendRequest(formData, '../../controllers/gestionarAcceso/registrarEstudiantes.php');

        // Procesar Respuesta JSON 
        if (data.message === 'Registro exitoso') {
            window.alert("Registro de estudiante exitoso");
            window.location = '../../views/gestionarAcceso/iniciarSesion.php';
        } else {
            alert(data.message);
        }

    } catch (error) {
        handleError(error);
    }
});

function validateFrontEndData() {
    const [validation, warnings] = validarDatos();

    if (!validation) {
        return { message: warnings }
    }
}

// Enviar solicitud
async function sendRequest(formData, url) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const data = await handleResponse(response);
        return data;
    } catch (error) {
        throw error;
    }
}

// Procesar/Sintetizar Respuesta
async function handleResponse(response) {
    const data = await response.json();
    if (!response.ok) {
        throw new Error(data.message || 'Hubo un problema con la solicitud: ' + response.status);
    }
    return data;
}

// Manejar Errores
function handleError(error) {
    console.error('Error en la solicitud:', error);
    alert(error.message || 'Ha ocurrido un error en la solicitud');
}
