const form = document.getElementById("form");
const deleteButton = document.getElementById("delete");

// Modificar empleado
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(form);
  let params = new URLSearchParams(window.location.search);
  let id = params.get("id");

  fetch("../../controllers/gestionarUsuarios/modificarUsuarios.php?id=" + id, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      //console.log(data.message);

      // Si hubo inicio de sesion
      if (data.message === "Actualizacion") {
        window.alert("Se actualizaron los datos del Empleado");

        // Se verifica el Rol para mandarlo a la pagina correspondiente
        window.location = "./../../views/gestionarUsuarios/listarUsuarios.php";
      } else {
        alert("Error al actualizar");
      }
    })
    .catch((error) => {
      console.error(error);
      alert("Ha ocurrido un error en la solicitud");
    });
});

// Borrar Empleado
deleteButton.addEventListener("click", (e) => {
  let confirmation = window.confirm(
    "¿Seguro que quieres eliminar este empleado?"
  );
  if (!confirmation) {
    return;
  } else {
    const formData = new FormData(form);
    let params = new URLSearchParams(window.location.search);
    let id = params.get("id");

    fetch("../../controllers/gestionarUsuarios/eliminarUsuarios.php?id=" + id, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        //console.log(data.message);

        // Si hubo inicio de sesion
        if (data.message === "Eliminacion") {
          window.alert("Se elimino el empleado");

          // Se verifica el Rol para mandarlo a la pagina correspondiente
          window.location =
            "./../../views/gestionarUsuarios/listarUsuarios.php";
        } else {
          alert("Error al eliminar");
        }
      })
      .catch((error) => {
        console.error(error);
        alert("Ha ocurrido un error en la solicitud");
      });
  }
});
