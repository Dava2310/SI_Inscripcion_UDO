const form = document.getElementById("form");

form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarNotificaciones/crearNotificaciones.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Creacion Notificacion') {
                window.alert("Notificacion creada exitosamente");
                window.location = "../../views/gestionarNotificaciones/listarNotificaciones.php";
            } else {
                alert('Error al crear la notificacion');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
});