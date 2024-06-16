const form = document.getElementById("form")
const email = document.getElementById("email")
const pasword = document.getElementById("password")

form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarUsuarios/CrearUsuarios.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.message === 'Usuario creado exitosamente') {
            const message = "Creación exitosa. La contraseña del empleado es su cédula. Recuerdele al empleado que deberá cambiar su contraseña por una de su preferencia.";
            window.alert(message);
            window.location.href = "../../views/gestionarUsuarios/listarUsuarios.php";
        } else {
            console.error(data.message);
            alert('Error al crear usuario');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});
