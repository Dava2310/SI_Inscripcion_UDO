function showCareers() {
    var inscriptionProcess = document.getElementById("inscriptionProcess").value;
    var careersSelection = document.getElementById("careersSelection");
    var singleCareersSelection = document.getElementById("singleCareerSelection");

    if (inscriptionProcess === "2") {
        careersSelection.style.display = "block";
        singleCareersSelection.style.display = "none";
        // Agregar required a los campos de carreras múltiples
        document.getElementById("career1").setAttribute("required", "true");
        document.getElementById("career2").setAttribute("required", "true");
        document.getElementById("career3").setAttribute("required", "true");
        // Remover required del campo de carrera única
        document.getElementById("singleCareer").removeAttribute("required");
    } else {
        careersSelection.style.display = "none";
        singleCareersSelection.style.display = "block";
        // Remover required a los campos de carreras múltiples
        document.getElementById("career1").removeAttribute("required");
        document.getElementById("career2").removeAttribute("required");
        document.getElementById("career3").removeAttribute("required");
        // Agregar required al campo de carrera única
        document.getElementById("singleCareer").setAttribute("required", "true");
    }
}

function validateCareers() {
    var inscriptionProcess = document.getElementById("inscriptionProcess").value;

    if (inscriptionProcess === "2") {
        var career1 = document.getElementById("career1").value;
        var career2 = document.getElementById("career2").value;
        var career3 = document.getElementById("career3").value;

        if (career1 === career2 || career1 === career3 || career2 === career3) {
            alert("Las carreras seleccionadas no deben ser iguales.");
            return false; // Evita que el formulario sea enviado
        }
    }
    return true; // Permite que el formulario sea enviado
}

document.getElementById("form").addEventListener("submit", function(e) {
    // Asegurar que los campos requeridos estén configurados correctamente
    showCareers();

    if (!validateCareers()) {
        e.preventDefault(); // Evita que el formulario sea enviado
    } else {
        submitForm();
    }
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
            window.location.href = "../../views/dashboardEstudiantes/dashboardEstudiantes.php";
        } else if (data.message === 'Inscripción actualizada exitosamente') {
            window.alert("Inscripción actualizada con éxito");
            window.location.href = "../../views/dashboardEstudiantes/dashboardEstudiantes.php"; 
        } else {
            window.alert('Error al registrar la inscripción: ' + data.message);
        }
    })
    .catch(error => {
        console.error(error);
        window.alert('Ha ocurrido un error en la solicitud');
    });
}
