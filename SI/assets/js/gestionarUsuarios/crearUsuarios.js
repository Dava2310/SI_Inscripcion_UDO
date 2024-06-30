const form = document.getElementById("form");
const email = document.getElementById("email");
const password = document.getElementById("password");

form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarUsuarios/crearUsuarios.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            return response.json().then(data => {
                if (!response.ok) {
                    throw new Error(data.message || 'Error en la solicitud: ' + response.status);
                }
                return data;
            });
        })
        .then(data => {
            if (data.message === 'Usuario creado exitosamente') {
                const message = "Creación exitosa. La contraseña del empleado es su cédula. Recuérdele al empleado que deberá cambiar su contraseña por una de su preferencia.";
                window.alert(message);
                window.location.href = "../../views/gestionarUsuarios/listarUsuarios.php";
            } else {
                console.error(data.message);
                alert('Error al crear usuario');
            }
        })
        .catch(error => {
            console.error(error);
            alert(error.message || 'Ha ocurrido un error en la solicitud');
        });
});

const clear = document.getElementById('clear');

clear.addEventListener('click', () => {
    // Obtén las referencias a los campos de entrada
    const nameInput = document.getElementById('name');
    const lastNameInput = document.getElementById('lastName');
    const emailInput = document.getElementById('email');
    const licenseIDInput = document.getElementById('licenseID');

    // Limpia los valores de los campos
    nameInput.value = '';
    lastNameInput.value = '';
    emailInput.value = '';
    licenseIDInput.value = '';

    // También puedes borrar los mensajes de error si los tienes
    const errorName = document.getElementById('errorName');
    const errorLastname = document.getElementById('errorLastname');
    const errorEmail = document.getElementById('errorEmail');
    const errorLicenseID = document.getElementById('errorLicenseID');

    errorName.textContent = '';
    errorLastname.textContent = '';
    errorEmail.textContent = '';
    errorLicenseID.textContent = '';
});