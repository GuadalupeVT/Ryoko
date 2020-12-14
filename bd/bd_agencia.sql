-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema id15673807_bd_agencia
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema id15673807_bd_agencia
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `id15673807_bd_agencia` DEFAULT CHARACTER SET utf8 ;
USE `id15673807_bd_agencia` ;

-- -----------------------------------------------------
-- Table `id15673807_bd_agencia`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`usuarios` (
  `usuario` VARCHAR(45) NOT NULL,
  `contraseña` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `id15673807_bd_agencia`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`cliente` (
  `id_Cliente` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `primerAp` VARCHAR(45) NOT NULL,
  `segundoAp` VARCHAR(45) NULL DEFAULT NULL,
  `FechaNac` VARCHAR(11) NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id_Cliente`),
  CONSTRAINT `user_cliente`
    FOREIGN KEY (`id_Cliente`)
    REFERENCES `id15673807_bd_agencia`.`usuarios` (`usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `id15673807_bd_agencia`.`hotel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`hotel` (
  `id_Hotel` VARCHAR(5) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `categoria` INT NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `direccion_calle` VARCHAR(45) NOT NULL,
  `direccion_numero` VARCHAR(45) NOT NULL,
  `direccion_ciudad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Hotel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `id15673807_bd_agencia`.`habitaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`habitaciones` (
  `id_Habitaciones` VARCHAR(5) NOT NULL,
  `costo` DOUBLE NOT NULL,
  `tipo` VARCHAR(20) NOT NULL,
  `id_Hotel` VARCHAR(5) NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Habitaciones`),
  CONSTRAINT `FK_hotel_habitaciones`
    FOREIGN KEY (`id_Hotel`)
    REFERENCES `id15673807_bd_agencia`.`hotel` (`id_Hotel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `FK_hotel_habitaciones_idx` ON `id15673807_bd_agencia`.`habitaciones` (`id_Hotel` ASC);


-- -----------------------------------------------------
-- Table `id15673807_bd_agencia`.`transporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`transporte` (
  `id_Transporte` VARCHAR(5) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `linea` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `costo` DOUBLE NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_Transporte`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `id15673807_bd_agencia`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`reserva` (
  `id_Reserva` VARCHAR(5) NOT NULL,
  `fecha_inicio` VARCHAR(11) NOT NULL,
  `fecha_fin` VARCHAR(11) NOT NULL,
  `id_Habitacion` VARCHAR(5) NOT NULL,
  `id_Cliente` VARCHAR(45) NOT NULL,
  `id_Transporte` VARCHAR(5) NOT NULL,
  `total` DOUBLE NOT NULL,
  PRIMARY KEY (`id_Reserva`),
  CONSTRAINT `FK_Reserva_Cliente`
    FOREIGN KEY (`id_Cliente`)
    REFERENCES `id15673807_bd_agencia`.`cliente` (`id_Cliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_Reserva_Habitacion`
    FOREIGN KEY (`id_Habitacion`)
    REFERENCES `id15673807_bd_agencia`.`habitaciones` (`id_Habitaciones`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_Reserva_Transporte`
    FOREIGN KEY (`id_Transporte`)
    REFERENCES `id15673807_bd_agencia`.`transporte` (`id_Transporte`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `FK_Reserva_Cliente_idx` ON `id15673807_bd_agencia`.`reserva` (`id_Cliente` ASC);

CREATE INDEX `FK_Reserva_Habitacion_idx` ON `id15673807_bd_agencia`.`reserva` (`id_Habitacion` ASC);

CREATE INDEX `FK_Reserva_Transporte_idx` ON `id15673807_bd_agencia`.`reserva` (`id_Transporte` ASC);

USE `id15673807_bd_agencia` ;

-- -----------------------------------------------------
-- Placeholder table for view `id15673807_bd_agencia`.`relacion_hotel_habitacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`relacion_hotel_habitacion` (`id_Habitaciones` INT, `tipo` INT, `id_Hotel` INT, `nombre` INT);

-- -----------------------------------------------------
-- Placeholder table for view `id15673807_bd_agencia`.`reporte_reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id15673807_bd_agencia`.`reporte_reserva` (`id_Reserva` INT, `fecha_inicio` INT, `fecha_fin` INT, `id_Cliente` INT, `nombreCliente` INT, `primerAp` INT, `segundoAp` INT, `tipoHabitacion` INT, `nombreHotel` INT, `tipoTransporte` INT, `linea` INT, `total` INT);



-- -----------------------------------------------------
-- View `id15673807_bd_agencia`.`relacion_hotel_habitacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `id15673807_bd_agencia`.`relacion_hotel_habitacion`;
USE `id15673807_bd_agencia`;
CREATE  OR REPLACE VIEW `id15673807_bd_agencia`.`relacion_hotel_habitacion` AS select `h`.`id_Habitaciones` AS `id_Habitaciones`,`h`.`tipo` AS `tipo`,`ho`.`id_Hotel` AS `id_Hotel`,`ho`.`nombre` AS `nombre` from (`id15673807_bd_agencia`.`habitaciones` `h` join `id15673807_bd_agencia`.`hotel` `ho` on((`h`.`id_Hotel` = `ho`.`id_Hotel`)));

-- -----------------------------------------------------
-- View `id15673807_bd_agencia`.`reporte_reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `id15673807_bd_agencia`.`reporte_reserva`;
USE `id15673807_bd_agencia`;
CREATE  OR REPLACE VIEW `id15673807_bd_agencia`.`reporte_reserva` AS select `r`.`id_Reserva` AS `id_Reserva`,`r`.`fecha_inicio` AS `fecha_inicio`,`r`.`fecha_fin` AS `fecha_fin`,`c`.`id_Cliente` AS `id_Cliente`,`c`.`nombre` AS `nombreCliente`,`c`.`primerAp` AS `primerAp`,`c`.`segundoAp` AS `segundoAp`,`ho`.`tipo` AS `tipoHabitacion`,`ho`.`nombre` AS `nombreHotel`,`t`.`tipo` AS `tipoTransporte`,`t`.`linea` AS `linea`,`r`.`total` AS `total` from (((`id15673807_bd_agencia`.`reserva` `r` join `id15673807_bd_agencia`.`cliente` `c` on((`r`.`id_Cliente` = `c`.`id_Cliente`))) join `id15673807_bd_agencia`.`relacion_hotel_habitacion` `ho` on((`r`.`id_Habitacion` = `ho`.`id_Habitaciones`))) join `id15673807_bd_agencia`.`transporte` `t` on((`r`.`id_Transporte` = `t`.`id_Transporte`)));
USE `id15673807_bd_agencia`;

DELIMITER $$
USE `id15673807_bd_agencia`$$
CREATE TRIGGER `id15673807_bd_agencia`.`disponibilidad`
AFTER INSERT ON `id15673807_bd_agencia`.`reserva`
FOR EACH ROW
BEGIN
 UPDATE habitaciones SET disponibilidad = "No disponible" 
 WHERE id_habitaciones = NEW.id_Habitacion;
 UPDATE transporte SET disponibilidad = "No disponible" 
 WHERE id_transporte = NEW.id_Transporte;
END$$

USE `id15673807_bd_agencia`$$
CREATE TRIGGER `id15673807_bd_agencia`.`disponibilidad_ocupado`
AFTER DELETE ON `id15673807_bd_agencia`.`reserva`
FOR EACH ROW
BEGIN
 UPDATE habitaciones SET disponibilidad = "Disponible" 
 WHERE id_habitaciones = OLD.id_Habitacion;
 UPDATE transporte SET disponibilidad = "Disponible" 
 WHERE id_transporte = OLD.id_Transporte;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `id15673807_bd_agencia`.`usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `id15673807_bd_agencia`;
INSERT INTO `id15673807_bd_agencia`.`usuarios` (`usuario`, `contraseña`) VALUES ('', '');

COMMIT;

