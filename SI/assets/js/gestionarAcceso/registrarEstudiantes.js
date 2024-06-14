import { validarDatos } from "../validaciones/estudiante.js";

const form = document.getElementById("form")

form.addEventListener("submit", e => {
    e.preventDefault();

    const [validacion, warnings] = validarDatos();

    if (validacion) {
        const formData = new FormData(form);

        fetch('../../controllers/gestionarAcceso/registrarEstudiantes.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Hubo un problema con la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.message === 'Registro exitoso') {
                window.alert("Registro de estudiante exitoso");
                window.location = '../../views/gestionarAcceso/iniciarSesion.php';
            } else {
                alert('Error al registrar estudiante');
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            alert('Ha ocurrido un error en la solicitud');
        });
    } else {
        alert(warnings);
    }
});
