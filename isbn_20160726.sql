-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: isbn
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `entidad`
--

DROP TABLE IF EXISTS `entidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entidad` (
  `entidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`entidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entidad`
--

LOCK TABLES `entidad` WRITE;
/*!40000 ALTER TABLE `entidad` DISABLE KEYS */;
INSERT INTO `entidad` VALUES (1,'Entidad 1','E1'),(2,'Entidad 2','E2'),(3,'Entidad 3',NULL),(4,'Entidad 4','E4'),(5,'Entidad 5','E5');
/*!40000 ALTER TABLE `entidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Estado 1',NULL),(2,'Estado 2',NULL),(3,'Estado 3',NULL),(4,'Estado 4',NULL),(5,'Estado 5',NULL);
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_inicio_sesion`
--

DROP TABLE IF EXISTS `log_inicio_sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_inicio_sesion` (
  `LOG_INI_SES_FCH_INICIO` timestamp NULL DEFAULT NULL,
  `LOG_INI_SES_IP` varchar(20) DEFAULT NULL,
  `USUARIO_CVE` int(11) DEFAULT NULL,
  `LOG_INI_S_CVE` int(11) NOT NULL AUTO_INCREMENT,
  `INICIO_SATISFACTORIO` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`LOG_INI_S_CVE`),
  UNIQUE KEY `XPKLOG_INICIO_SESION` (`LOG_INI_S_CVE`),
  KEY `XIF1LOG_INICIO_SESION` (`USUARIO_CVE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_inicio_sesion`
--

LOCK TABLES `log_inicio_sesion` WRITE;
/*!40000 ALTER TABLE `log_inicio_sesion` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_inicio_sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obra`
--

DROP TABLE IF EXISTS `obra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obra` (
  `obra_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `isbn` varchar(15) DEFAULT NULL,
  `subsistema_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`obra_id`),
  KEY `fk_obra_subsistema` (`subsistema_id`),
  CONSTRAINT `fk_obra_subsistema` FOREIGN KEY (`subsistema_id`) REFERENCES `subsistema` (`subsistema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obra`
--

LOCK TABLES `obra` WRITE;
/*!40000 ALTER TABLE `obra` DISABLE KEYS */;
INSERT INTO `obra` VALUES (1,'Obra 1','XXXX-XXXX',1),(2,'Obra 2','YYYY-YYYY',2),(3,'Obra 3','WWWW-WWWW',3),(4,'Obra 4','ZZZZ-ZZZZ',1),(5,'Obra 5','AAAA-AAAA',4),(6,'Obra 6','BBBB-BBBB',2),(7,'Obra 7','CCCC-CCCC',5),(8,'Obra 8','DDDD-DDDD',5),(9,'Obra 9','EEEE-EEEE',4),(10,'Obra 10','FFFF-FFFF',1);
/*!40000 ALTER TABLE `obra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `rol_cve` int(2) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`rol_cve`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Super-admin'),(2,'Admin'),(3,'Usuario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud` (
  `solicitud_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` date NOT NULL,
  `folio` varchar(50) NOT NULL,
  `entidad_id` int(11) NOT NULL,
  `obra_id` int(11) NOT NULL,
  PRIMARY KEY (`solicitud_id`),
  UNIQUE KEY `uq_folio` (`folio`),
  KEY `fk_solicitud_entidad` (`entidad_id`),
  KEY `fk_solicitud_obra` (`obra_id`),
  CONSTRAINT `fk_solicitud_entidad` FOREIGN KEY (`entidad_id`) REFERENCES `entidad` (`entidad_id`),
  CONSTRAINT `fk_solicitud_obra` FOREIGN KEY (`obra_id`) REFERENCES `obra` (`obra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud`
--

LOCK TABLES `solicitud` WRITE;
/*!40000 ALTER TABLE `solicitud` DISABLE KEYS */;
INSERT INTO `solicitud` VALUES (1,'2016-06-10','F01',1,1),(2,'2016-07-01','F02',1,1),(3,'2016-05-03','F03',2,2),(4,'2016-06-10','F04',3,3),(5,'2016-03-05','F05',4,4),(6,'2016-06-08','F06',5,5),(7,'2016-03-20','F07',3,6),(8,'2016-02-28','F08',4,7),(9,'2016-03-20','F09',5,8),(10,'2016-04-20','F10',1,9),(11,'2016-07-02','F11',3,10);
/*!40000 ALTER TABLE `solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subsistema`
--

DROP TABLE IF EXISTS `subsistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subsistema` (
  `subsistema_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`subsistema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subsistema`
--

LOCK TABLES `subsistema` WRITE;
/*!40000 ALTER TABLE `subsistema` DISABLE KEYS */;
INSERT INTO `subsistema` VALUES (1,'Subsistema 1'),(2,'Subsistema 2'),(3,'Subsistema 3'),(4,'Subsistema 4'),(5,'Subsistema 5');
/*!40000 ALTER TABLE `subsistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_cve` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nick` varchar(20) NOT NULL,
  `usu_nombre` varchar(20) NOT NULL,
  `usu_paterno` varchar(20) NOT NULL,
  `usu_materno` varchar(20) NOT NULL,
  `usu_correo` varchar(40) NOT NULL,
  `usu_contrasenia` varchar(150) NOT NULL,
  `usu_estado` int(1) DEFAULT '1',
  `rol_cve` int(1) DEFAULT NULL,
  `usu_fch_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuario_cve`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'unam','UNAM','CU','CU','unam@gmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,1,'2016-07-19 03:40:24'),(2,'miguel','Miguel','G','G','miguel@hotmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,2,'2016-07-19 03:42:59'),(3,'admin','Jesús','D','P','jesusz.unam@gmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,2,'2016-07-19 03:42:59');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-26 10:08:43
