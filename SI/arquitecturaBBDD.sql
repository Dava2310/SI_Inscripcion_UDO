CREATE TABLE estudiantes(
    primerNombre varchar(50) NOT NULL, 
    segundoNombre varchar(50) NOT NULL, 
    primerApellido varchar(50) NOT NULL, 
    segundoApellido varchar(50) NOT NULL, 
    cedula int(7) NOT NULL, 
    correo varchar(50) NOT NULL, 
    contrasena varchar(50) NOT NULL, 
    PRIMARY KEY (cedula)
);

CREATE TABLE autenticacion (
    id_sesion INT,
    fecha_expiracion DATE NOT NULL,
    cedula INT NOT NULL,
    PRIMARY KEY (id_sesion),
    FOREIGN KEY (cedula) REFERENCES estudiantes(cedula)
);