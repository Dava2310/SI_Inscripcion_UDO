const form = document.getElementById("form");
const saveButton = document.getElementById("save");

const nameInput = document.getElementById("name");
const dateStartInput = document.getElementById("dateStart");
const dateEndInput = document.getElementById("dateEnd");

const deleteButton = document.getElementById("delete");
const activateButton = document.getElementById("activate");
const finishButton = document.getElementById("finish");

// Función para ocultar/mostrar botones según el estado del periodo
function configureButtons(status) {
    if (status === 0) { // Sin empezar
        finishButton.style.display = "none";
    } else if (status === 1) { // Empezado
        activateButton.style.display = "none";
        deleteButton.style.display = "none";
    } else if (status === 2) { // Terminado
        activateButton.style.display = "none";
        finishButton.style.display = "none";
        deleteButton.style.display = "none";
        nameInput.disabled = true;
        dateStartInput.disabled = true;
        dateEndInput.disabled = true;
        saveButton.style.display = "none";
    }
}

// Llamar a la función para configurar botones
configureButtons(periodStatus);

form.addEventListener("submit", e => {
    e.preventDefault();

    if (!validateForm()) {
        return;
    }

    const formData = new FormData(form);

    fetch('../../controllers/gestionarPeriodos/modificarPeriodos.php?id='+ periodID, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Actualizacion Periodo') {
                window.alert("Periodo actualizado exitosamente");
                window.location = "../../views/gestionarPeriodos/listarPeriodos.php";
            } else {
                alert('Error al actualizar el periodo');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Ha ocurrido un error en la solicitud');
        });
});

deleteButton.addEventListener("click", () => {
    if (confirm("¿Estás seguro de que deseas eliminar este periodo?")) {
        fetch('../../controllers/gestionarPeriodos/eliminarPeriodos.php?id=' + periodID, {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                if (data.message === 'Eliminacion Periodo') {
                    window.alert("Periodo eliminado exitosamente");
                    window.location = "../../views/gestionarPeriodos/listarPeriodos.php";
                } else {
                    alert('Error al eliminar el periodo');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Ha ocurrido un error en la solicitud');
            });
    }
});

activateButton.addEventListener("click", () => {
    if (confirm("¿Estás seguro de que deseas empezar este periodo?")) {
        fetch('../../../controllers/gestionarPeriodos/activarPeriodos.php?id=' + periodID, {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                if (data.message === 'Activacion Periodo') {
                    window.alert("Periodo activado exitosamente");
                    window.location = "../../views/gestionarPeriodos/listarPeriodos.php";
                } else {
                    alert('Error al activar el periodo');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Ha ocurrido un error en la solicitud');
            });
    }
});

finishButton.addEventListener("click", () => {
    if (confirm("¿Estás seguro de que deseas terminar este periodo?")) {
        fetch('../../../controllers/gestionarPeriodos/terminarPeriodos.php?id=' + periodID, {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                if (data.message === 'Terminacion Periodo') {
                    window.alert("Periodo terminado exitosamente");
                    window.location = "../../views/gestionarPeriodos/listarPeriodos.php";
                } else {
                    alert('Error al terminar el periodo');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Ha ocurrido un error en la solicitud');
            });
    }
});

// Funciones de validación

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

function validateForm() {
    const isNameValid = validateName();
    const isStartDateValid = validateStartDate();
    const isEndDateValid = validateEndDate();
    const isDateRangeValid = validateDateRange();

    return isNameValid && isStartDateValid && isEndDateValid && isDateRangeValid;
}
