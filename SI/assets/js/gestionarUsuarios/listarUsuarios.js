const createUserButton = document.getElementById('create');

createUserButton.addEventListener('click', () => {
    window.location.href = "../../views/gestionarUsuarios/crearUsuarios.php";
});

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.trim().toLowerCase();
    const rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        const userName = row.cells[0].textContent.toLowerCase();
        const userLastName = row.cells[1].textContent.toLowerCase();
        const userLicenseID = row.cells[2].textContent.toLowerCase();
        const userEmail = row.cells[3].textContent.toLowerCase();
        const match = userName.includes(searchTerm) || userLastName.includes(searchTerm) || userLicenseID.includes(searchTerm) || userEmail.includes(searchTerm);
        row.style.display = match ? "" : "none";
    });
});

