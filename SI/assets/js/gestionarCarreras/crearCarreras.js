const form = document.getElementById("form")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarCarreras/CrearCarreras.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message)
        // Si hubo inicio de sesion
        if (data.message === 'Creacion Carrera') {
            window.alert("Creacion exitosa");
            window.location = "../../../views/gestionarCarreras/listarCarreras.php";
        }
        else
        {
            console.log("hola");
            alert('Error al crear usuario');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});