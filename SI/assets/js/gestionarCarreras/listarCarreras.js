const createCareerButton = document.getElementById('create');

createCareerButton.addEventListener('click', e => {
    window.location = "../../views/gestionarCarreras/crearCarreras.php";
});

// Filtro de Carreras
const searchInput = document.getElementById('searchInput');



searchInput.addEventListener('keyup', e => {
    let searchTerm = e.target.value.toLowerCase();
    let rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        let careerName = row.cells[0].textContent.toLowerCase();
        let careerDescription = row.cells[1].textContent.toLowerCase();
        if ( careerName.includes(searchTerm) || careerDescription.includes(searchTerm)) {
            row.style.display = ""; // muestra las filas que coinciden
        } else {
            row.style.display = "none"; // oculta las filas que no coinciden
        }
    });
});

