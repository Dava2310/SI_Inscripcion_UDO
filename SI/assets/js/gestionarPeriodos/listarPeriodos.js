const createCareerButton = document.getElementById('create');

createCareerButton.addEventListener('click', e => {
    window.location = "../../views/gestionarPeriodos/crearPeriodos.php";
});

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', e => {
    const searchTerm = e.target.value.trim().toLowerCase();
    const rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        const periodName = row.cells[0].textContent.trim().toLowerCase();
        const periodDateStart = row.cells[1].textContent.trim().toLowerCase();
        const periodDateEnd = row.cells[2].textContent.trim().toLowerCase();
        const periodValidity = row.cells[3].textContent.trim().toLowerCase();

        if (periodName.includes(searchTerm) || periodDateStart.includes(searchTerm) || periodDateEnd.includes(searchTerm) || periodValidity.includes(searchTerm)) {
            row.style.display = ""; // Muestra las filas que coinciden
        } else {
            row.style.display = "none"; // Oculta las filas que no coinciden
        }
    });
});


