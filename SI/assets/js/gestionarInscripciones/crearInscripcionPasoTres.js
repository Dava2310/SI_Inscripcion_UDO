document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('.formInput');
    const objectElement = document.getElementById('fileContent');
    const modal = document.getElementById("modal");
    const closeButton = document.getElementById('modalClose');

    function showModal(fileUrl) {
        objectElement.setAttribute('data', fileUrl);
        modal.style.display = "flex";
    }

    function hideModal() {
        objectElement.removeAttribute('data');
        modal.style.display = "none";
    }

    function clearInput(input) {
        input.value = '';
        input.removeAttribute('data-url');
        input.parentElement.firstElementChild.lastElementChild.style.display = 'none';
        input.parentElement.firstElementChild.classList.remove('fileUploaded');
        input.parentElement.firstElementChild.classList.add('pointerCursor');
        input.parentElement.firstElementChild.removeEventListener('click', disable);
        input.previousElementSibling.style.backgroundColor = '';
    }

    fileInputs.forEach(input => {
        const seeButton = input.parentElement.firstElementChild.lastElementChild.firstElementChild;
        const removeButton = input.parentElement.firstElementChild.lastElementChild.lastElementChild;

        input.parentElement.firstElementChild.classList.add('pointerCursor');

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
                input.parentElement.firstElementChild.lastElementChild.style.display = 'flex';
                input.parentElement.firstElementChild.classList.remove('pointerCursor');
                input.parentElement.firstElementChild.addEventListener('click', disable);
            }
        });

        removeButton.addEventListener('click', function () {
            clearInput(input);
            hideModal();
        });
    });

    const disable = e => e.preventDefault();

    // Evento de envío del formulario
    const form = document.getElementById('form');
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
                    window.alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                console.error(error);
                window.alert('Ha ocurrido un error en la solicitud');
            });
    });
});
