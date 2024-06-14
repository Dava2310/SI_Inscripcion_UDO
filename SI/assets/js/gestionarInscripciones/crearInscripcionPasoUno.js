document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById("form");

    // Manejar el evento de envío del formulario
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log('Formulario enviado');
        submitForm();
    });

    // Manejar el evento del botón "Deshacer"
    document.querySelector('button[type="button"]').addEventListener('click', function (e) {
        e.preventDefault();
        console.log('Deshacer todo');
        form.reset();
    });
});

// Función para enviar el formulario
function submitForm() {
    const form = document.getElementById("form");
    const formData = new FormData(form);
    const action = form.action;

    fetch(action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Inscripción registrada exitosamente') {
                window.alert("Inscripción registrada con éxito");
                window.location.href = "../../../views/dashboardEstudiantes/dashboardEstudiantes.php";
            } else if (data.message === 'Inscripción corregida exitosamente') {
                window.alert("Inscripción registrada con éxito");
                window.location.href = "../../../views/dashboardEstudiantes/dashboardEstudiantes.php";
            } else {
                window.alert('Error al registrar la inscripción: ' + data.message);
            }
        })
        .catch(error => {
            console.error(error);
            window.alert('Ha ocurrido un error en la solicitud');
        });
}