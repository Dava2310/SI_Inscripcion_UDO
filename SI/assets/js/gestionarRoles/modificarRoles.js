const form = document.getElementById('form');
const deleteButton = document.getElementById('delete');

// Modificar Rol
form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    fetch(`../../controllers/gestionarRoles/modificarRoles.php?id=${id}`, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message);

            if (data.message === 'Actualizacion Rol') {
                window.alert("Se actualizaron los datos del Rol");
                window.location = './../../views/gestionarRoles/listarRoles.php';
            } else {
                alert('Error al actualizar');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
});