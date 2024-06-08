// Esta función permitirá la validación de los datos para la creación de un estudiante
export function validarDatos() {   
    const licenseID = document.getElementById("licenseID");
    const name = document.getElementById("name");
    const lastName = document.getElementById("lastName");
    const email = document.getElementById("email");
    const date = document.getElementById("date");
    const nationality = document.getElementById("nationality");
    const phoneNumber = document.getElementById("phoneNumber");
    const address = document.getElementById("address");
    const password = document.getElementById("password");
    const repassword = document.getElementById("repassword");
    const securityAnswer = document.getElementById("securityAnswer");

    const errorLicenseID = document.getElementById("errorLicenseID");
    const errorName = document.getElementById("errorName");
    const errorLastName = document.getElementById("errorLastName");
    const errorEmail = document.getElementById("errorEmail");
    const errorPhoneNumber = document.getElementById("errorPhoneNumber");
    const errorAddress = document.getElementById("errorAddress");
    const errorPassword = document.getElementById("errorPassword");
    const errorRepassword = document.getElementById("errorRepassword");
    const errorAnswer = document.getElementById("errorAnswer");

    // Expresiones regulares por las cuales serán evaluados los datos
    const expresiones = {
        name: /^[a-zA-ZÀ-ÿ\s]{2,40}$/, // Letras y espacios, pueden llevar acentos.
        lastName: /^[a-zA-ZÀ-ÿ\s]{2,40}$/,
        licenseID: /^([VEJPG]-)?\d{6,9}$/i,
        email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        phoneNumber: /^(?:\+58)?[2469]\d{9}$/, // Numero de telefono formato Venezuela, con +58 más 10 dígitos
        date: /.+/, // No está vacío
        nationality: /.+/, // No está vacío
        address: /^.{1,49}$/, // No está vacío y no más de 49 caracteres
        password: /^.{10,}$/, // No está vacío y al menos 10 caracteres
        securityAnswer: /.+/ // No está vacío
    };

    // Esta variable guarda el estado según es permitido o no que sea registrado el estudiante
    let validacion = true;

    // Esta variable irá guardando la cantidad de errores que fueron lanzados por cada campo
    let warnings = "Los siguientes campos no son validos: \n";

    if (!(expresiones.licenseID.test(licenseID.value))) {
        warnings += 'Cedula\n'; // 
        validacion = false;
        licenseID.style.borderColor = 'red';
        errorLicenseID.innerHTML = '<b>¡La Cedula debe contener de 6 a 8 numeros. Los formatos pueden ser: V-XXXXXXXX ; E-XXXXXXXX ; J-XXXXXXXX ; P-XXXXXXXX ; G-XXXXXXXX ; XXXXXXXX</b>';
    }
    else {
        errorLicenseID.innerHTML = ''
        licenseID.style.borderColor = ''
    }

    if (!(expresiones.name.test(name.value))) {
        warnings += 'Nombres\n'; // 
        validacion = false;
        name.style.borderColor = 'red';
        errorName.innerHTML = '<b>¡El nombre solo debe contener letras, de 2 a 40 caracteres!</b>'
    }
    else {
        errorName.innerHTML = ''
        name.style.borderColor = ''
    }

    if (!(expresiones.lastName.test(lastName.value))) {
        warnings += 'Apellidos\n'; // 
        validacion = false;
        lastName.style.borderColor = 'red';
        errorLastName.innerHTML = '<b>¡El apellido solo debe contener letras, de 2 a 40 caracteres!</b>'
    }
    else {
        errorLastName.innerHTML = ''
        lastName.style.borderColor = ''
    }

    if (!(expresiones.email.test(email.value))) {
        warnings += 'Correo\n'; // 
        validacion = false;
        email.style.borderColor = 'red';
        errorEmail.innerHTML = '<b>¡El Correo no es valido!</b>';
    }
    else {
        errorEmail.innerHTML = ''
        email.style.borderColor = ''
    }

    if (!(expresiones.phoneNumber.test(phoneNumber.value))) {
        warnings += 'Numero de Telefono\n'; // 
        validacion = false;
        phoneNumber.style.borderColor = 'red';
        errorPhoneNumber.innerHTML = '<b>¡el numero de telefono debe contener de 10 digitos sin contar el codigo de area(+58). Los formatos pueden ser: +584126548778 / 4126548778 </b>'
    }
    else {
        errorPhoneNumber.innerHTML = ''
        phoneNumber.style.borderColor = ''
    }

    if (!date.value) {
        warnings += 'Fecha de Nacimiento\n'; // 
        validacion = false;
        date.style.borderColor = 'red';
    }
    else {
        date.style.borderColor = ''
    }

    if (!nationality.value) {
        warnings += 'Nacionalidad\n'; // 
        validacion = false;
        nationality.style.borderColor = 'red';
    }
    else {
        nationality.style.borderColor = ''
    }

    if (!(expresiones.address.test(address.value))) {
        warnings += 'Direccion\n'; // 
        validacion = false;
        address.style.borderColor = 'red';
        errorAddress.innerHTML = 'La direccion no puede estar vacia ni mas de 49 caracteres'; // 
    }
    else {
        errorAddress.innerHTML = ''
        address.style.borderColor = ''
    }

    if (!(expresiones.password.test(password.value))) {
        warnings += 'Contraseña'; // 
        validacion = false;
        password.style.borderColor = 'red';
        errorPassword.innerHTML = 'La contraseña tienen que ser mínimo 10 careacteres!'; // 
    }
    else {
        errorPassword.innerHTML = ''
        password.style.borderColor = ''
    }

    if (!(expresiones.securityAnswer.test(securityAnswer.value))) {
        warnings += 'Respuesta de Seguridad'; // 
        validacion = false;
        securityAnswer.style.borderColor = 'red';
        errorAnswer.innerHTML = 'No puede estar vacía!'; // 
    }
    else {
        errorAnswer.innerHTML = ''
        securityAnswer.style.borderColor = ''
    }

    // Validación de que las contraseñas coinciden
    if (password.value !== repassword.value) {
        repassword.style.borderColor = 'red';
        errorRepassword.innerHTML = '¡Las contraseñas no coinciden!'; // 
        validacion = false;
    } else {
        repassword.style.borderColor = '';
        errorRepassword.innerHTML = '';
    }

    // Se retorna el valor de entrada y los mensajes de error
    return [validacion, warnings];
}
