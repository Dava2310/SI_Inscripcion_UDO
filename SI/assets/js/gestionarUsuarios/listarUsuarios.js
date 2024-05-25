const createUserButton = document.getElementById('create');

createUserButton.addEventListener('click', e => {
    window.location = "../../../views/gestionarUsuarios/crearUsuarios.php";
});

// Filtro de usuarios
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', e => {
    let searchTerm = e.target.value.toLowerCase();
    let rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        let userName = row.cells[0].textContent.toLowerCase();
        let userLastName = row.cells[1].textContent.toLowerCase();
        let userLicenseID = row.cells[2].textContent.toLowerCase();
        let userEmail = row.cells[3].textContent.toLowerCase();
        if (userEmail.includes(searchTerm) || userName.includes(searchTerm) || userLastName.includes(searchTerm) || userLicenseID.includes(searchTerm)) {
            row.style.display = ""; // muestra las filas que coinciden
        } else {
            row.style.display = "none"; // oculta las filas que no coinciden
        }
    });
});

