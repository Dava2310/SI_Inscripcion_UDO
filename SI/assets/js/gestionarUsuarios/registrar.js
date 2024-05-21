const form = document.getElementById("form")
const email = document.getElementById("email")
const pasword = document.getElementById("password")

form.addEventListener("submit", e => {
    
    e.preventDefault();

    const formData = new FormData(form);
// 

    fetch('../../controllers/gestionarUsuarios/registrar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message)
        // Si hubo inicio de sesion
        if (data.message === 'Registro exitoso') {
            window.alert("Registro exitoso");
        }
        else
        {
            console.log("hola");
            alert('Error al registrar usuario');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Ha ocurrido un error en la solicitud');
    });
});