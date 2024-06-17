const form = document.getElementById("form");

form.addEventListener("submit", async e => {
    e.preventDefault();

    const isInvalidFrontEndData = validateFrontEndData();

    if (isInvalidFrontEndData) {
        return alert(isInvalidFrontEndData.message);
    }

    const formData = new FormData(form);

    try {
        const data = await sendRequest(formData, '../../controllers/gestionarAcceso/iniciarSesion.php');
        handleLoginResponse(data);
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

function handleLoginResponse(data) {
    if (data.message === 'Inicio de Sesión Usuario') {
        window.alert("Inicio de Sesion Exitoso");
        window.location = '../../views/dashboardEmpleados/dashboardEmpleados.php';
    } else if (data.message === 'Inicio de Sesión Estudiante') {
        window.alert("Inicio de Sesion Exitoso");
        window.location = '../../views/dashboardEstudiantes/dashboardEstudiantes.php';
    } else {
        alert(data.message);
    }
}

function handleError(error) {
    console.error('Error en la solicitud:', error);
    alert(error.message || 'Ha ocurrido un error en la solicitud');
}
