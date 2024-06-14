const decisionSelect = document.getElementById('decision');
const observationsDiv = document.getElementById('observations');
const inscriptionProcess = document.getElementById("inscriptionProcess").value;
const form = document.getElementById("form");

decisionSelect.addEventListener('change', function () {
    if (decisionSelect.value === 'reject') {
        observationsDiv.style.display = 'block';
    } else {
        observationsDiv.style.display = 'none';
    }
});


form.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log('Formulario enviado');
    submitForm();
});

// Función para enviar el formulario
function submitForm() {
    const formData = new FormData(form);
    const action = form.action;

    fetch(action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Inscripción aprobada exitosamente') {
                window.alert("Inscripción aprobada con éxito");
                window.location.href = "../../../views/gestionarInscripciones/listarInscripciones.php";
            } else if (data.message === 'Inscripción rechazada exitosamente') {
                window.alert("Inscripción rechazada con éxito");
                window.location.href = "../../../views/gestionarInscripciones/listarInscripciones.php";
            } else {
                window.alert('Error al aprobar la inscripción: ' + data.message);
            }
        })
        .catch(error => {
            console.error(error);
            window.alert('Ha ocurrido un error en la solicitud');
        });
}