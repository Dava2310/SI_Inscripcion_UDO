// Filtro de Notificaciones
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', e => {
    let searchTerm = e.target.value.toLowerCase();
    let rows = document.querySelectorAll('.dataList');

    rows.forEach(row => {
        let notificationType = row.cells[0].textContent.toLowerCase();
        let notificationDate = row.cells[1].textContent.toLowerCase();
        let notificationContent = row.cells[2].textContent.toLowerCase();
        
        if (notificationType.includes(searchTerm) || notificationDate.includes(searchTerm) || notificationContent.includes(searchTerm)) {
            row.style.display = ""; // muestra las filas que coinciden
        } else {
            row.style.display = "none"; // oculta las filas que no coinciden
        }
    });
});
