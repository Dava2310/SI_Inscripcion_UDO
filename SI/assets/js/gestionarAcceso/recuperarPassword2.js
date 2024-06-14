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

    if (isValid) {
        // Los datos del formulario son válidos, enviar formulario
        const formData = new FormData(form);
        fetch('../../controllers/gestionarAcceso/recuperarPassword.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.message === "Modificación con éxito") {
                alert(data.message);
                window.location.href = "../../views/gestionarAcceso/iniciarSesion.php";
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error(error));
    } else {
        alert(warnings);
    }
}

form.addEventListener("submit", (e) => {
    e.preventDefault();
    validateForm();
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
