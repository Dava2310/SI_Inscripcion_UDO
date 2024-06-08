DROP DATABASE if exists studentDB;
CREATE DATABASE studentDB;
use studentDB;

-- Creacion de la Tabla Roles
DROP TABLE IF EXISTS roles;
CREATE TABLE roles(
	ID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(50) NOT NULL,
    description VARCHAR(100),
    PRIMARY KEY(ID)
);

INSERT INTO roles VALUES(1, "Administrador", "No descripcion");
INSERT INTO roles VALUES(2, "Asistente", "No Descripcion");

-- Creacion de la Tabla Usuario
DROP TABLE IF EXISTS employees;
CREATE TABLE employees(
	ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    lastName VARCHAR(40) NOT NULL,
    licenseID varchar(15) NOT NULL,
    email varchar(40) NOT NULL,
    password VARCHAR(60) NOT NULL,
    securityQuestion VARCHAR(30),
    securityAnswer VARCHAR(30),
    idRole INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(idRole) REFERENCES roles(ID)
);

INSERT INTO employees(name, lastName, licenseID, email, idRole, password) VALUES('Daniel', 'Vetencourt', '29517648', 'dvetencourt23@gmail.com', 1, md5('1234'))

-- Creacion de la tabla Estudiante
DROP TABLE IF EXISTS students;
CREATE TABLE students(
    ID INT NOT NULL AUTO_INCREMENT,
    licenseID varchar(15) NOT NULL,
    name VARCHAR(40),
    lastName VARCHAR(40) NOT NULL,
    email VARCHAR(50),
    birthday VARCHAR(15),
    nationality VARCHAR(20),
    phoneNumber VARCHAR(20),
    address VARCHAR(50),
    state VARCHAR(20) DEFAULT 'Active',
    password VARCHAR(50),
    securityQuestion VARCHAR(50),
    securityAnswer VARCHAR(30),
    PRIMARY KEY(ID)
);

-- Creacion de la tabla Carrera
DROP TABLE IF EXISTS careers;
CREATE TABLE careers(
    ID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
    code VARCHAR(20),
    description VARCHAR(200),
    PRIMARY KEY(ID)
);

-- Creacion de la tabla Procesos de las inscripcciones
DROP TABLE IF EXISTS inscriptionProcesses;
CREATE TABLE inscriptionProcesses(
    ID INT NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO inscriptionProcesses (name) VALUES ("OPSU");
INSERT INTO inscriptionProcesses (name) VALUES ("RUSI");
INSERT INTO inscriptionProcesses (name) VALUES ("CONVENIO");

-- Creacion de la tabla periodos
DROP TABLE IF EXISTS periods(
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20),
    dateStart VARCHAR(20),
    dateEnd VARCHAR(20),
    validity BOOLEAN
);


-- Creacion de la tabla Inscripcciones
DROP TABLE IF EXISTS inscriptions;
CREATE TABLE inscriptions(
    ID INT NOT NULL AUTO_INCREMENT,
    date varchar(50),
    opsuCode varchar(50),
    url varchar(200),
    gradePointAverage float,
    degreeCode varchar(50),
    campusAddress varchar(50),
    graduationYear varchar(50),
    degreeTitle varchar(100),
    inscriptionPhase int DEFAULT 0,
    state VARCHAR(20),
    observations VARCHAR(300),
    validity BOOLEAN,
    idStudent INT NOT NULL,
    idProcess INT,
    PRIMARY KEY(ID),
    FOREIGN KEY(idStudent) REFERENCES students(ID),
    FOREIGN KEY(idProcess) REFERENCES inscriptionProcesses(ID)
);

-- -- Creacion de la tabla Estados de las inscripcciones
-- DROP TABLE IF EXISTS inscriptionStates;
-- CREATE TABLE inscriptionStates(
--     ID INT NOT NULL AUTO_INCREMENT,
--     name varchar(50) NOT NULL,
--     PRIMARY KEY (ID)
-- );

-- INSERT INTO inscriptionStates (name) VALUES ("Sin revisar");
-- INSERT INTO inscriptionStates (name) VALUES ("Por corregir");
-- INSERT INTO inscriptionStates (name) VALUES ("Aceptado");
-- INSERT INTO inscriptionStates (name) VALUES ("Rechazado");

DROP TABLE IF EXISTS notifications;
CREATE TABLE notifications(
    ID INT NOT NULL AUTO_INCREMENT,
    content VARCHAR(500),
    date VARCHAR(20),
    idStudent INT,
    FOREIGN KEY(idStudent) REFERENCES students(ID)
);


