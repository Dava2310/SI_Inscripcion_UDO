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
    idRole INT NOT NULL,
    password VARCHAR(60) NOT NULL,
    securityQuestion VARCHAR(30),
    securityAnswer VARCHAR(30),
    PRIMARY KEY(ID),
    FOREIGN KEY(idRole) REFERENCES roles(ID)
);

INSERT INTO employees(name, lastName, licenseID, email, idRole, password) VALUES('Daniel', 'Vetencourt', '29517648', 'dvetencourt23@gmail.com', 1, '1234')

-- Creacion de la tabla Estudiante
DROP TABLE IF EXISTS students;
CREATE TABLE students(
    ID INT NOT NULL AUTO_INCREMENT,
    licenseID varchar(15) NOT NULL,
    name VARCHAR(50),
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(50),
    phoneNumber VARCHAR(20),
    address VARCHAR(50),
    state VARCHAR(20) DEFAULT 'Active',
<<<<<<< HEAD
    PRIMARY KEY(ID)
=======
    securityQuestion VARCHAR(30),
    securityAnswer VARCHAR(30)
>>>>>>> 902fde0f974c1ed733d65a04c888e6d004643c1c
);

-- Creacion de la tabla Carrera
DROP TABLE IF EXISTS careers;
CREATE TABLE careers(
    ID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30) NOT NULL,
    description VARCHAR(200),
    PRIMARY KEY(ID)
);
