SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Empresa
-- -----------------------------------------------------
DROP TABLE IF EXISTS Empresa;
CREATE TABLE Empresa (
  idEmpresa INT NOT NULL,
  Nombre VARCHAR(45) NULL,
  Telefono VARCHAR(45) NULL,
  Correo VARCHAR(45) NULL,
  PRIMARY KEY (idEmpresa)
  ) ;

-- -----------------------------------------------------
-- Usuario
-- -----------------------------------------------------
DROP TABLE IF EXISTS Usuario;
CREATE TABLE Usuario (
  idUsuario INT NOT NULL,
  Username VARCHAR(10) NOT NULL,
  Password VARCHAR(45) NOT NULL,
  Nombre VARCHAR(45) NOT NULL,
  Ciudad VARCHAR(20) NOT NULL,
  Correo VARCHAR(45) NOT NULL,
  Telefono VARCHAR(45) NOT NULL,
  Aprobado BOOLEAN,
  Empresa_idEmpresa INT NOT NULL,
  FOREIGN KEY (Empresa_idEmpresa)
  REFERENCES Empresa(idEmpresa),
  PRIMARY KEY (idUsuario)
  ) ;


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
