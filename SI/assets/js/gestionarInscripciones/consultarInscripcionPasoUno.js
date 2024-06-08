const form = document.getElementById("form");

let buttonPressed = '';


form.addEventListener('submit', e => {
    e.preventDefault();
    console.log('formulario');
    console.log(form.action);
})

document.getElementById('approveButton').addEventListener('click', function(e) {
    e.preventDefault();
    console.log('boton');
    form.action = form.action + "&approved=true";
    form.submit();
    consultarInscripcionPasoUno(form.action);
});

document.getElementById('rejectButton').addEventListener('click', function(e) {
    e.preventDefault();
    console.log('boton');
    form.action = form.action + "&approved=false";
    form.submit()
    consultarInscripcionPasoUno(form.action);
});

function consultarInscripcionPasoUno(action) {
    const formData = new FormData(form);

    fetch(action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message)
        // Si hubo inicio de sesion
        if (data.message === 'Proceder') {
            window.alert("Se ha cargado la revision con exito");
            window.location = "../../../views/dashboardEmpleados/dashboardEmpleados.php";
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
}

