const form = document.getElementById('form');
const deleteButton = document.getElementById('delete');

// Modificar Carrera
form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    fetch(`../../controllers/gestionarCarreras/modificarCarreras.php?id=${id}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        
        if (data.message === 'Actualizacion Carrera') {
            window.alert("Los datos de la carrera se actualizaron correctamente");
            window.location = './../../views/gestionarCarreras/listarCarreras.php';
        } else {
            alert('Error al actualizar la carrera');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});


// Eliminar Carrera
deleteButton.addEventListener("click", e => {
    let confirmation = window.confirm("¿Seguro que quieres eliminar esta carrera?");
    if (!confirmation) {
        return;
    } else {
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');

        fetch(`../../controllers/gestionarCarreras/eliminarCarreras.php?id=${id}`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);

            if (data.message === 'Eliminacion') {
                window.alert("Se eliminó la carrera correctamente");
                window.location = './../../views/gestionarCarreras/listarCarreras.php';
            } else {
                alert('Error al eliminar la carrera');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
    }
});

