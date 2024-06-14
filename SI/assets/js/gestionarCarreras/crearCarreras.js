const form = document.getElementById("form")

form.addEventListener("submit", e => {
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarCarreras/crearCarreras.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        if (data.message === 'Creacion Carrera') {
            window.alert("Carrera creada exitosamente");
            window.location = "../../views/gestionarCarreras/listarCarreras.php";
        } else {
            alert('Error al crear carrera');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});
