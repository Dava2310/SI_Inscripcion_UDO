// Filtro de Estudiantes
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', e => {
    let searchTerm = e.target.value.toLowerCase();
    let rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        let studentName = row.cells[0].textContent.toLowerCase();
        let studentLastName = row.cells[1].textContent.toLowerCase();
        let studentLicenseID = row.cells[2].textContent.toLowerCase();
        let studentEmail = row.cells[3].textContent.toLowerCase();
        if ( studentEmail.includes(searchTerm) || studentName.includes(searchTerm) || studentLastName.includes(searchTerm) || studentLicenseID.includes(searchTerm)) {
            row.style.display = ""; // muestra las filas que coinciden
        } else {
            row.style.display = "none"; // oculta las filas que no coinciden
        }
    });
});
