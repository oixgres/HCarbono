SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Empresa
-- -----------------------------------------------------
DROP TABLE IF EXISTS Empresa;
CREATE TABLE Empresa (
  idEmpresa INT NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(45) NULL,
  Telefono VARCHAR(45) NULL,
  Correo VARCHAR(45) NULL,
  PRIMARY KEY (idEmpresa)
  ) ;
ALTER TABLE Empresa AUTO_INCREMENT = 1000;
-- -----------------------------------------------------
-- Usuario
-- -----------------------------------------------------
DROP TABLE IF EXISTS Usuario;
CREATE TABLE Usuario (
  idUsuario INT NOT NULL AUTO_INCREMENT,
  Username VARCHAR(10),
  Password VARCHAR(45),
  Nombre VARCHAR(45) NOT NULL,
  Ciudad VARCHAR(20) NOT NULL,
  Correo VARCHAR(45) NOT NULL,
  Telefono VARCHAR(45) NOT NULL,
  Aprobado VARCHAR(45) NOT NULL DEFAULT 'No Aprobado',
  Empresa_idEmpresa INT,
  FOREIGN KEY (Empresa_idEmpresa)
  REFERENCES Empresa(idEmpresa),
  PRIMARY KEY (idUsuario)
  ) ;

ALTER TABLE Usuario AUTO_INCREMENT = 1000;

-- -----------------------------------------------------
-- Administrador
-- -----------------------------------------------------
DROP TABLE IF EXISTS Administrador;
CREATE TABLE Administrador (
  idAdministrador INT NOT NULL,
  Username VARCHAR(45) NOT NULL,
  Password VARCHAR(45) NOT NULL,
  PRIMARY KEY (idAdministrador)
  ) ;

SET FOREIGN_KEY_CHECKS = 1;
