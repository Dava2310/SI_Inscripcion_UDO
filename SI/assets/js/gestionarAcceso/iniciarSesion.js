const form = document.getElementById("form")
const cedula = document.getElementById("cedula")
const contrasena = document.getElementById("contrasena")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../../controllers/gestionarAcceso/iniciarSesion.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);

        // Si hubo inicio de sesion
        if (data.message === 'Inicio de Sesion Usuario') {
            window.alert("Hubo inicio de sesion");
            
            // Se verifica el Rol para mandarlo a la pagina correspondiente
            window.location = '../../../views/dashboardEmpleados/dashboardEmpleados.php';

        } else if (data.message === 'Inicio de Sesion Estudiante') {
            window.alert("Hubo inicio de sesion");
            
            // Se verifica el Rol para mandarlo a la pagina correspondiente
            window.location = '../../../views/dashboardEstudiantes/dashboardEstudiantes.php';
        } else {
            alert('Credenciales de inicio de sesion incorrectas');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});