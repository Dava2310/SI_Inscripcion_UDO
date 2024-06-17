export function validarCedula(cedula) {
    const regex = /^([VEJPG]-)?\d{6,9}$/i;

    if (regex.test(cedula)) {
        return true
    }
    else {
        return false
    }
}