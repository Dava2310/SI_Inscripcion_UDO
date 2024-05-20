DROP DATABASE if exists conejos;
CREATE DATABASE conejos;
use conejos;

-- Creacion de la Tabla Roles
DROP TABLE IF EXISTS roles;
CREATE TABLE roles(
	idRol INT NOT NULL AUTO_INCREMENT, 
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(100),
    PRIMARY KEY(idRol)
);

INSERT INTO roles VALUES(1, "Administrador", "No descripcion");
INSERT INTO roles VALUES(2, "Estudiante", "No descripcion");

-- Creacion de la Tabla Usuario
DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario(
	idUsuario INT NOT NULL AUTO_INCREMENT,
    primerNombre VARCHAR(40) NOT NULL,
    segundoNombre VARCHAR(40) NOT NULL,
    primerApellido VARCHAR(40) NOT NULL,
    segundoApellido VARCHAR(40) NOT NULL,
    cedula varchar(15) NOT NULL,
    correo varchar(40) NOT NULL,
    idRol INT NOT NULL,
    contrasena VARCHAR(60) NOT NULL,
    PRIMARY KEY(idUsuario),
    FOREIGN KEY(idRol) REFERENCES roles(idRol)
);

INSERT INTO usuario VALUES(1, "Daniel", "Vetencourt", 21, "29517648", "04249334420", "dvetencourt23@gmail.com", 1, "f", "f", md5(1234));
SELECT * FROM usuario;

-- Creacion de la Tabla Conejo
DROP TABLE IF EXISTS conejo;
CREATE TABLE conejo(
	idConejo INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(20) NOT NULL,
    edad INT NOT NULL,
    raza VARCHAR(20) NOT NULL,
    genero VARCHAR(12) NOT NULL,
    fecha_nacimiento VARCHAR(15) NOT NULL,
    cantidad_cruces INT DEFAULT 0,
    idUsuario int NOT NULL,
    PRIMARY KEY(idConejo),
    rol VARCHAR(15) NOT NULL DEFAULT '-' ,
    estatus VARCHAR(15) NOT NULL DEFAULT "Vivo",
    -- Rol: - , Apareador, Productor
    -- Estatus: Vivo, Vendido
    FOREIGN KEY(idUsuario) REFERENCES usuario(idUsuario)
);

DROP TABLE IF EXISTS historialMedico;
CREATE TABLE historialMedico(
	idHistorial INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(2000) NOT NULL,
    fecha VARCHAR(20),
    descripcion_tratamiento VARCHAR(2000) NOT NULL,
    idConejo INT NOT NULL,
    PRIMARY KEY(idHistorial),
    FOREIGN KEY(idConejo) REFERENCES conejo(idConejo)
);

-- INSERT INTO historialMedico(descripcion, fecha, descripcion_tratamiento, idConejo) VALUES("Descripcion General", "23/10/2001", "Descripcion Tratamiento", 1);
-- SELECT * from historialMedico;

DROP TABLE IF EXISTS produccion;
CREATE TABLE produccion(
	idRegistro INT NOT NULL AUTO_INCREMENT,
    fechaRegistro VARCHAR(20) NOT NULL,
    produccion_carne DECIMAL(5,2) NOT NULL,
    kilos_vivo DECIMAL(5,2) NOT NULL,
    idConejo INT NOT NULL,
    PRIMARY KEY(idRegistro),
    FOREIGN KEY(idConejo) REFERENCES conejo(idConejo)
);

DROP TABLE IF EXISTS cruce;
CREATE TABLE cruce(
	idCruce INT NOT NULL AUTO_INCREMENT,
    fechaCruce varchar(20) NOT NULL,
    idConejo INT NOT NULL,
    idConeja INT NOT NULL,
    numeroCamadas INT NOT NULL,
    PRIMARY KEY(idCruce),
    FOREIGN KEY(idConejo) REFERENCES conejo(idConejo),
    FOREIGN KEY(idConejo) REFERENCES conejo(idConejo)
);

ALTER TABLE conejo ADD COLUMN idCruce INT;
ALTER TABLE conejo ADD FOREIGN KEY (idCruce) REFERENCES cruce(idCruce); 

DROP TABLE IF EXISTS alimentacion;
CREATE TABLE alimentacion(
	idAlimentacion INT NOT NULL AUTO_INCREMENT,
    ultima_actualizacion varchar(40) NOT NULL,
    tipo_alimento VARCHAR(40) NOT NULL,
    cantidad_requerida DECIMAL(5,2) NOT NULL,
    idConejo INT NOT NULL,
    PRIMARY KEY(idAlimentacion),
    FOREIGN KEY(idConejo) REFERENCES conejo(idConejo)
);

DROP TABLE IF EXISTS gestacion;
CREATE TABLE gestacion(
	idGestacion INT NOT NULL AUTO_INCREMENT,
    fecha_inicio VARCHAR(15) NOT NULL,
    fecha_parto VARCHAR(15),
    idConejaMadre INT NOT NULL,
    observaciones VARCHAR(330) NOT NULL,
    PRIMARY KEY(idGestacion),
    FOREIGN KEY(idConejaMadre) REFERENCES conejo(idConejo)
);

SELECT * FROM usuario;
SELECT * FROM conejo;
SELECT * FROM historialMedico;