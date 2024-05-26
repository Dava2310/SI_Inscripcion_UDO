document.addEventListener('DOMContentLoaded', function() {
    var fileInputs = document.querySelectorAll('.form-input');

    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            if (input.files.length > 0) {
                input.previousElementSibling.style.backgroundColor = 'green';
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    var processSelect = document.querySelector('#process');
    var planillaDiv = document.querySelector('#planilla-upload').parentNode;

    planillaDiv.style.display = 'none'; // Ocultar inicialmente

    processSelect.addEventListener('change', function() {
        if (processSelect.value === 'opsu') {
            planillaDiv.style.display = 'block'; // Mostrar si OPSU es seleccionado
        } else {
            planillaDiv.style.display = 'none'; // Ocultar si otra opción es seleccionada
        }
    });
});
