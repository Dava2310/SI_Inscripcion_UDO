const form = document.getElementById("form")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarAcceso/iniciarSesion.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);

        // Si hubo inicio de sesion
        if (data.message === 'Inicio de Sesión Usuario') {
            window.alert("Inicio de Sesion Exitoso");
            
            // Se verifica el Rol para mandarlo a la pagina correspondiente
            window.location = '../../views/dashboardEmpleados/dashboardEmpleados.php';

        } else if (data.message === 'Inicio de Sesión Estudiante') {
            window.alert("Inicio de Sesion Exitoso");
            
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
});