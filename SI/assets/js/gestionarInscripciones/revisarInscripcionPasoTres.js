const form = document.getElementById("form");

document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('.formInput');
    const objectElement = document.getElementById('fileContent');
    const modal = document.getElementById("modal");
    const closeButton = document.getElementById('modalClose');
    const resetButton = document.getElementById('resetButton');

    // Mostrar el modal con el archivo
    function showModal(fileUrl) {
        objectElement.src = fileUrl;
        modal.style.display = "flex";
    }

    // Ocultar el modal
    function hideModal() {
        objectElement.src = '';
        modal.style.display = "none";
    }

    // Inicializar los inputs con los URLs
    fileInputs.forEach(input => {
        const disable = e => e.preventDefault();
        const fileUrl = input.getAttribute('data-url');

        

        if (fileUrl) {
            input.previousElementSibling.style.backgroundColor = '#4dca81';
            input.parentElement.firstElementChild.classList.add('fileUploaded');
            input.parentElement.firstElementChild.lastElementChild.style.display = 'block';
            input.parentElement.firstElementChild.classList.remove('pointerCursor');
            input.parentElement.firstElementChild.addEventListener('click', disable);
        }

        const seeButton = input.parentElement.firstElementChild.lastElementChild.firstElementChild;

        seeButton.addEventListener('click', function () {
            const fileUrl = input.getAttribute('data-url');
            if (fileUrl) {
                showModal(fileUrl);
            } else {
                alert("No hay ningún archivo para mostrar.");
            }
        });

        closeButton.addEventListener('click', function () {
            hideModal();
        });

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onloadend = function () {
                    input.setAttribute('data-url', reader.result);
                };
                reader.readAsDataURL(file);
                input.previousElementSibling.style.backgroundColor = '#4dca81';
                input.parentElement.firstElementChild.classList.add('fileUploaded');
                input.parentElement.firstElementChild.lastElementChild.style.display = 'block';
                input.parentElement.firstElementChild.classList.remove('pointerCursor');
                input.parentElement.firstElementChild.addEventListener('click', disable);
            }
        });

    });

    

    // Evento de envío del formulario
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('../../../controllers/gestionarInscripciones/crearInscripcionPasoTres.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
            .then(data => {
                console.log(data.message);
                if (data.message === 'Documentos subidos exitosamente') {
                    window.alert("Documentos subidos exitosamente");
                    window.location.href = "../../../views/dashboardEstudiantes/dashboardEstudiantes.php";
                } else {
                    window.alert('Error: ' + data.errors[0]);
                }
            })
            .catch(error => {
                console.error(error);
                window.alert('Ha ocurrido un error en la solicitud');
            });
    });

    // Evento para resetear el formulario
    resetButton.addEventListener('click', function () {
        fileInputs.forEach(input => {
            clearInput(input);
        });
    });  
    
    

});


const decisionSelect = document.getElementById('decision');
const observationsDiv = document.getElementById('observations');

decisionSelect.addEventListener('change', function () {
    if (decisionSelect.value === 'reject') {
        observationsDiv.style.display = 'block';
    } else {
        observationsDiv.style.display = 'none';
    }
});