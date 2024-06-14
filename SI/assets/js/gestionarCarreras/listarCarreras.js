const createCareerButton = document.getElementById('create');

createCareerButton.addEventListener('click', e => {
    window.location = "../../views/gestionarCarreras/crearCarreras.php";
});

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', e => {
    const searchTerm = e.target.value.trim().toLowerCase();
    const rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        const careerName = row.cells[0].textContent.trim().toLowerCase();
        const careerDescription = row.cells[1].textContent.trim().toLowerCase();
        const careerCode = row.cells[2].textContent.trim().toLowerCase();

        if (careerName.includes(searchTerm) || careerDescription.includes(searchTerm) || careerCode.includes(searchTerm)) {
            row.style.display = ""; // Muestra las filas que coinciden
        } else {
            row.style.display = "none"; // Oculta las filas que no coinciden
        }
    });
});


