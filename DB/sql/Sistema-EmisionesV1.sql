SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Empresa
-- -----------------------------------------------------
DROP TABLE IF EXISTS Empresa;
CREATE TABLE Empresa (
  idEmpresa INT NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(45) NULL,
  PRIMARY KEY (idEmpresa)
);

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
  REFERENCES Empresa(idEmpresa)
  ON DELETE CASCADE,
  PRIMARY KEY (idUsuario)
);

ALTER TABLE Usuario AUTO_INCREMENT = 1000;

-- -----------------------------------------------------
-- Administrador
-- -----------------------------------------------------
DROP TABLE IF EXISTS Administrador;
CREATE TABLE Administrador (
  idAdministrador INT NOT NULL AUTO_INCREMENT,
  Username VARCHAR(45) NOT NULL,
  Password VARCHAR(45) NOT NULL,
  PRIMARY KEY (idAdministrador)
);

ALTER TABLE Administrador AUTO_INCREMENT = 1000;

-- -----------------------------------------------------
-- Niveles Emisiones
-- -----------------------------------------------------
DROP TABLE IF EXISTS Estadisticas;
CREATE TABLE Estadisticas(
  idEmisiones INT NOT NULL AUTO_INCREMENT,
  Fecha DATE NOT NULL,
  Humedad INT,
  Temperatura INT,
  CO INT,
  CO2 INT,
  O2 INT,
  Velocidad INT,
  Usuario_idUsuario INT,
  Empresa_idEmpresa INT,
  FOREIGN KEY (Usuario_idUsuario)
  REFERENCES Usuario(idUsuario)
  ON DELETE CASCADE,
  FOREIGN KEY (Empresa_idEmpresa)
  REFERENCES Empresa(idEmpresa)
  ON DELETE CASCADE,
  PRIMARY KEY (idEmisiones)
);

ALTER TABLE Estadisticas AUTO_INCREMENT=1000;

SET FOREIGN_KEY_CHECKS = 1;
