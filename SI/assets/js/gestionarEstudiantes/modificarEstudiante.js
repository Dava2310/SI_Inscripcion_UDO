const form = document.getElementById('form');
const deleteButton = document.getElementById('delete');

form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);
    let params = new URLSearchParams(window.location.search);
    let id = params.get('id');

    fetch('../../controllers/gestionarEstudiantes/modificarEstudiante.php?id=' + id, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);

            // Si hubo inicio de sesion
            if (data.message === 'Actualizacion') {
                window.alert("Se actualizaron los datos del estudiante");

                // Se verifica el Rol para mandarlo a la pagina correspondiente
                window.location = './../../views/gestionarEstudiantes/listarEstudiantes.php';

            } else {
                alert('Error al actualizar');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
});

deleteButton.addEventListener("click", e => {
    let confirmation = window.confirm("¿Seguro que quieres eliminar este estudiante?");
    if (!confirmation) {
        return;
    } else {

        const formData = new FormData(form);
        let params = new URLSearchParams(window.location.search);
        let id = params.get('id');

        fetch('../../controllers/gestionarEstudiantes/eliminarEstudiante.php?id=' + id, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);

                // Si hubo inicio de sesion
                if (data.message === 'Eliminacion') {
                    window.alert("Se elimino el estudiante");

                    // Se verifica el Rol para mandarlo a la pagina correspondiente
                    window.location = './../../views/gestionarEstudiantes/listarEstudiantes.php';
                } else {
                    alert('Error al eliminar');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Ha ocurrido un error en la solicitud');
            });
    }
});
