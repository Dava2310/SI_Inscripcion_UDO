import { validarDatos } from "../validaciones/estudiante.js";

// Añadir todas las validaciones con respecto a estudiante
// import { validarCedula } from "../validaciones/validacion_campos.js";

const form = document.getElementById("form");

// Agarrando los campos
const licenseID = document.getElementById("licenseID");

form.addEventListener("submit", e => {
    e.preventDefault();

    // // SI LA VALIDACION FUNCIONA, PASA TODO ESTO
    // respuesta = verificar();

    // if (respuesta == true)
    // {
    //     // Pasa todo
    // }
    // else
    // {
    //     // No pasa nada
    // }

    const [validacion, warnings] = validarDatos();

    if (validacion) {
        const formData = new FormData(form);

        fetch('../../controllers/gestionarAcceso/registrarEstudiantes.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.json().then(data => {
                if (!response.ok) {
                    throw new Error(data.message || 'Hubo un problema con la solicitud: ' + response.status);
                }
                return data;
            });
        })
        .then(data => {
            if (data.message === 'Registro exitoso') {
                window.alert("Registro de estudiante exitoso");
                window.location = '../../views/gestionarAcceso/iniciarSesion.php';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            alert(error.message || 'Ha ocurrido un error en la solicitud');
        });
    } else {
        alert(warnings);
    }
});

// function verificar(){
//     cedula = validarCedula(licenseID)
//     // Para cada campo

//     return true;

// }

