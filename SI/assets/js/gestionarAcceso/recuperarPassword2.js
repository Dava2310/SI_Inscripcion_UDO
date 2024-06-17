const form = document.getElementById("form");
const email = document.getElementById("email");
const securityQuestion = document.getElementById("securityQuestion");
const password = document.getElementById("password");
const repassword = document.getElementById("repassword");
const ID = document.getElementById("ID");
const errorPassword = document.getElementById("errorPassword");
const errorRepassword = document.getElementById("errorRepassword");

const passwordRegex = /^.{10,}$/;

function showError(element, message) {
    element.style.borderColor = 'red';
    element.nextElementSibling.innerHTML = message;
}

function clearError(element) {
    element.style.borderColor = '';
    element.nextElementSibling.innerHTML = '';
}

function validateForm() {
    let isValid = true;
    let warnings = "";

    // Validar contraseña
    if (!passwordRegex.test(password.value)) {
        warnings += "La contraseña no es válida. ";
        showError(password, '¡La contraseña debe tener mínimo 10 caracteres!');
        isValid = false;
    } else {
        clearError(password);
    }

    // Validar que las contraseñas coincidan
    if (password.value !== repassword.value) {
        warnings += "Las contraseñas no coinciden. ";
        showError(repassword, '¡Las contraseñas no coinciden!');
        isValid = false;
    } else {
        clearError(repassword);
    }

    return isValid ? null : { message: warnings };
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

function handlePasswordRecoveryResponse(data) {
    // Handle the response specific to password recovery
    if (data.message === "Modificación con éxito") {
        alert(data.message);
        window.location.href = "../../views/gestionarAcceso/iniciarSesion.php"; // Redirect to login page
    } else {
        alert(data.message); // Show error message from server
    }
}

function handleError(error) {
    console.error('Error en la solicitud:', error);
    alert(error.message || 'Ha ocurrido un error en la solicitud');
}

form.addEventListener("submit", async e => {
    e.preventDefault();

    const isInvalidFrontEndData = validateForm();

    if (isInvalidFrontEndData) {
        return alert(isInvalidFrontEndData.message);
    }

    const formData = new FormData(form);

    try {
        const data = await sendRequest(formData, '../../controllers/gestionarAcceso/recuperarPassword.php');
        handlePasswordRecoveryResponse(data);
    } catch (error) {
        handleError(error);
    }
});

window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const securityQuestionValue = urlParams.get('securityQuestion');
    const emailValue = urlParams.get('email');

    email.value = emailValue;
    email.readOnly = true;
    securityQuestion.value = securityQuestionValue;
    securityQuestion.readOnly = true;
    ID.value = id;
});
