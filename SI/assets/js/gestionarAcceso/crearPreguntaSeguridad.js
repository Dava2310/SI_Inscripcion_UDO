const registrationForm = document.getElementById("registrationForm");

registrationForm.addEventListener("submit", async e => {
    e.preventDefault();

    const isInvalidFrontEndData = validateFrontEndData();

    if (isInvalidFrontEndData) {
        return alert(isInvalidFrontEndData.message);
    }

    const formData = new FormData(registrationForm);

    try {
        const data = await sendRegistrationRequest(formData, '../../controllers/gestionarAcceso/crearPreguntaSeguridad.php');
        handleQuestionRegistrationResponse(data);
    } catch (error) {
        handleError(error);
    }
});

function validateFrontEndData() {
    return false;
}

async function sendRequest(formData, url) {
    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });
    return handleResponse(response);
}

async function handleResponse(response) {
    const data = await response.json();
    if (!response.ok) {
        throw new Error(data.message || 'Hubo un problema con la solicitud: ' + response.status);
    }
    return data;
}

function handleQuestionRegistrationResponse(data) {
    // Handle the response specific to registration
    if (data.success) {
        window.alert("Registro Exitoso");
        window.location = '../../views/dashboardEmpleados/dashboardEmpleados.php'; // Redirect to a new user dashboard
    } else {
        alert(data.message); // Show error message from server
    }
}

function handleError(error) {
    console.error('Error en la solicitud:', error);
    alert(error.message || 'Ha ocurrido un error en la solicitud');
}