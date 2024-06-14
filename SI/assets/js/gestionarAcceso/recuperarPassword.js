const form = document.getElementById("form");

// Expresiones regulares
const expresiones = {
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}

function emailIsValid() {
    const email = document.getElementById("email");
    const errorEmail = document.getElementById("errorEmail");

    let entrar = true;
    let warnings = "";

    if (!expresiones.email.test(email.value)) {
        warnings += `El Email electrónico no es válido.\n`;
        entrar = false;
        errorEmail.innerHTML = '<b>¡El Email no es valido! \n Ejemplo de Email valido: xxxx@gmail.com</b>';
        email.style.borderColor = 'red';
        return false;
    }
    return true;
}

// Evento de enviar Formulario
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!emailIsValid()) {
        return;
    }

    const formData = new FormData(form);

    try {
        const response = await fetch('../../controllers/gestionarAcceso/verificarEmail.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        console.log(data);

        const mensajesValidos = ["Estudiante verificado con éxito", "Usuario verificado con éxito"];

        if (mensajesValidos.includes(data.message)) {
            const id = data.student_id || data.user_id;
            const { security_question: securityQuestion, email } = data;

            window.location = `../../views/gestionarAcceso/recuperarPassword2.php?id=${id}&securityQuestion=${securityQuestion}&email=${email}`;
        } else {
            alert("No se ha encontrado un usuario con este correo");
        }
    } catch (error) {
        console.error('Se ha producido un error:', error);
    }
});
