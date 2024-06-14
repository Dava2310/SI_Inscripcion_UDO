DROP DATABASE IF EXISTS studentDB;
CREATE DATABASE studentDB;
USE studentDB;

-- Creación de la tabla Roles
DROP TABLE IF EXISTS roles;
CREATE TABLE roles(
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(100),
    PRIMARY KEY(ID)
);

-- Inserta registros en la tabla 'roles'
INSERT INTO roles VALUES(1, "Administrador", "No descripción");
INSERT INTO roles VALUES(2, "Asistente", "No Descripción");

-- Creación de la tabla Usuario
DROP TABLE IF EXISTS users;
CREATE TABLE users(
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    lastName VARCHAR(40) NOT NULL,
    licenseID VARCHAR(15) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password VARCHAR(60) NOT NULL,
    securityQuestion VARCHAR(30),
    securityAnswer VARCHAR(100),
    idRole INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(idRole) REFERENCES roles(ID)
);

-- Inserta un registro en la tabla 'users'
INSERT INTO users(name, lastName, licenseID, email, idRole, password) 
VALUES('Daniel', 'Vetencourt', '29517648', 'dvetencourt23@gmail.com', 1, MD5('1234'));

-- Creación de la tabla Estudiante
DROP TABLE IF EXISTS students;
CREATE TABLE students(
    ID INT NOT NULL AUTO_INCREMENT,
    licenseID VARCHAR(15) NOT NULL,
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
    securityAnswer VARCHAR(100),
    PRIMARY KEY(ID)
);

-- Creación de la tabla Carrera
DROP TABLE IF EXISTS careers;
CREATE TABLE careers(
    ID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
    code VARCHAR(20),
    description VARCHAR(200),
    PRIMARY KEY(ID)
);

-- Creación de la tabla Procesos de las inscripciones
DROP TABLE IF EXISTS inscriptionProcesses;
CREATE TABLE inscriptionProcesses(
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(ID)
);

-- Inserta registros en la tabla 'inscriptionProcesses'
INSERT INTO inscriptionProcesses (name) VALUES ("OPSU");
INSERT INTO inscriptionProcesses (name) VALUES ("RUSI");
INSERT INTO inscriptionProcesses (name) VALUES ("CONVENIO");

-- Creación de la tabla periodos
DROP TABLE IF EXISTS periods;
CREATE TABLE periods(
    ID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20),
    dateStart VARCHAR(20),
    dateEnd VARCHAR(20),
    validity INT DEFAULT 0,
    PRIMARY KEY(ID)
);

-- Creación de la tabla Inscripciones
DROP TABLE IF EXISTS inscriptions;
CREATE TABLE inscriptions(
    ID INT NOT NULL AUTO_INCREMENT,
    date VARCHAR(50),
    opsuCode VARCHAR(50),
    url VARCHAR(200),
    gradePointAverage FLOAT,
    degreeCode VARCHAR(50),
    campusAddress VARCHAR(50),
    graduationYear VARCHAR(50),
    degreeTitle VARCHAR(100),
    inscriptionPhase INT DEFAULT 0,
    state VARCHAR(20),
    observations VARCHAR(300),
    validity BOOLEAN,
    idStudent INT NOT NULL,
    idProcess INT,
    idPeriod INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(idStudent) REFERENCES students(ID),
    FOREIGN KEY(idProcess) REFERENCES inscriptionProcesses(ID),
    FOREIGN KEY(idPeriod) REFERENCES periods(ID)
);

-- Creacion de la tabla Carreras Seleccionadas
DROP TABLE IF EXISTS selectedCareers;
CREATE TABLE selectedCareers(
    ID INT NOT NULL AUTO_INCREMENT,
    idInscription INT NOT NULL,
    idCareer INT NOT NULL,
    idPeriod INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(idInscription) REFERENCES inscriptions(ID),
    FOREIGN KEY(idCareer) REFERENCES careers(ID),
    FOREIGN KEY(idPeriod) REFERENCES periods(ID)
);

-- Creación de la tabla Notificaciones
DROP TABLE IF EXISTS notifications;
CREATE TABLE notifications(
    ID INT NOT NULL AUTO_INCREMENT,
    content VARCHAR(500),
    date VARCHAR(20),
    idStudent INT,
    PRIMARY KEY(ID),
    FOREIGN KEY(idStudent) REFERENCES students(ID)
);
