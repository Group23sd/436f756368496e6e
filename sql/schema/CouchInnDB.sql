-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema CouchInnDB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema CouchInnDB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `CouchInnDB` DEFAULT CHARACTER SET utf8 ;
USE `CouchInnDB` ;

-- -----------------------------------------------------
-- Table `CouchInnDB`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`pais` (
  `idpais` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpais`),
  INDEX `NOMBRE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`provincia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`provincia` (
  `idprovincia` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `idpais` INT NOT NULL,
  PRIMARY KEY (`idprovincia`),
  INDEX `NOMBRE` (`nombre` ASC),
  INDEX `idpais_idx` (`idpais` ASC),
  CONSTRAINT `fkpais`
    FOREIGN KEY (`idpais`)
    REFERENCES `CouchInnDB`.`pais` (`idpais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`ciudad` (
  `idciudad` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `latitud` FLOAT(10,6) NOT NULL,
  `longitud` FLOAT(10,6) NOT NULL,
  `idprovincia` INT NOT NULL,
  PRIMARY KEY (`idciudad`),
  INDEX `NOMBRE` (`nombre` ASC),
  INDEX `idprovincia_idx` (`idprovincia` ASC),
  CONSTRAINT `fkprovincia_ciudad`
    FOREIGN KEY (`idprovincia`)
    REFERENCES `CouchInnDB`.`provincia` (`idprovincia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `sexo` VARCHAR(1) NULL,
  `telefono` BIGINT UNSIGNED NULL,
  `calle` VARCHAR(45) NULL,
  `numero` INT UNSIGNED NULL,
  `idciudad` INT NULL,
  `confirmado` BIT(1) NOT NULL,
  `nacimiento` DATE NULL,
  `foto_path` VARCHAR(100) NULL,
  `foto_nombre` VARCHAR(45) NULL,
  `foto_extension` VARCHAR(45) NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `idciudad_idx` (`idciudad` ASC),
  CONSTRAINT `fkciudad_usuario`
    FOREIGN KEY (`idciudad`)
    REFERENCES `CouchInnDB`.`ciudad` (`idciudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`permiso` (
  `idpermiso` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpermiso`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`permiso_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`permiso_usuario` (
  `idpermiso_usuario` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idpermiso` INT NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`idpermiso_usuario`),
  INDEX `idusuario_idx` (`idusuario` ASC),
  INDEX `idpermiso_idx` (`idpermiso` ASC),
  CONSTRAINT `fkusuario_permiso_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `CouchInnDB`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkpermiso_permiso_usuario`
    FOREIGN KEY (`idpermiso`)
    REFERENCES `CouchInnDB`.`permiso` (`idpermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`tipo` (
  `idtipo` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idtipo`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`couch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`couch` (
  `idcouch` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(2000) NULL,
  `precio` DECIMAL NOT NULL,
  `capacidad` INT NOT NULL,
  `habilitado` BIT(1) NOT NULL,
  `idciudad` INT NOT NULL,
  `idtipo` INT NOT NULL,
  `idusuario` INT NOT NULL,
  PRIMARY KEY (`idcouch`),
  FULLTEXT INDEX `TITULO` (`titulo` ASC),
  FULLTEXT INDEX `DESCRIPCION` (`descripcion` ASC),
  INDEX `idtipo_idx` (`idtipo` ASC),
  INDEX `idusuario_idx` (`idusuario` ASC),
  INDEX `idciudad_idx` (`idciudad` ASC),
  CONSTRAINT `fktipo_couch`
    FOREIGN KEY (`idtipo`)
    REFERENCES `CouchInnDB`.`tipo` (`idtipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkusuario_couch`
    FOREIGN KEY (`idusuario`)
    REFERENCES `CouchInnDB`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkciudad_couch`
    FOREIGN KEY (`idciudad`)
    REFERENCES `CouchInnDB`.`ciudad` (`idciudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`foto` (
  `idfoto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `path` VARCHAR(100) NOT NULL,
  `extension` VARCHAR(10) NOT NULL,
  `portada` BIT(1) NOT NULL,
  `idcouch` INT NOT NULL,
  PRIMARY KEY (`idfoto`),
  UNIQUE INDEX `path_UNIQUE` (`path` ASC),
  INDEX `idcouch_idx` (`idcouch` ASC),
  CONSTRAINT `fkcouch_foto`
    FOREIGN KEY (`idcouch`)
    REFERENCES `CouchInnDB`.`couch` (`idcouch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`caracteristica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`caracteristica` (
  `idcaracteristica` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idcaracteristica`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`caracteristica_couch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`caracteristica_couch` (
  `idcaracteristica_couch` INT NOT NULL AUTO_INCREMENT,
  `idcaracteristica` INT NOT NULL,
  `idcouch` INT NOT NULL,
  PRIMARY KEY (`idcaracteristica_couch`),
  INDEX `idcouch_idx` (`idcouch` ASC),
  INDEX `idcaracteristica_idx` (`idcaracteristica` ASC),
  CONSTRAINT `fkcouchn_caracteristica_couch`
    FOREIGN KEY (`idcouch`)
    REFERENCES `CouchInnDB`.`couch` (`idcouch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkcaracteristica_caracteristica_couch`
    FOREIGN KEY (`idcaracteristica`)
    REFERENCES `CouchInnDB`.`caracteristica` (`idcaracteristica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`reserva` (
  `idreserva` INT NOT NULL AUTO_INCREMENT,
  `inicio` DATE NOT NULL,
  `fin` DATE NOT NULL,
  `monto` DECIMAL NOT NULL,
  `puntaje_usuario` INT NULL,
  `puntaje_usuario_comentario` VARCHAR(500) NULL,
  `puntaje_usuario_fecha` DATETIME NULL,
  `puntaje_couch` INT NULL,
  `puntaje_couch_comentario` VARCHAR(500) NULL,
  `puntaje_couch_fecha` DATETIME NULL,
  `idusuario` INT NOT NULL,
  `idcouch` INT NOT NULL,
  PRIMARY KEY (`idreserva`),
  INDEX `idusuario_idx` (`idusuario` ASC),
  INDEX `idcouch_idx` (`idcouch` ASC),
  CONSTRAINT `fkusuario_reserva`
    FOREIGN KEY (`idusuario`)
    REFERENCES `CouchInnDB`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkcouch_reserva`
    FOREIGN KEY (`idcouch`)
    REFERENCES `CouchInnDB`.`couch` (`idcouch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`comentario` (
  `idcomentario` INT NOT NULL AUTO_INCREMENT,
  `pregunta` VARCHAR(500) NOT NULL,
  `respuesta` VARCHAR(500) NULL,
  `fecha` DATETIME NOT NULL,
  `idusuario` INT NOT NULL,
  `idcouch` INT NOT NULL,
  PRIMARY KEY (`idcomentario`),
  INDEX `idusuario_idx` (`idusuario` ASC),
  INDEX `idcouch_idx` (`idcouch` ASC),
  CONSTRAINT `fkusuario_comentario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `CouchInnDB`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkcouch_comentario`
    FOREIGN KEY (`idcouch`)
    REFERENCES `CouchInnDB`.`couch` (`idcouch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CouchInnDB`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CouchInnDB`.`estado` (
  `idestado` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `idreserva` INT NOT NULL,
  PRIMARY KEY (`idestado`),
  INDEX `idreserva_idx` (`idreserva` ASC),
  CONSTRAINT `fkreserva_estado`
    FOREIGN KEY (`idreserva`)
    REFERENCES `CouchInnDB`.`reserva` (`idreserva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
