var fileInputs = document.querySelectorAll('.formInput');
var objectElement = document.getElementById('fileContent');
var modal = document.getElementById("modal");
var closeButton = document.getElementById('modalClose');

var processSelect = document.getElementById('process');
var planillaDiv = document.getElementById('planilla');
var cartaDiv = document.getElementById('carta');


document.addEventListener('DOMContentLoaded', function () {
    fileInputs.forEach(input => {
        const seeButton = input.parentElement.firstElementChild.lastElementChild.firstElementChild;
        const removeButton = input.parentElement.firstElementChild.lastElementChild.lastElementChild;

        const disable = e => e.preventDefault()

        // See Button - Show modal
        seeButton.addEventListener('click', function () {
            modal.style.display = "flex";
        });

        // Close Button - Hide modal and clear data
        closeButton.addEventListener('click', function () {
            objectElement.removeAttribute('data');
            modal.style.display = "none";
        });

        // Establish default state for divs
        planillaDiv.style.display = 'none';
        cartaDiv.style.display = 'none';

        // Process dinamyc div display
        processSelect.addEventListener('change', function (e) {
            console.log('aaa');
            planillaDiv.style.display = (e.target.value === '1') ? 'block' : 'none';
            cartaDiv.style.display = (e.target.value === '2' || e.target.value === '3') ? 'block' : 'none';
        });

        // Change event for file input
        input.addEventListener('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onloadend = function () {
                    objectElement.setAttribute('data', reader.result);
                };
                reader.readAsDataURL(file);
                input.previousElementSibling.style.backgroundColor = '#4dca81';
                input.parentElement.firstElementChild.lastElementChild.style.display = 'block';

                input.parentElement.firstElementChild.addEventListener('click', disable);
                input.parentElement.firstElementChild.classList.add('no-pointer');
            }
        });

        // Remove File Upload Button - Clear data and reset styles
        removeButton.addEventListener('click', function () {
            input.value = '';
            objectElement.removeAttribute('data');
            input.parentElement.firstElementChild.lastElementChild.style.display = 'none';
            input.previousElementSibling.style.backgroundColor = '#cecece';

            input.parentElement.firstElementChild.removeEventListener('click', disable);
            input.parentElement.firstElementChild.classList.remove('no-pointer');
        });
    });
});