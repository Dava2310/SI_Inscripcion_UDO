const form = document.getElementById('form');
const deleteButton = document.getElementById('delete');

// Modificar Carrera
form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);
    let params = new URLSearchParams(window.location.search);
    let id = params.get('id');

    fetch('../../controllers/gestionarCarreras/modificarCarreras.php?id=' + id, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            
            if (data.message === 'Actualizacion Carrera') {
                window.alert("Se actualizaron los datos de la Carrera");
                window.location = './../../views/gestionarCarreras/listarCarreras.php';
            } else {
                alert('Error al actualizar');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
});

// Eliminar Carrera
deleteButton.addEventListener("click", e => {
    let confirmation = window.confirm("¿Seguro que quieres eliminar esta Carrera?");
    if (!confirmation) {
        return;
    } else {

        const formData = new FormData(form);
        let params = new URLSearchParams(window.location.search);
        let id = params.get('id');

        fetch('../../controllers/gestionarCarreras/eliminarCarreras.php?id=' + id, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);

                // Si hubo inicio de sesion
                if (data.message === 'Eliminacion') {
                    window.alert("Se elimino la carrera");

                    // Se verifica el Rol para mandarlo a la pagina correspondiente
                    window.location = './../../views/gestionarCarreras/listarCarreras.php';
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
