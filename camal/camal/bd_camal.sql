-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bd_camal
CREATE DATABASE IF NOT EXISTS `bd_camal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bd_camal`;

-- Volcando estructura para tabla bd_camal.animal
CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` int(11) NOT NULL AUTO_INCREMENT,
  `peso` varchar(50) NOT NULL,
  `marca_animal` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `enfermedad` varchar(50) NOT NULL,
  `guía_agrocalidad` varchar(10) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'sin_eliminar',
  `id_registro` int(11) NOT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `FK_animal_registro` (`id_registro`),
  CONSTRAINT `FK_animal_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.entrada_animal
CREATE TABLE IF NOT EXISTS `entrada_animal` (
  `id_entrada_animal` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrada` date NOT NULL,
  `lote` varchar(50) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'sin_eliminar',
  `id_registro` int(11) NOT NULL,
  PRIMARY KEY (`id_entrada_animal`),
  KEY `FK_entrada_animal_animal` (`id_animal`),
  KEY `FK_entrada_animal_registro` (`id_registro`),
  CONSTRAINT `FK_entrada_animal_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_entrada_animal_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.inspector
CREATE TABLE IF NOT EXISTS `inspector` (
  `id_inspector` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `id_registro` int(11) NOT NULL,
  PRIMARY KEY (`id_inspector`),
  KEY `FK_inspector_registro` (`id_registro`),
  CONSTRAINT `FK_inspector_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.login
CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `id_registro` int(11) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contraseña` varchar(60) NOT NULL,
  `rol` varchar(20) NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `id_registro` (`id_registro`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.registro
CREATE TABLE IF NOT EXISTS `registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo_electronico` varchar(60) NOT NULL,
  `contraseña` varchar(60) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'sin_eliminar',
  `rol` varchar(30) NOT NULL DEFAULT 'veterinario',
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.tb_registro_sacrificio
CREATE TABLE IF NOT EXISTS `tb_registro_sacrificio` (
  `id_registro_sacrificio` int(11) NOT NULL AUTO_INCREMENT,
  `metodo_sacrificio` varchar(100) NOT NULL,
  `dia_sacrificio` date NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'sin_eliminar',
  `id_animal` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  PRIMARY KEY (`id_registro_sacrificio`),
  KEY `FK_tb_registro_sacrificio_animal` (`id_animal`),
  KEY `FK_tb_registro_sacrificio_registro` (`id_registro`),
  CONSTRAINT `FK_tb_registro_sacrificio_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tb_registro_sacrificio_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.tb_salida_animal
CREATE TABLE IF NOT EXISTS `tb_salida_animal` (
  `id_salida_animal` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_salida` date NOT NULL,
  `destino` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'sin_eliminar',
  `id_registro` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  PRIMARY KEY (`id_salida_animal`),
  KEY `FK_tb_salida_animal_registro` (`id_registro`),
  KEY `FK_tb_salida_animal_animal` (`id_animal`),
  CONSTRAINT `FK_tb_salida_animal_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tb_salida_animal_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bd_camal.veterinario
CREATE TABLE IF NOT EXISTS `veterinario` (
  `id_veterinario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `id_registro` int(11) NOT NULL,
  PRIMARY KEY (`id_veterinario`),
  KEY `FK_veterinario_registro` (`id_registro`),
  CONSTRAINT `FK_veterinario_registro` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para disparador bd_camal.after_registro_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER after_registro_insert
AFTER INSERT ON registro
FOR EACH ROW
BEGIN
    INSERT INTO login (id_registro, correo, contraseña, rol)
    VALUES (NEW.id_registro, NEW.correo_electronico, NEW.contraseña, NEW.rol);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
