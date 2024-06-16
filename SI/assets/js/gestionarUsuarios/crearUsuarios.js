const form = document.getElementById("form");
const email = document.getElementById("email");
const password = document.getElementById("password");

form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarUsuarios/CrearUsuarios.php', {
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

