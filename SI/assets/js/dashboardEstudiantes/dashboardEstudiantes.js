document.querySelectorAll('li').forEach(function(el) {
    if(el.querySelector('ul.submenu')) {
        el.addEventListener('mouseover', function() {
            this.querySelector('ul.submenu').style.display = 'block';
        });
        el.addEventListener('mouseout', function() {
            this.querySelector('ul.submenu').style.display = 'none';
        });
    }
});

// Proceso para la modificacion de los datos de perfil
const form = document.getElementById('form')

form.addEventListener("submit", e => {

    e.preventDefault()

    const formData = new FormData(form)
    fetch('../../controllers/perfil/estudiante.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.json().then(data => {
            if (!response.ok) {
                throw new Error(data.message || 'Error en la solicitud: ' + response.status);
            }
            return data;
        });
    })
    .then(data => {
        if (data.message === 'Modificacion exitosa') {
            const message = "Los datos se actualizaron correctamente.";
            window.alert(message);
            window.location.href = "../../views/dashboardEstudiantes/dashboardEstudiantes.php";
        } else {
            console.error(data.message);
            alert('Error al modificar los datos');
        }
    })
    .catch(error => {
        console.error(error);
        alert(error.message || 'Ha ocurrido un error en la solicitud');
    });
    

})
