const form = document.getElementById("form");
const deleteButton = document.getElementById("delete");

// Modificar empleado
form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(form);
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");

  try {
    const response = await fetch(`../../controllers/gestionarUsuarios/modificarUsuarios.php?id=${id}`, {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || `Error en la solicitud: ${response.status}`);
    }

    if (data.message === "Usuario modificado exitosamente") {
      window.alert("Se actualizaron los datos del Empleado");
      window.location.href = "./../../views/gestionarUsuarios/listarUsuarios.php"; // Utiliza window.location.href para redireccionar
    } else {
      alert(data.message || "Error al actualizar");
    }
  } catch (error) {
    console.error(error);
    alert(error.message || "Ha ocurrido un error en la solicitud");
  }
});

// Borrar Empleado
deleteButton.addEventListener("click", async (e) => {
  let confirmation = window.confirm("¿Seguro que quieres eliminar este empleado?");
  if (!confirmation) {
    return;
  }

  try {
    const formData = new FormData(form);
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");

    const response = await fetch(`../../controllers/gestionarUsuarios/eliminarUsuarios.php?id=${id}`, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`Error en la solicitud: ${response.status}`);
    }

    const data = await response.json();
    console.log(data);

    if (data.message === "Eliminacion") {
      window.alert("Se eliminó el empleado");
      window.location.href = "./../../views/gestionarUsuarios/listarUsuarios.php";
    } else {
      alert("Error al eliminar");
    }
  } catch (error) {
    console.error(error);
    alert("Ha ocurrido un error en la solicitud");
  }
});

