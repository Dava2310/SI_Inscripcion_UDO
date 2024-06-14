const form = document.getElementById("form")

form.addEventListener("submit", e => {
    e.preventDefault();

    const password = document.getElementById("password").value;
    const repassword = document.getElementById("repassword").value;

    if (password !== repassword) {
        return alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
    }

    const formData = new FormData(form);

    fetch('../../controllers/gestionarAcceso/crearPreguntaSeguridad.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data);


        if (data.message === 'Pregunta de seguridad creada exitosamente') {

            window.alert("Pregunta de seguridad creada exitosamente");
            window.location = '../../views/dashboardEmpleados/dashboardEmpleados.php';
        } else {
            alert('Error al crear la pregunta de seguridad');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});
