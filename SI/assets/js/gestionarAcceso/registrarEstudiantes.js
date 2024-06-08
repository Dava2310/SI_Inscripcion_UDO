import { validarDatos } from "../validaciones/estudiante.js";

const form = document.getElementById("form")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    // Se separan los valores que se reciben de la funcion validarDatos_Personales
    const [validacion, warnings] = validarDatos()

    if (validacion)
    {   
        //console.log("BIEN")

        const formData = new FormData(form);

        fetch('../../controllers/gestionarAcceso/registrarEstudiantes.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
    
            // Si hubo inicio de sesion
            if (data.message === 'Inicio de Sesion') {
                window.alert("Hubo inicio de sesion");
                
                // Se verifica el Rol para mandarlo a la pagina correspondiente
                window.location = '../../views/dashboardEstudiantes/dashboardEstudiantes.php';
    
            } else {
                alert('Credenciales de inicio de sesion incorrectas');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
    }
    else
    {
        alert(warnings)
    }
});