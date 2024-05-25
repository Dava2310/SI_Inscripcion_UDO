const form = document.getElementById("form")
const email = document.getElementById("email")
const pasword = document.getElementById("password")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    const formData = new FormData(form);

    fetch('../../controllers/gestionarUsuarios/CrearUsuarios.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message)
        // Si hubo inicio de sesion
        if (data.message === 'Creacion') {
            window.alert("Creacion exitosa");
            window.location = "../../../views/gestionarUsuarios/listarUsuarios.php";
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