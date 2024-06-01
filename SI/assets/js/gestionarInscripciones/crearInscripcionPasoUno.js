const form = document.getElementById("form")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarInscripciones/crearInscripcionPasoUno.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Si hubo inicio de sesion
        if (data.message === 'Proceder') {
            window.alert("Se ha cargado con exito");
            window.location = "../../../views/dashboardEstudiantes/dashboardEstudiantes.php";
        }
        else
        {
            alert('Error al cargar datos');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});