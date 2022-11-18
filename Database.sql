-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: codigo_azul
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alarmas`
--

DROP TABLE IF EXISTS `alarmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alarmas` (
  `ID_Alarma` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) NOT NULL,
  `ID_Ubicacion` int(11) NOT NULL,
  `Origen` varchar(50) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1,
  `Creado` datetime DEFAULT current_timestamp(),
  `Editado` datetime DEFAULT current_timestamp(),
  `Password` varchar(256) NOT NULL,
  PRIMARY KEY (`ID_Alarma`),
  KEY `FK_alarmas_ubicacion` (`ID_Ubicacion`),
  CONSTRAINT `FK_alarmas_ubicacion` FOREIGN KEY (`ID_Ubicacion`) REFERENCES `ubicaciones` (`ID_Ubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `displays`
--

DROP TABLE IF EXISTS `displays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `displays` (
  `ID_Display` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) NOT NULL,
  `ID_Ubicacion` int(11) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT 1,
  `Creado` datetime NOT NULL DEFAULT current_timestamp(),
  `Editado` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Display`),
  KEY `ID_Ubicacion` (`ID_Ubicacion`),
  CONSTRAINT `displays_ibfk_1` FOREIGN KEY (`ID_Ubicacion`) REFERENCES `ubicaciones` (`ID_Ubicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enfermeros`
--

DROP TABLE IF EXISTS `enfermeros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enfermeros` (
  `ID_Enfermero` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `DNI` int(11) NOT NULL,
  `Estado` varchar(50) NOT NULL DEFAULT '1',
  `Creado` datetime DEFAULT current_timestamp(),
  `Editado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Enfermero`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `ID_Paciente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `DNI` int(11) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Localidad` varchar(50) NOT NULL,
  `Provincia` varchar(50) NOT NULL,
  `Obra_Social` varchar(50) NOT NULL,
  `NroObraSocial` int(11) DEFAULT NULL,
  `Medico_Cabecera` varchar(50) NOT NULL,
  `Padecimiento` text NOT NULL,
  `GrupoSanguineo` varchar(5) NOT NULL,
  `ID_Enfermero` int(11) NOT NULL,
  `ID_Ubicacion` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1,
  `Creado` datetime DEFAULT current_timestamp(),
  `Editado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Paciente`),
  KEY `FK_pacientes_enfermeros` (`ID_Enfermero`),
  KEY `FK_pacientes_ubicacion` (`ID_Ubicacion`),
  CONSTRAINT `FK_pacientes_enfermeros` FOREIGN KEY (`ID_Enfermero`) REFERENCES `enfermeros` (`ID_Enfermero`),
  CONSTRAINT `FK_pacientes_ubicacion` FOREIGN KEY (`ID_Ubicacion`) REFERENCES `ubicaciones` (`ID_Ubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros` (
  `ID_Registro` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Alarma` int(11) NOT NULL,
  `FechaHora` datetime NOT NULL DEFAULT current_timestamp(),
  `Tipo` varchar(50) NOT NULL,
  `Atendido` tinyint(1) NOT NULL DEFAULT 0,
  `FechaHoraAtendido` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_Registro`),
  KEY `FK_registro_alarmas` (`ID_Alarma`),
  CONSTRAINT `FK_registro_alarmas` FOREIGN KEY (`ID_Alarma`) REFERENCES `alarmas` (`ID_Alarma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicaciones` (
  `ID_Ubicacion` int(11) NOT NULL AUTO_INCREMENT,
  `Piso` int(11) NOT NULL,
  `Area` varchar(50) NOT NULL,
  `Sala` varchar(50) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1,
  `Creado` datetime DEFAULT current_timestamp(),
  `Editado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Ubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCompleto` varchar(60) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Rol` varchar(20) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1,
  `Creado` datetime DEFAULT current_timestamp(),
  `Editado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-18 10:28:20

INSERT INTO `usuarios` (`ID_Usuario`, `NombreCompleto`, `Usuario`, `Password`, `Rol`, `Estado`, `Creado`, `Editado`) VALUES (NULL, 'admin', 'admin', '$2y$10$aU9Q.D9CyJnSwgsRwHVahu5cRCDG9XkwGpDg5G8rnfOpplDnihGjq', 'admin', '1', current_timestamp(), current_timestamp());