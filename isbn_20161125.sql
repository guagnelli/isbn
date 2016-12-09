-- MySQL dump 10.13  Distrib 5.7.12, for osx10.11 (x86_64)
--
-- Host: localhost    Database: sipimss_20161102
-- ------------------------------------------------------
-- Server version	5.7.12

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
-- Table structure for table `barcode`
--

DROP TABLE IF EXISTS `barcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `solicitar_barcode` decimal(1,0) NOT NULL,
  `barcode_size` int(11) NOT NULL,
  `barcode_img` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bc_sol` (`solicitud_id`),
  KEY `fk_bc_bcz` (`barcode_size`),
  KEY `fk_bc_iz` (`barcode_img`),
  CONSTRAINT `fk_bc_bcz` FOREIGN KEY (`barcode_size`) REFERENCES `c_barcode_size` (`id`),
  CONSTRAINT `fk_bc_iz` FOREIGN KEY (`barcode_img`) REFERENCES `c_img_size` (`id`),
  CONSTRAINT `fk_bc_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barcode`
--

LOCK TABLES `barcode` WRITE;
/*!40000 ALTER TABLE `barcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `barcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_barcode_size`
--

DROP TABLE IF EXISTS `c_barcode_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_barcode_size` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_barcode_size`
--

LOCK TABLES `c_barcode_size` WRITE;
/*!40000 ALTER TABLE `c_barcode_size` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_barcode_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_categoria`
--

DROP TABLE IF EXISTS `c_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_categoria`
--

LOCK TABLES `c_categoria` WRITE;
/*!40000 ALTER TABLE `c_categoria` DISABLE KEYS */;
INSERT INTO `c_categoria` VALUES (1,'Filosofía y Psicología');
/*!40000 ALTER TABLE `c_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_ciudad`
--

DROP TABLE IF EXISTS `c_ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_ciudad`
--

LOCK TABLES `c_ciudad` WRITE;
/*!40000 ALTER TABLE `c_ciudad` DISABLE KEYS */;
INSERT INTO `c_ciudad` VALUES (1,'México'),(2,'Roma'),(3,'Grecia');
/*!40000 ALTER TABLE `c_ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_departamento`
--

DROP TABLE IF EXISTS `c_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_departamento`
--

LOCK TABLES `c_departamento` WRITE;
/*!40000 ALTER TABLE `c_departamento` DISABLE KEYS */;
INSERT INTO `c_departamento` VALUES (1,'depto 1'),(2,'depto 2'),(3,'depto 3');
/*!40000 ALTER TABLE `c_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_desc_fisica`
--

DROP TABLE IF EXISTS `c_desc_fisica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_desc_fisica` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_desc_fisica`
--

LOCK TABLES `c_desc_fisica` WRITE;
/*!40000 ALTER TABLE `c_desc_fisica` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_desc_fisica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_encuadernacion`
--

DROP TABLE IF EXISTS `c_encuadernacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_encuadernacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_encuadernacion`
--

LOCK TABLES `c_encuadernacion` WRITE;
/*!40000 ALTER TABLE `c_encuadernacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_encuadernacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_entidad`
--

DROP TABLE IF EXISTS `c_entidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_entidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `subsistema_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entidad_subsistema` (`subsistema_id`),
  CONSTRAINT `fk_entidad_subsistema` FOREIGN KEY (`subsistema_id`) REFERENCES `c_subsistema` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_entidad`
--

LOCK TABLES `c_entidad` WRITE;
/*!40000 ALTER TABLE `c_entidad` DISABLE KEYS */;
INSERT INTO `c_entidad` VALUES (1,'Facultad de Contaduría y Administración','FCA',1),(2,'Facultad de Estudios Superiores Cuauhtitlan','FES-CUA',1),(3,'Facultad de Estudios Superiores Aragón','FESAR',1);
/*!40000 ALTER TABLE `c_entidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_estado`
--

DROP TABLE IF EXISTS `c_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_estado` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_estado`
--

LOCK TABLES `c_estado` WRITE;
/*!40000 ALTER TABLE `c_estado` DISABLE KEYS */;
INSERT INTO `c_estado` VALUES (1,'Registros incompletos',NULL),(2,'En revisión de DGAJ',NULL),(3,'Corrección',NULL),(4,'Revision indautor (Radicado)',NULL),(5,'Rechazado por indautor',NULL),(6,'Aceptado por indautor',NULL),(7,'Revisión de corrección de la solicitud',NULL);
/*!40000 ALTER TABLE `c_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_formato`
--

DROP TABLE IF EXISTS `c_formato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_formato` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_formato`
--

LOCK TABLES `c_formato` WRITE;
/*!40000 ALTER TABLE `c_formato` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_formato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_gramaje`
--

DROP TABLE IF EXISTS `c_gramaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_gramaje` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_gramaje`
--

LOCK TABLES `c_gramaje` WRITE;
/*!40000 ALTER TABLE `c_gramaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_gramaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_idioma`
--

DROP TABLE IF EXISTS `c_idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_idioma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_idioma`
--

LOCK TABLES `c_idioma` WRITE;
/*!40000 ALTER TABLE `c_idioma` DISABLE KEYS */;
INSERT INTO `c_idioma` VALUES (1,'Español'),(2,'Inglés'),(3,'Italiano');
/*!40000 ALTER TABLE `c_idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_idioma_al`
--

DROP TABLE IF EXISTS `c_idioma_al`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_idioma_al` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_idioma_al`
--

LOCK TABLES `c_idioma_al` WRITE;
/*!40000 ALTER TABLE `c_idioma_al` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_idioma_al` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_idioma_del`
--

DROP TABLE IF EXISTS `c_idioma_del`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_idioma_del` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_idioma_del`
--

LOCK TABLES `c_idioma_del` WRITE;
/*!40000 ALTER TABLE `c_idioma_del` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_idioma_del` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_img_size`
--

DROP TABLE IF EXISTS `c_img_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_img_size` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_img_size`
--

LOCK TABLES `c_img_size` WRITE;
/*!40000 ALTER TABLE `c_img_size` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_img_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_impresion`
--

DROP TABLE IF EXISTS `c_impresion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_impresion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_impresion`
--

LOCK TABLES `c_impresion` WRITE;
/*!40000 ALTER TABLE `c_impresion` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_impresion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_medio`
--

DROP TABLE IF EXISTS `c_medio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_medio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_medio`
--

LOCK TABLES `c_medio` WRITE;
/*!40000 ALTER TABLE `c_medio` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_medio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_subcategoria`
--

DROP TABLE IF EXISTS `c_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pk_sc_cat` (`id_categoria`),
  CONSTRAINT `pk_sc_cat` FOREIGN KEY (`id_categoria`) REFERENCES `c_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_subcategoria`
--

LOCK TABLES `c_subcategoria` WRITE;
/*!40000 ALTER TABLE `c_subcategoria` DISABLE KEYS */;
INSERT INTO `c_subcategoria` VALUES (1,'Metafísica',1);
/*!40000 ALTER TABLE `c_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_subsistema`
--

DROP TABLE IF EXISTS `c_subsistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_subsistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_subsistema`
--

LOCK TABLES `c_subsistema` WRITE;
/*!40000 ALTER TABLE `c_subsistema` DISABLE KEYS */;
INSERT INTO `c_subsistema` VALUES (1,'Facultades y escuelas'),(2,'Coordinación de Difusión Cultural'),(3,'ADMINISTRACIÓN CENTRAL');
/*!40000 ALTER TABLE `c_subsistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_tamanio`
--

DROP TABLE IF EXISTS `c_tamanio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_tamanio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_tamanio`
--

LOCK TABLES `c_tamanio` WRITE;
/*!40000 ALTER TABLE `c_tamanio` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_tamanio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_tinta`
--

DROP TABLE IF EXISTS `c_tinta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_tinta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_tinta`
--

LOCK TABLES `c_tinta` WRITE;
/*!40000 ALTER TABLE `c_tinta` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_tinta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_tipo_contenido`
--

DROP TABLE IF EXISTS `c_tipo_contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_tipo_contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_tipo_contenido`
--

LOCK TABLES `c_tipo_contenido` WRITE;
/*!40000 ALTER TABLE `c_tipo_contenido` DISABLE KEYS */;
INSERT INTO `c_tipo_contenido` VALUES (1,'Periodística'),(2,'Cuento');
/*!40000 ALTER TABLE `c_tipo_contenido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_tipo_papel`
--

DROP TABLE IF EXISTS `c_tipo_papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_tipo_papel` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_tipo_papel`
--

LOCK TABLES `c_tipo_papel` WRITE;
/*!40000 ALTER TABLE `c_tipo_papel` DISABLE KEYS */;
/*!40000 ALTER TABLE `c_tipo_papel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaboradores` (
  `id_colab` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo` char(1) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  PRIMARY KEY (`id_colab`),
  KEY `fk_colab_sol` (`solicitud_id`),
  CONSTRAINT `fk_colab_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` VALUES (1,'Miguel González Guagnelli','A',3),(2,'Jesús','C',3),(3,'Eduardo','C',3),(4,'Guillermo Chavez','A',13),(5,'Miguel Guanelli','C',13);
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comercializable`
--

DROP TABLE IF EXISTS `comercializable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comercializable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ejemplares_nacional` int(11) NOT NULL,
  `precio_local` decimal(9,2) NOT NULL,
  `ejemplares_externa` int(11) NOT NULL,
  `precio_externo` decimal(9,2) NOT NULL,
  `oferta_total` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comersializable_sol` (`solicitud_id`),
  CONSTRAINT `fk_comersializable_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comercializable`
--

LOCK TABLES `comercializable` WRITE;
/*!40000 ALTER TABLE `comercializable` DISABLE KEYS */;
/*!40000 ALTER TABLE `comercializable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desc_electronica`
--

DROP TABLE IF EXISTS `desc_electronica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desc_electronica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `medio` int(11) NOT NULL,
  `formato` int(11) NOT NULL,
  `tamanio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_de_sol` (`solicitud_id`),
  KEY `fk_de_medio` (`medio`),
  KEY `fk_de_formato` (`formato`),
  KEY `fk_de_tamanio` (`tamanio`),
  CONSTRAINT `fk_de_formato` FOREIGN KEY (`formato`) REFERENCES `c_formato` (`id`),
  CONSTRAINT `fk_de_medio` FOREIGN KEY (`medio`) REFERENCES `c_medio` (`id`),
  CONSTRAINT `fk_de_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`),
  CONSTRAINT `fk_de_tamanio` FOREIGN KEY (`tamanio`) REFERENCES `c_tamanio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desc_electronica`
--

LOCK TABLES `desc_electronica` WRITE;
/*!40000 ALTER TABLE `desc_electronica` DISABLE KEYS */;
/*!40000 ALTER TABLE `desc_electronica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desc_fisica_impresa`
--

DROP TABLE IF EXISTS `desc_fisica_impresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desc_fisica_impresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `desc_fisica` int(11) NOT NULL,
  `encuadernacion` int(11) NOT NULL,
  `tipo_papel` int(11) NOT NULL,
  `impresion` int(11) NOT NULL,
  `tinta` int(11) NOT NULL,
  `gramaje` int(11) NOT NULL,
  `no_paginas` int(11) NOT NULL,
  `ancho` int(11) NOT NULL,
  `alto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dfi_sol` (`solicitud_id`),
  KEY `fk_dfi_df` (`desc_fisica`),
  KEY `fk_dfi_enc` (`encuadernacion`),
  KEY `fk_dfi_tp` (`tipo_papel`),
  KEY `fk_dfi_imp` (`impresion`),
  KEY `fk_dfi_tint` (`tinta`),
  KEY `fk_dfi_gram` (`gramaje`),
  CONSTRAINT `fk_dfi_df` FOREIGN KEY (`desc_fisica`) REFERENCES `c_desc_fisica` (`id`),
  CONSTRAINT `fk_dfi_enc` FOREIGN KEY (`encuadernacion`) REFERENCES `c_encuadernacion` (`id`),
  CONSTRAINT `fk_dfi_gram` FOREIGN KEY (`gramaje`) REFERENCES `c_gramaje` (`id`),
  CONSTRAINT `fk_dfi_imp` FOREIGN KEY (`impresion`) REFERENCES `c_impresion` (`id`),
  CONSTRAINT `fk_dfi_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`),
  CONSTRAINT `fk_dfi_tint` FOREIGN KEY (`tinta`) REFERENCES `c_tinta` (`id`),
  CONSTRAINT `fk_dfi_tp` FOREIGN KEY (`tipo_papel`) REFERENCES `c_tipo_papel` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desc_fisica_impresa`
--

LOCK TABLES `desc_fisica_impresa` WRITE;
/*!40000 ALTER TABLE `desc_fisica_impresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `desc_fisica_impresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edicion`
--

DROP TABLE IF EXISTS `edicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `no_edicion` int(11) NOT NULL,
  `depto_id` int(11) NOT NULL,
  `fecha_aparicion` date NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `coedicion` decimal(1,0) NOT NULL DEFAULT '0',
  `coeditor` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_edicion_sol` (`solicitud_id`),
  KEY `fk_edicion_depto` (`depto_id`),
  KEY `fk_edicion_city` (`ciudad_id`),
  CONSTRAINT `fk_edicion_city` FOREIGN KEY (`ciudad_id`) REFERENCES `c_ciudad` (`id`),
  CONSTRAINT `fk_edicion_depto` FOREIGN KEY (`depto_id`) REFERENCES `c_departamento` (`id`),
  CONSTRAINT `fk_edicion_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edicion`
--

LOCK TABLES `edicion` WRITE;
/*!40000 ALTER TABLE `edicion` DISABLE KEYS */;
/*!40000 ALTER TABLE `edicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epay`
--

DROP TABLE IF EXISTS `epay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `pay_hash` varchar(255) NOT NULL,
  `cadena_dependencia` varchar(255) NOT NULL,
  `cadena_referencia` varchar(255) NOT NULL,
  `no_operacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ep_sol` (`solicitud_id`),
  CONSTRAINT `fk_ep_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epay`
--

LOCK TABLES `epay` WRITE;
/*!40000 ALTER TABLE `epay` DISABLE KEYS */;
/*!40000 ALTER TABLE `epay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hist_revision_isbn`
--

DROP TABLE IF EXISTS `hist_revision_isbn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hist_revision_isbn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_estado_id` int(11) NOT NULL,
  `solicitud_cve` int(11) NOT NULL,
  `reg_revision` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_actual` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_estado_revision` (`c_estado_id`),
  KEY `fk_solicitud_cve` (`solicitud_cve`),
  CONSTRAINT `fk_estado_revision` FOREIGN KEY (`c_estado_id`) REFERENCES `c_estado` (`id`),
  CONSTRAINT `fk_solicitud_cve` FOREIGN KEY (`solicitud_cve`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hist_revision_isbn`
--

LOCK TABLES `hist_revision_isbn` WRITE;
/*!40000 ALTER TABLE `hist_revision_isbn` DISABLE KEYS */;
INSERT INTO `hist_revision_isbn` VALUES (1,1,1,'2016-10-30 22:31:45',0),(2,1,3,'2016-10-31 00:15:16',1),(3,1,2,'2016-10-31 00:15:16',1),(4,1,9,'2016-10-31 03:12:12',0),(14,2,1,'2016-10-31 17:04:25',0),(15,3,1,'2016-10-31 17:11:02',0),(16,2,9,'2016-10-31 17:14:14',0),(17,3,9,'2016-10-31 17:14:30',0),(20,5,1,'2016-11-01 10:42:18',1),(21,1,10,'2016-11-01 18:21:37',0),(22,2,10,'2016-11-01 18:23:32',1),(23,1,11,'2016-11-01 18:29:12',0),(24,2,11,'2016-11-01 18:54:59',0),(25,1,12,'2016-11-05 16:10:12',1),(26,1,13,'2016-11-08 20:34:24',0),(27,2,13,'2016-11-08 20:42:58',0),(28,3,11,'2016-11-08 21:00:19',1),(29,3,13,'2016-11-08 21:00:57',0),(30,2,13,'2016-11-08 21:02:17',0),(31,4,13,'2016-11-08 21:03:42',0),(32,5,13,'2016-11-08 21:05:04',1);
/*!40000 ALTER TABLE `hist_revision_isbn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ic_dioma_original`
--

DROP TABLE IF EXISTS `ic_dioma_original`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ic_dioma_original` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ic_dioma_original`
--

LOCK TABLES `ic_dioma_original` WRITE;
/*!40000 ALTER TABLE `ic_dioma_original` DISABLE KEYS */;
/*!40000 ALTER TABLE `ic_dioma_original` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `isbn` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (1,'A Maze of death','A',NULL),(2,'Un mundo feliz','mundo feliz',NULL),(3,'Un pulque por la paz','pulque',NULL),(4,'Sidartha','sidarta',NULL),(5,'El lobo estepario','wolf',NULL),(6,'Criptonomicon','cript',NULL),(7,'El naranjo','naranjo',NULL),(13,'El coronel no tiene quien le escriba','El cronelas',NULL),(14,'Memoria de mis putas tristes','----',NULL),(15,'Un mundo feliz','----',NULL),(16,'mi obra','subtitulo',NULL),(17,'Antropología','',NULL);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
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
-- Table structure for table `observaciones_seccion_solicitud`
--

DROP TABLE IF EXISTS `observaciones_seccion_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `observaciones_seccion_solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hist_revision_isbn_id` int(11) NOT NULL,
  `seccion_cve` int(11) NOT NULL,
  `is_actual` tinyint(1) DEFAULT '1',
  `comentarios` text,
  `fecha_comment` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_hist_revision_isbn` (`hist_revision_isbn_id`),
  KEY `fk_seccion_solicitud` (`seccion_cve`),
  CONSTRAINT `fk_hist_revision_isbn` FOREIGN KEY (`hist_revision_isbn_id`) REFERENCES `hist_revision_isbn` (`id`),
  CONSTRAINT `fk_seccion_solicitud` FOREIGN KEY (`seccion_cve`) REFERENCES `seccion_solicitud` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observaciones_seccion_solicitud`
--

LOCK TABLES `observaciones_seccion_solicitud` WRITE;
/*!40000 ALTER TABLE `observaciones_seccion_solicitud` DISABLE KEYS */;
INSERT INTO `observaciones_seccion_solicitud` VALUES (1,1,1,1,'Se encuentra en buen estado ','2016-11-01 02:08:30'),(2,20,1,1,'adfsdfsf','2016-11-01 11:55:48'),(3,27,1,1,'comentario de modificación','2016-11-08 21:00:42');
/*!40000 ALTER TABLE `observaciones_seccion_solicitud` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Super-admin'),(2,'Admin'),(3,'DGAJ'),(4,'Entidad');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion_solicitud`
--

DROP TABLE IF EXISTS `seccion_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccion_solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_seccion` varchar(255) NOT NULL,
  `cve_seccion` varchar(5) NOT NULL,
  `tbl_seccion` varchar(200) NOT NULL,
  `srt_seccion` decimal(2,0) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `estado` decimal(1,0) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion_solicitud`
--

LOCK TABLES `seccion_solicitud` WRITE;
/*!40000 ALTER TABLE `seccion_solicitud` DISABLE KEYS */;
INSERT INTO `seccion_solicitud` VALUES (1,'Tema','t','tema',1,'solicitud_id',1),(2,'Idioma','lng','sol_idioma',2,'solicitud',1),(3,'Colaboradores','colab','colaboradores',3,'solicitud_id',1),(4,'Traduccion','trns','traduccion',4,'solicitud_id',1),(5,'Información de edición','ed','edicion',5,'solicitud_id',1),(6,'Comercialización','cmrc','comercializable',6,'solicitud_id',1),(7,'Descripción física','df','desc_fisica',7,'solicitud_id',0),(8,'Pago electrónico','epay','epay',8,'solicitud_id',1),(9,'Código de barras','bc','barcode',9,'solicitud_id',1);
/*!40000 ALTER TABLE `seccion_solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sol_idioma`
--

DROP TABLE IF EXISTS `sol_idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sol_idioma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idioma` int(11) NOT NULL,
  `solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_solicitud_idioma` (`solicitud`,`idioma`),
  KEY `fk_sol_idioma_idioma` (`idioma`),
  CONSTRAINT `fk_sol_idioma_idioma` FOREIGN KEY (`idioma`) REFERENCES `c_idioma` (`id`),
  CONSTRAINT `fk_sol_idioma_solicitud` FOREIGN KEY (`solicitud`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sol_idioma`
--

LOCK TABLES `sol_idioma` WRITE;
/*!40000 ALTER TABLE `sol_idioma` DISABLE KEYS */;
INSERT INTO `sol_idioma` VALUES (61,1,3),(62,2,3),(63,1,13),(64,3,13);
/*!40000 ALTER TABLE `sol_idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `folio` varchar(50) NOT NULL,
  `entidad_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `is_printed` decimal(1,0) DEFAULT '0',
  `is_comercializable` decimal(1,0) DEFAULT '0',
  `has_tema` decimal(1,0) DEFAULT '0',
  `has_idioma` decimal(1,0) DEFAULT '0',
  `has_colaboradores` decimal(1,0) DEFAULT '0',
  `has_traduccion` decimal(1,0) DEFAULT '0',
  `has_informacion_edicion` decimal(1,0) DEFAULT '0',
  `has_comercializable` decimal(1,0) DEFAULT '0',
  `has_desc_fisica` decimal(1,0) DEFAULT '0',
  `has_pago` decimal(1,0) DEFAULT '0',
  `has_codigo_barras` decimal(1,0) DEFAULT '0',
  `id_subcategoria` int(11) NOT NULL,
  `sol_tipo_obra` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_folio` (`folio`),
  KEY `fk_solicitud_entidad` (`entidad_id`),
  KEY `fk_solicitud_libro` (`libro_id`),
  KEY `fk_solicitud_subcat` (`id_subcategoria`),
  CONSTRAINT `fk_solicitud_entidad` FOREIGN KEY (`entidad_id`) REFERENCES `c_entidad` (`id`),
  CONSTRAINT `fk_solicitud_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`),
  CONSTRAINT `fk_solicitud_subcat` FOREIGN KEY (`id_subcategoria`) REFERENCES `c_subcategoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud`
--

LOCK TABLES `solicitud` WRITE;
/*!40000 ALTER TABLE `solicitud` DISABLE KEYS */;
INSERT INTO `solicitud` VALUES (1,'2016-10-01 00:00:00','folio-00001',1,1,0,0,0,0,0,0,0,0,0,0,0,1,NULL),(2,'2016-10-01 00:00:00','folio-00007',2,7,0,0,0,0,0,0,0,0,0,0,0,1,NULL),(3,'2016-10-01 00:00:00','folio-00006',3,5,0,0,1,0,1,1,0,0,0,0,0,1,'I'),(4,'2016-10-01 00:00:00','folio-00005',3,6,0,0,0,0,0,0,0,0,0,0,0,1,NULL),(5,'2016-10-01 00:00:00','folio-00004',2,4,0,0,0,0,0,0,0,0,0,0,0,1,NULL),(6,'2016-10-01 00:00:00','folio-00003',1,3,0,0,0,0,0,0,0,0,0,0,0,1,NULL),(7,'2016-10-01 00:00:00','folio-00002',1,2,0,0,0,0,0,0,0,0,0,0,0,1,NULL),(9,'2016-10-31 03:12:12','folio-0000000013',1,13,0,0,0,0,0,0,0,0,0,0,0,1,'I'),(10,'2016-11-01 18:21:37','folio-0000000014',3,14,0,0,0,0,0,0,0,0,0,0,0,1,'V'),(11,'2016-11-01 18:29:12','folio-0000000015',3,15,0,0,0,0,0,0,0,0,0,0,0,1,'C'),(12,'2016-11-05 16:10:12','folio-0000000016',3,16,0,0,0,0,0,0,0,0,0,0,0,1,'I'),(13,'2016-11-08 20:34:24','folio-0000000017',3,17,0,0,1,0,1,1,0,0,0,0,0,1,'V');
/*!40000 ALTER TABLE `solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tema`
--

DROP TABLE IF EXISTS `tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coleccion` varchar(100) NOT NULL,
  `no_coleccion` varchar(50) NOT NULL,
  `nombre_serie` varchar(200) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `tipo_contenido` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tema_tc` (`tipo_contenido`),
  KEY `fk_tema_sol` (`solicitud_id`),
  CONSTRAINT `fk_tema_sol` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`),
  CONSTRAINT `fk_tema_tc` FOREIGN KEY (`tipo_contenido`) REFERENCES `c_tipo_contenido` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema`
--

LOCK TABLES `tema` WRITE;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
INSERT INTO `tema` VALUES (9,'Colection','numero','serie',3,2),(10,'Grandes libros','123','Serie bien escrita',13,1);
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traduccion`
--

DROP TABLE IF EXISTS `traduccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traduccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_original` varchar(255) NOT NULL,
  `idioma_del` int(11) NOT NULL,
  `idioma_original` int(11) NOT NULL,
  `idioma_al` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_translate_idiomadel` (`idioma_del`),
  KEY `fk_translate_idiomaoriginal` (`idioma_original`),
  KEY `fk_translate_idiomaal` (`idioma_al`),
  KEY `fk_trad_soli` (`solicitud_id`),
  CONSTRAINT `fk_trad_soli` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`),
  CONSTRAINT `fk_translate_idiomaal` FOREIGN KEY (`idioma_al`) REFERENCES `c_idioma` (`id`),
  CONSTRAINT `fk_translate_idiomadel` FOREIGN KEY (`idioma_del`) REFERENCES `c_idioma` (`id`),
  CONSTRAINT `fk_translate_idiomaoriginal` FOREIGN KEY (`idioma_original`) REFERENCES `c_idioma` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traduccion`
--

LOCK TABLES `traduccion` WRITE;
/*!40000 ALTER TABLE `traduccion` DISABLE KEYS */;
INSERT INTO `traduccion` VALUES (4,'Traducción al hebreo',1,3,2,3),(6,'asd',1,1,2,13);
/*!40000 ALTER TABLE `traduccion` ENABLE KEYS */;
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
  `entidad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_cve`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'unam','UNAM','CU','CU','unam@gmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,1,'2016-07-19 03:40:24',NULL),(2,'miguel','Miguel','G','G','miguel@hotmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,2,'2016-07-19 03:42:59',NULL),(3,'admin','Jes','D','P','jesusz.unam@gmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,3,'2016-07-19 03:42:59',NULL),(4,'leas','UNAM','ARAGON','ARAGON','cenitluis.pumas@gmail.com','affd77e05aaae1e7a229c6c4725545fd612bf18dc41cbe6d349084fcf0848f2a261c7272a6200a4255019460550b4393e42d3df10115eaa3ec8bfc57ffc70686',1,4,'2016-10-31 23:54:47',3);
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

-- Dump completed on 2016-11-25  1:00:36
