const form = document.getElementById("form");

const nameInput = document.getElementById("name");
const dateStartInput = document.getElementById("dateStart");
const dateEndInput = document.getElementById("dateEnd");

// Función validar nombre
function validateName() {
    if (nameInput.value.trim() === "") {
        document.getElementById("nameError").textContent = "Por favor, ingresa un nombre";
        document.getElementById("nameError").style.color = "red";
        return false;
    } else {
        document.getElementById("nameError").textContent = "";
        return true;
    }
}

// Función validar fecha de inicio
function validateStartDate() {
    if (dateStartInput.value === "") {
        document.getElementById("dateStartError").textContent = "Por favor, selecciona una fecha de inicio";
        document.getElementById("dateStartError").style.color = "red";
        return false;
    } else {
        document.getElementById("dateStartError").textContent = "";
        return true;
    }
}

// Función validar fecha de fin
function validateEndDate() {
    if (dateEndInput.value === "") {
        document.getElementById("dateEndError").textContent = "Por favor, selecciona una fecha de fin";
        document.getElementById("dateEndError").style.color = "red";
        return false;
    } else {
        document.getElementById("dateEndError").textContent = "";
        return true;
    }
}

// Función validar rango de fechas
function validateDateRange() {
    const startDate = new Date(dateStartInput.value);
    const endDate = new Date(dateEndInput.value);

    if (startDate >= endDate) {
        document.getElementById("dateEndError").textContent = "La fecha de fin debe ser posterior a la fecha de inicio";
        document.getElementById("dateEndError").style.color = "red";
        return false;
    } else {
        document.getElementById("dateEndError").textContent = "";
        return true;
    }
}

// Función validar todo el formulario
function validateForm() {
    const isNameValid = validateName();
    const isStartDateValid = validateStartDate();
    const isEndDateValid = validateEndDate();
    const isDateRangeValid = validateDateRange();

    // Si todas las validaciones son válidas, retorna true; de lo contrario, retorna false
    return isNameValid && isStartDateValid && isEndDateValid && isDateRangeValid;
}

form.addEventListener("submit", e => {
    e.preventDefault();

    // Validar todo el formulario
    const isFormValid = validateForm();

    if (!isFormValid) {
        alert("Por favor, corrija los errores en el formulario antes de enviarlo.");
        return;
    }

    // Si el formulario es válido, enviar los datos
    const formData = new FormData(form);

    fetch('../../controllers/gestionarPeriodos/crearPeriodos.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Creacion Periodo') {
                window.alert("Periodo creado exitosamente");
                window.location = "../../views/gestionarPeriodos/listarPeriodos.php";
            } else {
                alert('Error al crear el periodo');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
});
