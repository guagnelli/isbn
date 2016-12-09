-- MySQL dump 10.13  Distrib 5.7.12, for osx10.11 (x86_64)
--
-- Host: localhost    Database: isbn
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
  CONSTRAINT `fk_bc_iz` FOREIGN KEY (`barcode_img`) REFERENCES `c_img_format` (`id`),
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
INSERT INTO `c_barcode_size` VALUES (1,'Pequeño (216 X 220 px)'),(2,'Normal (540 X 400 px)'),(3,'Grande (1080 X 700 px)');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_categoria`
--

LOCK TABLES `c_categoria` WRITE;
/*!40000 ALTER TABLE `c_categoria` DISABLE KEYS */;
INSERT INTO `c_categoria` VALUES (0,' 0 - Generalidades'),(1,'100 - Filosofía y psicología'),(2,'200 - Religión'),(3,'300 - Ciencias sociales'),(4,'400 - Lenguas'),(5,'500 - Ciencias naturales y matemáticas'),(6,'600 - Tecnología (Ciencias aplicadas)'),(7,'700 - Las Artes Bellas artes y artes decorativas'),(8,'800 - Literatura y retórica'),(9,'900 - Geografía e historia');
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
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_ciudad`
--

LOCK TABLES `c_ciudad` WRITE;
/*!40000 ALTER TABLE `c_ciudad` DISABLE KEYS */;
INSERT INTO `c_ciudad` VALUES (1,'Acambay'),(2,'Acolman'),(3,'Aculco'),(4,'Almoloya de Alquisiras'),(5,'Almoloya de Juárez'),(6,'Almoloya del Río'),(7,'Amanalco'),(8,'Amatepec'),(9,'Amecameca'),(10,'Apaxco'),(11,'Atenco'),(12,'Atizapán'),(13,'Atizapán de Zaragoza'),(14,'Atlacomulco'),(15,'Atlautla'),(16,'Axapusco'),(17,'Ayapango'),(18,'Calimaya'),(19,'Capulhuac'),(20,'Ciudad López Mateos'),(21,'Coacalco de Berriozábal'),(22,'Coatepec Harinas'),(23,'Cocotitlán'),(24,'Coyotepec'),(25,'Cuautitlán'),(26,'Chalco'),(27,'Chapa de Mota'),(28,'Chapultepec'),(29,'Chiautla'),(30,'Chicoloapan'),(31,'Chiconcuac'),(32,'Chimalhuacán'),(33,'Donato Guerra'),(34,'Ecatepec de Morelos'),(35,'Ecatzingo'),(36,'Huehuetoca'),(37,'Hueypoxtla'),(38,'Huixquilucan'),(39,'Isidro Fabela'),(40,'Ixtapaluca'),(41,'Ixtapan de la Sal'),(42,'Ixtapan del Oro'),(43,'Ixtlahuaca'),(44,'Xalatlaco'),(45,'Jaltenco'),(46,'Jilotepec'),(47,'Jilotzingo'),(48,'Jiquipilco'),(49,'Jocotitlán'),(50,'Joquicingo'),(51,'Juchitepec'),(52,'Lerma'),(53,'Malinalco'),(54,'Melchor Ocampo'),(55,'Metepec'),(56,'Mexicaltzingo'),(57,'Morelos'),(58,'Naucalpan de Juárez'),(59,'Nezahualcóyotl'),(60,'Nextlalpan'),(61,'Nicolás Romero'),(62,'Nopaltepec'),(63,'Ocoyoacac'),(64,'Ocuilan'),(65,'El Oro'),(66,'Otumba'),(67,'Otzoloapan'),(68,'Otzolotepec'),(69,'Ozumba'),(70,'Papalotla'),(71,'La Paz'),(72,'Polotitlán'),(73,'Rayón'),(74,'San Antonio la Isla'),(75,'San Felipe del Progreso'),(76,'San Martín de las Pirámides'),(77,'San Mateo Atenco'),(78,'San Simón de Guerrero'),(79,'Santo Tomás'),(80,'Soyaniquilpan de Juárez'),(81,'Sultepec'),(82,'Tecámac'),(83,'Tejupilco de Hidalgo'),(84,'Temamatla'),(85,'Temascalapa'),(86,'Temascalcingo'),(87,'Temascaltepec'),(88,'Temoaya'),(89,'Tenancingo'),(90,'Tenango del Aire'),(91,'Tenango del Valle'),(92,'Teoloyucán'),(93,'Teotihuacán'),(94,'Tepetlaoxtoc'),(95,'Tepetlixpa'),(96,'Tepotzotlán'),(97,'Tequixquiac'),(98,'Texcaltitlán'),(99,'Texcalyacac'),(100,'Texcoco'),(101,'Tezoyuca'),(102,'Tianguistenco'),(103,'Timilpan'),(104,'Tlalmanalco'),(105,'Tlalnepantla de Baz'),(106,'Tlatlaya'),(107,'Toluca'),(108,'Tonatico'),(109,'Tultepec'),(110,'Tultitlán'),(111,'Valle de Bravo'),(112,'Villa de Allende'),(113,'Villa del Carbón'),(114,'Villa Guerrero'),(115,'Villa Victoria'),(116,'Xonacatlán'),(117,'Zacazonapan'),(118,'Zacualpan'),(119,'Zinacantepec'),(120,'Zumpahuacán'),(121,'Zumpango'),(122,'Cuautitlán Izcalli'),(123,'Valle de Chalco Solidaridad'),(124,'Luvianos'),(125,'San José del Rincón'),(126,'Tonanitla');
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_departamento`
--

LOCK TABLES `c_departamento` WRITE;
/*!40000 ALTER TABLE `c_departamento` DISABLE KEYS */;
INSERT INTO `c_departamento` VALUES (1,'Aguascalientes'),(2,'Baja California'),(3,'Baja California Sur'),(4,'Campeche'),(5,'Chiapas'),(6,'Chihuahua'),(7,'Ciudad de México, DF'),(8,'Coahuila'),(9,'Colima'),(10,'Durango'),(11,'Estado de México'),(12,'Guanajuato'),(13,'Guerrero'),(14,'Hidalgo'),(15,'Jalisco'),(16,'Michoacán'),(17,'Morelos'),(18,'Nayarit'),(19,'Nuevo León'),(20,'Oaxaca'),(21,'Puebla'),(22,'Querétaro Arteaga'),(23,'Quintana Roo'),(24,'San Luis Potosí'),(25,'Sinaloa'),(26,'Sonora'),(27,'Tabasco'),(28,'Tamaulipas'),(29,'Tlaxcala'),(30,'Veracruz'),(31,'Yucatán'),(32,'Zacatecas');
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
INSERT INTO `c_desc_fisica` VALUES (1,'Libro impreso en papel'),(2,'Folleto'),(3,'Fascículo'),(4,'Braille');
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
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_entidad`
--

LOCK TABLES `c_entidad` WRITE;
/*!40000 ALTER TABLE `c_entidad` DISABLE KEYS */;
INSERT INTO `c_entidad` VALUES (1,'Facultad de Contaduría y Administración','FCA',1),(2,'Facultad de Estudios Superiores Cuauhtitlan','FES-CUA',1),(3,'Facultad de Estudios Superiores Aragón','FESAR',1),(77,'Centro de Ciencias Aplicadas y Desarrollo Tecnológico',NULL,NULL),(78,'Centro de Ciencias de la Atmósfera',NULL,NULL),(79,'Centro de Ciencias de la Atmósfera',NULL,NULL),(80,'Centro de Enseñanza de Lenguas Extranjeras',NULL,NULL),(81,'Centro de Enseñanza para Extranjeros',NULL,NULL),(82,'Centro de Investigaciones Interdisciplinarias en Ciencias y Humanidades',NULL,NULL),(83,'Centro de Investigaciones Multidisciplinarias sobre Chiapas y la Frontera Sur',NULL,NULL),(84,'Centro de Investigaciones sobre América del Norte',NULL,NULL),(85,'Centro de Investigaciones sobre América Latina y el Caribe',NULL,NULL),(86,'Centro Peninsular en Humanidades y Ciencias Sociales',NULL,NULL),(87,'Colegio de Ciencias y Humanidades',NULL,NULL),(88,'Colegio de Ciencias y Humanidades, Plantel Naucalpan',NULL,NULL),(89,'Coordinación de Difusión Cultural',NULL,NULL),(90,'Coordinación de Investigación Científica',NULL,NULL),(91,'Coordinación de Universidad Abierta y Educación a Distancia',NULL,NULL),(92,'Dirección de Literatura',NULL,NULL),(93,'Dirección General de Bibliotecas',NULL,NULL),(94,'Dirección General de Colegio de Ciencias y Humanidades',NULL,NULL),(95,'Dirección General de Cómputo y de Tecnologías de Información y Comunicación',NULL,NULL),(96,'Dirección General de Divulgación de la Ciencia',NULL,NULL),(97,'Dirección General de la Escuela Nacional Preparatoria',NULL,NULL),(98,'Dirección General de Servicios de Cómputo Académico',NULL,NULL),(99,'Escuela de Trabajo Social',NULL,NULL),(100,'Escuela Nacional de Enfermería y Obstetricia',NULL,NULL),(101,'Escuela Nacional de Estudios Superiores, Unidad León',NULL,NULL),(102,'Escuela Nacional de Música',NULL,NULL),(103,'Escuela Nacional Preparatoria, Plantel 6 ',NULL,NULL),(104,'Facultad de Arquitectura',NULL,NULL),(105,'Facultad de Artes y Diseño',NULL,NULL),(106,'Facultad de Artes y Diseño, plantel Taxco',NULL,NULL),(107,'Facultad de Ciencias',NULL,NULL),(108,'Facultad de Ciencias Políticas y Sociales',NULL,NULL),(110,'Facultad de Derecho',NULL,NULL),(111,'Facultad de Economía',NULL,NULL),(112,'Facultad de Economía/ Instituto de Investigaciones Económicas',NULL,NULL),(113,'Facultad de Estudios Superiores Acatlán',NULL,NULL),(115,'Facultad de Estudios Superiores Aragón/ Facultad de Estudios Superiores Acatlán',NULL,NULL),(117,'Facultad de Estudios Superiores Iztacala',NULL,NULL),(118,'Facultad de Estudios Superiores Zaragoza',NULL,NULL),(119,'Facultad de Filosofía y Letras',NULL,NULL),(120,'Facultad de Ingeniería',NULL,NULL),(121,'Facultad de Ingeniería/ Instituto de Geología/ Centro de Geociencias',NULL,NULL),(122,'Facultad de Medicina',NULL,NULL),(123,'Facultad de Medicina Veterinaria y Zootecnia',NULL,NULL),(124,'Facultad de Odontología',NULL,NULL),(125,'Facultad de Psicología',NULL,NULL),(126,'Facultad de Química',NULL,NULL),(127,'Instituto de Astronomía',NULL,NULL),(128,'Instituto de Biología',NULL,NULL),(129,'Instituto de Biotecnología',NULL,NULL),(130,'Instituto de Ecología',NULL,NULL),(131,'Instituto de Geofísica',NULL,NULL),(132,'Instituto de Geografía',NULL,NULL),(133,'Instituto de Geología',NULL,NULL),(134,'Instituto de Geología',NULL,NULL),(135,'Instituto de Ingeniería ',NULL,NULL),(136,'Instituto de Investigaciones Antropológicas',NULL,NULL),(137,'Instituto de Investigaciones Bibliográficas',NULL,NULL),(138,'Instituto de Investigaciones Bibliotecológicas y de la Información',NULL,NULL),(139,'Instituto de Investigaciones Biomédicas',NULL,NULL),(140,'Instituto de Investigaciones Económicas',NULL,NULL),(141,'Instituto de Investigaciones en Matemáticas Aplicadas y en Sistemas',NULL,NULL),(142,'Instituto de Investigaciones en Materiales',NULL,NULL),(143,'Instituto de Investigaciones Estéticas',NULL,NULL),(144,'Instituto de Investigaciones Filológicas',NULL,NULL),(145,'Instituto de Investigaciones Filosóficas',NULL,NULL),(146,'Instituto de Investigaciones Históricas',NULL,NULL),(147,'Instituto de Investigaciones Jurídicas',NULL,NULL),(148,'Instituto de Investigaciones sobre la Universidad y la Educación',NULL,NULL),(149,'Instituto de Investigaciones Sociales',NULL,NULL),(150,'Instituto de Investigaciones Sociales',NULL,NULL),(151,'Instituto de Matemáticas',NULL,NULL),(152,'Posgrado en Estudios Latinoamericanos',NULL,NULL),(153,'Posgrado en Música',NULL,NULL),(154,'Posgrado en Urbanismo',NULL,NULL);
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
INSERT INTO `c_estado` VALUES (1,'Registros incompletos',NULL),(2,'En revisión de DGAJ',NULL),(3,'Corrección',NULL),(4,'Revision indautor (Radicado)',NULL),(5,'Rechazado por indautor',NULL),(6,'Aceptado por indautor',NULL),(7,'Correcciones atendidas',NULL);
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
INSERT INTO `c_formato` VALUES (1,'HTML'),(2,'ASCII'),(3,'PDF'),(4,'exe'),(5,'Microsoft reader'),(6,'Oebps'),(7,'XML'),(8,'Rich text format (*.rtf)'),(9,'Otro');
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
INSERT INTO `c_gramaje` VALUES (1,'0-19'),(2,'20-59'),(3,'60-75'),(4,'76-89'),(5,'90 en adelante');
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_idioma`
--

LOCK TABLES `c_idioma` WRITE;
/*!40000 ALTER TABLE `c_idioma` DISABLE KEYS */;
INSERT INTO `c_idioma` VALUES (1,'Achi\''),(2,'Achuar'),(3,'Afrikaans'),(4,'Alemán'),(5,'Árabe'),(6,'Awa'),(7,'Aymara'),(8,'Ayoreo'),(9,'Cahchi'),(10,'Catalán'),(11,'Checo'),(12,'Chino'),(13,'Coreano'),(14,'Croata'),(15,'Danés'),(16,'Eslovaco'),(17,'Español'),(18,'Finlandés'),(19,'Francés'),(20,'Griego'),(21,'Guaraní'),(22,'Guayabero'),(23,'Hebreo'),(24,'Hindú'),(25,'Holandés'),(26,'Húngaro'),(27,'Inglés'),(28,'Italiano'),(29,'Japonés'),(30,'Latín'),(31,'Mapudungun'),(32,'Multilingüe'),(33,'Náhuatl'),(34,'Noruego'),(35,'Pemon'),(36,'Persa'),(37,'Piaroa'),(38,'Polaco'),(39,'Poqomchi'),(40,'Portugués'),(41,'Q\'eqchi\''),(42,'Quechua'),(43,'Rumano'),(44,'Ruso'),(45,'Sanscrito'),(46,'Shuar'),(47,'Sueco'),(48,'Turco');
/*!40000 ALTER TABLE `c_idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_img_format`
--

DROP TABLE IF EXISTS `c_img_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_img_format` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_img_format`
--

LOCK TABLES `c_img_format` WRITE;
/*!40000 ALTER TABLE `c_img_format` DISABLE KEYS */;
INSERT INTO `c_img_format` VALUES (1,'JPG'),(2,'PNG'),(3,'GIF'),(4,'PS');
/*!40000 ALTER TABLE `c_img_format` ENABLE KEYS */;
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
INSERT INTO `c_impresion` VALUES (1,'Espiral'),(2,'Pasta'),(3,'Plástico'),(4,'Rústico'),(5,'Tapa dura'),(6,'Tela'),(7,'Otro');
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
INSERT INTO `c_medio` VALUES (1,'Casete-audio'),(2,'CD-Audio'),(3,'CD-ROM'),(4,'Disquete'),(5,'DVD-Video'),(6,'E-book'),(7,'Internet'),(8,'Otro'),(9,'Publicación digitalizada'),(10,'Videos-VHS');
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
  `nombre` varchar(255) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pk_sc_cat` (`id_categoria`),
  CONSTRAINT `pk_sc_cat` FOREIGN KEY (`id_categoria`) REFERENCES `c_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1689 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_subcategoria`
--

LOCK TABLES `c_subcategoria` WRITE;
/*!40000 ALTER TABLE `c_subcategoria` DISABLE KEYS */;
INSERT INTO `c_subcategoria` VALUES (1,'110 - Metafísica',1),(5,'103 - Diccionarios y enciclopedias de Filosofía',1),(6,'107 - Educación. investigación. temas relacionados con la filosofía',1),(7,'109 - Tratamiento histórico y colectivo de la filosofía',1),(8,'111 - Ontología',1),(9,'113 - Cosmología (Filosofía de la naturaleza)',1),(10,'114 - Espacio',1),(11,'115 - Tiempo',1),(12,'116 - Cambio',1),(13,'117 - Estructura',1),(14,'118 - Fuerza y energía',1),(15,'120 - Epistemología. causalidad. género humano',1),(16,'121 - Epistemología (Teoría del conocimiento)',1),(17,'122 - Causalidad',1),(18,'123 - Determinismo e indeterminismo',1),(19,'126 - El yo',1),(20,'127 - Inconsciente (el) Subconsciente (el)',1),(21,'128 - Género humano',1),(22,'129 - Orígenes y destino de las almas individuales',1),(23,'130 - Fenómenos paranormales',1),(24,'131 - Métodos parapsicológicos y ocultos',1),(25,'133 - Parapsicología y ocultismo',1),(26,'140 - Escuelas filosóficas específicas',1),(27,'141 - Idealismo y sistemas relacionados',1),(28,'142 - Filosofía crítica',1),(29,'144 - Humanismo y sistemas relacionados',1),(30,'145 - Sensacionalismo',1),(31,'146 - Naturalismo y sistemas relacionados',1),(32,'147 - Panteísmo y sistemas relacionados',1),(33,'148 - Eclecticismo. liberalismo. tradicionalismo',1),(34,'149 - Otros sistemas filosóficos',1),(35,'149.3 - Misticismo',1),(36,'149.8 - Nihilismo',1),(37,'149.9 - Otros sistemas y doctrinas',1),(38,'150 - Psicología',1),(39,'150.1 - Filosofía y teoría de la psicología',1),(40,'150.19 - Sistemas. escuelas. puntos de vista de la psicología',1),(41,'152 - Percepción. movimiento. emociones. impulsos',1),(42,'153 - Procesos mentales e inteligencia',1),(43,'153.8 - Voluntad (Volición)',1),(44,'154 - Subconsciente y estados alterados',1),(45,'155 - Psicología diferencial y del desarrollo',1),(46,'155.3 - Psicología sexual y psicología de los sexos',1),(47,'155.4 - Psicología infantil',1),(48,'155.5 - Psicología de la gente joven de doce a veinte años',1),(49,'155.6 - Psicología de adultos',1),(50,'155.7 - Psicología evolutiva',1),(51,'155.8 - Etnopsicología y psicología nacional',1),(52,'156 - Psicología comparada',1),(53,'158 - Psicología aplicada',1),(54,'158.1 - Mejoramiento y análisis personal',1),(55,'160 - Lógica',1),(56,'165 - Falacia y fuentes de error',1),(57,'170 - Ética (Filosofía moral)',1),(58,'171 - Sistemas éticos',1),(59,'172 - Ética política',1),(60,'173 - Ética de las relaciones familiares',1),(61,'174 - Ética ocupacional',1),(62,'175 - Ética de la recreación y el tiempo libre',1),(63,'176 - Ética del sexo y de la reproducción',1),(64,'177 - Ética de las relaciones sociales',1),(65,'179.2 - Trato de los niños',1),(66,'179.7 - Respeto y falta de respeto por la vida humana',1),(67,'179.8 - Vicios. defectos. debilidades',1),(68,'180 - Filosofía antigua. medieval. oriental',1),(69,'190 - Filosofía moderna occidental',1),(70,'192 - Filosofía de las Islas Británicas',1),(71,'193 - Filosofía de Alemania y Austria',1),(72,'194 - Filosofía de Francia',1),(73,'195 - Filosofía italiana y rumana',1),(74,'196 - Filosofía',1),(75,'200.1 - Sistemas. valores. principios científicos. psicología de la religión',2),(76,'200.9 - Tratamiento histórico. geográfico. de personas en la religión',2),(77,'210 - Filosofía y teoría de la religión',2),(78,'211 - Conceptos de Dios',2),(79,'212 - Existencia. sapiencia. atributos de Dios',2),(80,'213 - Creación',2),(81,'214 - Teodicea',2),(82,'215 - Ciencia y religión',2),(83,'220 - La Biblia',2),(84,'221 - Antiguo Testamento (Tanakh)',2),(85,'225 - Nuevo Testamento',2),(86,'229 - Apócrifos y pseudoepígrafes',2),(87,'230 - Cristianismo Teología cristiana',2),(88,'231 - Dios',2),(89,'232 - Jesucristo y su familia',2),(90,'234 - Salvación (Soteriología) y gracias',2),(91,'235 - Seres espirituales',2),(92,'236 - Escatología',2),(93,'238 - Credos y catecismos',2),(94,'239 - Apologética y polémicas',2),(95,'240 - Moral cristiana y teología piadosa',2),(96,'242 - Literatura piadosa',2),(97,'248 - Experiencia. práctica. vida cristianas',2),(98,'250 - Ordenes cristianas e iglesia local',2),(99,'253 - Oficio pastoral (Teología pastoral)',2),(100,'254 - Administración de la parroquia',2),(101,'255 - Congregaciones y órdenes religiosas',2),(102,'261 - Teología social ',2),(103,'262 - Eclesiología',2),(104,'262.001 - Filosofía y teoría de la eclesiología',2),(105,'262.1 - Jerarcas que rigen las iglesias',2),(106,'262.4 - Gobiernos y organizaciones de sistemas regidos por elección ',2),(107,'262.5 - Concilios generales',2),(108,'262.7 - Naturaleza de la Iglesia',2),(109,'262.9 - Derecho y disciplina eclesiásticas',2),(110,'262.91 - Actas de la Santa Sede',2),(111,'263 - Días. épocas. lugares de observancias',2),(112,'263.91 - Adviento y Navidad',2),(113,'263.92 - Cuaresma ',2),(114,'263.93 - Época de pascua',2),(115,'264 - Culto público',2),(116,'266 - Misiones',2),(117,'267 - Asociaciones para trabajo religioso',2),(118,'268 - Educación religiosa',2),(119,'270 - Historia del cristianismo y de la iglesia cristiana',2),(120,'271 - Ordenes religiosas en la historia de la iglesia',2),(121,'273 - Controversias y herejías doctrinales',2),(122,'274 - Historia del cristianismo en Europa',2),(123,'277 - Historia del cristianismo en América del Norte',2),(124,'278 - Historia del cristianismo en América del Sur',2),(125,'280 - Confesiones y sectas cristianas',2),(126,'281 - Iglesia temprana e iglesias orientales',2),(127,'282 - Iglesia Católica Romana',2),(128,'284 - Protestantes de origen continental',2),(129,'285 - Iglesias presbiterianas. reformadas. congregacionales',2),(130,'286 - Iglesias bautistas. de los Discípulos de Cristo. adventistas',2),(131,'289 - Otras confesiones y sectas',2),(132,'291 - Religión comparada',2),(133,'291.13 - Mitología religiosa, teología social',2),(134,'291.75 - Misiones y educación religiosa',2),(135,'292 - Religión clásica (griega y romana)',2),(136,'294 - Religiones de origen índico',2),(137,'294.3 - Budismo',2),(138,'294.5 - Hinduismo',2),(139,'296 - Judaísmo',2),(140,'297 - Islamismo. babismo. fe bahai',2),(141,'299 - Otras religiones',2),(142,'299.51 - Religiones de origen chino',2),(143,'299.6 - Religiones que surgieron del África negra',2),(144,'299.8 - Religiones de origen nativo sudamericano',2),(145,'300.03 - Diccionarios de ciencias sociales',3),(146,'301 - Sociología y antropología',3),(147,'302 - Interacción social',3),(148,'302.14 - Participación social',3),(149,'302.2 - Comunicación social',3),(150,'302.23 - Medios (Formas de comunicación)',3),(151,'302.24 - Contenido',3),(152,'303 - Procesos sociales',3),(153,'303.32 - Socialización',3),(154,'303.38 - Opinión pública',3),(155,'303.4 - Cambio social',3),(156,'303.6 - Conflicto',3),(157,'304 - Factores que afectan el comportamiento social',3),(158,'304.2 - Ecología humana',3),(159,'304.6 - Población',3),(160,'304.8 - Movimiento de gente',3),(161,'305 - Grupos sociales',3),(162,'305.23 - Gente joven',3),(163,'305.24 - Adultos',3),(164,'305.26 - Personas en edad adulta tardía',3),(165,'305.3 - Hombres y mujeres',3),(166,'305.4 - Mujeres',3),(167,'305.5 - Clases sociales',3),(168,'305.6 - Grupos religiosos',3),(169,'305.7 - Grupos lingüísticos',3),(170,'305.8 - Grupos raciales. étnicos. nacionales',3),(171,'306 - Cultura e instituciones',3),(172,'306.1 - Subculturas',3),(173,'306.2 - Instituciones políticas',3),(174,'306.3 - Instituciones económicas',3),(175,'306.4 - Aspectos específicos de la cultura',3),(176,'306.6 - Instituciones religiosas',3),(177,'306.7 - Instituciones concernientes a las relaciones de los sexos',3),(178,'306.8 - Matrimonio y familia',3),(179,'307 - Comunidades',3),(180,'307.14 - Desarrollo ',3),(181,'307.3 - Estructura',3),(182,'307.7 - Clases específicas de comunidades',3),(183,'307.72 - Comunidades rurales',3),(184,'310 - Colecciones de estadística general',3),(185,'317 - Estadísticas generales de América del Norte',3),(186,'320 - Ciencia política (Política y gobierno)',3),(187,'320.03 - Diccionarios de ciencias políticas',3),(188,'320.1 - El Estado',3),(189,'320.5 - Ideologías políticas',3),(190,'321 - Sistemas de gobiernos y de estados',3),(191,'321.3 - Feudalismo',3),(192,'321.8 - Democracias modernas',3),(193,'322 - Relación del estado con grupos organizados',3),(194,'323 - Derechos civiles y políticos',3),(195,'323.4 - Derechos civiles específicos, limitación y suspensión ',3),(196,'323.5 - Derechos políticos',3),(197,'323.6 - Ciudadanía y temas relacionados',3),(198,'324 - El proceso político',3),(199,'325 - Migración y colonización internacionales',3),(200,'325.1 - Inmigración',3),(201,'325.2 - Emigración',3),(202,'325.3 - Colonización',3),(203,'326 - Esclavitud y emancipación',3),(204,'327 - Relaciones internacionales',3),(205,'327.1 - Política exterior y temas específicos en las relaciones internacionales',3),(206,'327.101 - Filosofía y teoría de las relaciones internacionales Geopolítica',3),(207,'327.14 - Propaganda y guerra de nervios',3),(208,'327.172 - Promoción de la paz y orden internacional',3),(209,'327.2 - Diplomacia',3),(210,'327.3 - Relaciones exteriores de naciones específicas',3),(211,'328 - El proceso legislativo',3),(212,'328.1 - Reglamentos y procedimientos de cuerpos legislativos',3),(213,'328.2 - Iniciativa y referéndum',3),(214,'328.3 - Temas específicos de los cuerpos legislativos',3),(215,'328.31 - Cámaras altas',3),(216,'328.32 - Cámaras bajas',3),(217,'328.36 - Organización y disciplina internas',3),(218,'328.37 - Promulgación de la legislación',3),(219,'328.8 - Cabildeo',3),(220,'330 - Economía ',3),(221,'330.1 - Sistemas. escuelas. teorías de la economía',3),(222,'330.15 - Escuelas de pensamiento económico',3),(223,'330.16 - Teorías de la riqueza',3),(224,'330.9 - Situación y condiciones económicas',3),(225,'331 - Economía laboral',3),(226,'331.1 - Fuerza y mercado laborales',3),(227,'331.137 - Desempleo',3),(228,'331.2 - Condiciones de empleo',3),(229,'331.21 - Remuneración',3),(230,'331.252 - Pensiones',3),(231,'331.255 - Beneficios suplementarios',3),(232,'331.257 - Horarios',3),(233,'331.259 - Adiestramiento. seguridad del trabajador. reglamentación',3),(234,'331.31 - Niños trabajadores',3),(235,'331.34 - Gente joven trabajadora',3),(236,'331.4 - Mujeres trabajadoras',3),(237,'331.881 - Sindicatos',3),(238,'331.89 - Negociación colectiva',3),(239,'331.892 - Huelgas',3),(240,'332 - Economía financiera',3),(241,'332.041 - Capital',3),(242,'332.1 - Bancos',3),(243,'332.114 - Operaciones bancarias',3),(244,'332.2 - Instituciones bancarias especializadas',3),(245,'332.3 - Instituciones de crédito y préstamo',3),(246,'332.4 - Dinero',3),(247,'332.456 - Tasas de cambio',3),(248,'332.46 - Política monetaria ',3),(249,'332.6 - Inversión e inversiones',3),(250,'332.632 - Títulos valores. bienes raíces. bienes',3),(251,'332.634 - Bonos corporativos',3),(252,'332.642 - Intercambio de títulos valores y lonjas de valores',3),(253,'332.66 - Bancos de inversión',3),(254,'332.67 - Inversiones por campo de inversión, guías de inversión',3),(255,'332.7 - Crédito',3),(256,'332.9 - Falsificación, adulteración, alteración de dinero',3),(257,'333 - Economía de la tierra y de la energía',3),(258,'333.1 - Propiedad pública de la tierra',3),(259,'333.7 - Recursos naturales y energía',3),(260,'333.73 - Tierra',3),(261,'333.75 - Tierras forestales',3),(262,'333.78 - Áreas recreativas y silvestres',3),(263,'333.79 - Energía',3),(264,'333.8 - Recursos del subsuelo',3),(265,'333.85 - Minerales Recursos minerales',3),(266,'333.91 - Agua',3),(267,'333.92 - Aire',3),(268,'333.95 - Recursos biológicos',3),(269,'334 - Cooperativas',3),(270,'334.7 - Sociedades benéficas',3),(271,'335 - Socialismo y sistemas relacionados',3),(272,'335.1 - Sistemas de origen inglés',3),(273,'335.8 - Otros sistemas Sindicalismo',3),(274,'336 - Finanzas públicas',3),(275,'336.2 - Impuestos y tributación',3),(276,'336.31 - Títulos valores públicos (gubernamentales)',3),(277,'336.34 - Deuda pública',3),(278,'336.39 - Gastos',3),(279,'338 - Producción',3),(280,'338.1 - Agricultura',3),(281,'338.4 - Industrias y servicios secundarios',3),(282,'338.5 - Economía de la producción general',3),(283,'338.6 - Organización de la producción',3),(284,'338.7 - Empresas de negocios',3),(285,'338.8 - Combinaciones de empresas',3),(286,'338.9 - Desarrollo y crecimiento económicos',3),(287,'339 - Macroeconomía y temas relacionados',3),(288,'339.5 - Política macroeconómica',3),(289,'339.52 - Uso de política fiscal',3),(290,'340 - Derecho',3),(291,'340.03 - Diccionarios jurídicos',3),(292,'340.1 - Filosofía y teoría del Derecho',3),(293,'340.5 - Sistemas legales',3),(294,'340.56 - Sistemas de derecho civil',3),(295,'340.9 - Conflicto de leyes. Derecho internacional privado',3),(296,'341 - Derecho internacional',3),(297,'341.2 - La comunidad mundial',3),(298,'341.23 - Naciones Unidas',3),(299,'341.24 - Asociaciones y organizaciones regionales',3),(300,'341.3 - Relaciones entre Estados',3),(301,'341.4 - Jurisdicción y relaciones jurisdiccionales de los estados',3),(302,'341.5 - Disputas y conflictos entre estados',3),(303,'341.6 - Derecho de guerra',3),(304,'341.7 - Cooperación internacional',3),(305,'341.75 - Derecho económico internacional',3),(306,'341.76 - Derecho social y relaciones culturales',3),(307,'341.77 - Derecho penal internacional',3),(308,'342 - Derecho constitucional y administrativo',3),(309,'342.02 - Instrumentos básicos del gobierno',3),(310,'342.06 - Rama ejecutiva del gobierno',3),(311,'342.066 - Derecho a la información',3),(312,'343 - Derecho militar. tributario. mercantil. industrial',3),(313,'343.04 - Legislación sobre finanzas públicas Derecho tributario',3),(314,'343.07 - Derecho industrial',3),(315,'343.077 - Derecho minero',3),(316,'343.093 - Derecho del transporte',3),(317,'343.096 - Derecho marítimo',3),(318,'343.3 - Criminales (Infractores)',3),(319,'344 - Derecho laboral. social. educativo. cultural',3),(320,'344.01 - Derecho laboral',3),(321,'345 - Derecho penal',3),(322,'345.05 - Pruebas',3),(323,'345.056 - Derechos de los sospechosos Juicios',3),(324,'346 - Derecho privado',3),(325,'346.013 - Derechos de la mujer',3),(326,'346.015 - Derecho de familia',3),(327,'346.02 - Contratos',3),(328,'346.029 - Mandatos',3),(329,'346.03 - Actos ilícitos',3),(330,'346.04 - Propiedad ',3),(331,'346.052 - Procedimiento y tribunales civiles',3),(332,'346.064 - Personas jurídicas Fundaciones',3),(333,'346.07 - Derecho comercial',3),(334,'346.092 - Títulos valores',3),(335,'347.014 - Jueces',3),(336,'347.016 - Notarios',3),(337,'347.05 - Procedimiento ',3),(338,'348 - Leyes (estatutos). reglamentaciones. jurisprudencia',3),(339,'348.02 - Leyes (Estatutos). reglamentaciones',3),(340,'348.023 - Códigos',3),(341,'348.024 - Leyes seleccionadas',3),(342,'348.046 - Digestos de jurisprudencia',3),(343,'350 - Administración pública y ciencia militar',3),(344,'350.1 - Personal de la administración pública',3),(345,'350.4 - Administración financiera y presupuestos',3),(346,'350.8 - Administración de formas generales de control',3),(347,'351 - Administración pública',3),(348,'351.9 - Administración pública en continentes. países. localidades específicas',3),(349,'352 - Consideraciones generales sobre administración pública',3),(350,'352.14 - Administración local',3),(351,'355 - Ciencia militar',3),(352,'355.1 - Vida y costumbres militares',3),(353,'355.3 - Organización y personal de las fuerzas militares',3),(354,'355.4 - Operaciones militares',3),(355,'355.5 - Adiestramiento militar',3),(356,'355.6 - Administración militar',3),(357,'355.8 - Equipos y abastecimientos militares Armamentos',3),(358,'356 - Fuerzas y combate de infantería',3),(359,'357 - Fuerzas y combate montados',3),(360,'358 - Fuerzas aéreas y otras fuerzas especializadas',3),(361,'358.4 - Fuerzas y combates aéreos',3),(362,'359 - Fuerzas y combate marítimos (navales)',3),(363,'360 - Problemas y servicios sociales, asociaciones',3),(364,'361 - Problemas y bienestar sociales en general',3),(365,'361.2 - Acción social',3),(366,'362 - Problemas y servicios de bienestar social',3),(367,'362.73 - Servicios institucionales y relacionados',3),(368,'363 - Otros problemas y servicios sociales',3),(369,'363.1 - Programas de seguridad pública',3),(370,'363.11 - Riesgos ocupacionales e industriales',3),(371,'363.12 - Riesgos en transporte',3),(372,'363.2 - Servicios de policía',3),(373,'363.23 - Prevención del delito por la policía',3),(374,'363.3 - Otros aspectos de seguridad pública',3),(375,'363.34 - Desastres',3),(376,'363.37 - Riesgos de incendio',3),(377,'363.7 - Problemas medioambientales',3),(378,'363.829 - Maltrato familiar',3),(379,'364 - Criminología',3),(380,'364.1 - Delitos criminales',3),(381,'364.2 - Causas del crimen y de la delincuencia Antropología criminal',3),(382,'364.3 - Infractores',3),(383,'365 - Instituciones penales y relacionadas',3),(384,'365.6 - Reclusos',3),(385,'366 - Asociaciones',3),(386,'366.1 - Francmasonería',3),(387,'366.19 - Riesgos de productos',3),(388,'368 - Seguros ',3),(389,'369 - Clases varias de asociaciones',3),(390,'370 - Educación',3),(391,'370.1 - Filosofía y teoría. educación para objetivos específicos',3),(392,'370.15 - Psicología educativa',3),(393,'370.19 - Sociología de la educación',3),(394,'370.7 - Estudio y enseñanza de la educación',3),(395,'371 - Escuelas y actividades, educación especial',3),(396,'371.07 - Escuelas religiosas',3),(397,'371.2 - Administración escolar, administración de actividades académicas',3),(398,'371.26 - Exámenes y pruebas, ubicación académica',3),(399,'371.3 - Métodos de instrucción y estudio',3),(400,'371.32 - Uso de libros de texto',3),(401,'371.39 - Otros medios de instrucción',3),(402,'371.4 - Guía y orientación estudiantiles',3),(403,'371.5 - Disciplina escolar y actividades relacionadas',3),(404,'371.6 - Planta física, manejo de materiales en la educación',3),(405,'371.7 - Bienestar estudiantil',3),(406,'371.8 - Estudiantes',3),(407,'371.822 - Educación de la mujer',3),(408,'371.9 - Educación especial',3),(409,'372 - Educación primaria',3),(410,'372.2 - Educación preescolar',3),(411,'372.35 - Ciencia y tecnología en la escuela primaria Libros de texto',3),(412,'372.37 - Salud e higiene en la escuela primaria Libros de texto',3),(413,'372.4 - Lectura en la escuela primaria Libros de texto',3),(414,'372.41 - Materiales de instrucción para la lectura',3),(415,'372.412 - Libros de lectura',3),(416,'372.5 - Artes creativas y manuales en la escuela primaria Libros de texto',3),(417,'372.6 - Lenguas (Comunicación) en la escuela primaria Libros de texto',3),(418,'372.632 - Libros de ortografía para la escuela primaria Libros de texto',3),(419,'372.64 - Apreciación literaria en la escuela primaria Libros de texto',3),(420,'372.65 - Lenguas extranjeras en la escuela primaria Libros de texto',3),(421,'372.7 - Matemáticas en la escuela primaria Libros de texto',3),(422,'372.83 - Estudios sociales en la escuela primaria Libros de texto',3),(423,'372.832 - Cívica (Ciudadanía) en la escuela primaria Libros de texto',3),(424,'372.84 - Religión en la escuela primaria Libros de texto',3),(425,'372.86 - Educación física y danza en la escuela primaria Libros de texto',3),(426,'372.87 - Música en la escuela primaria Libros de texto',3),(427,'372.89 - Historia y geografía en la escuela primaria Libros de texto',3),(428,'372.9 - Tratamiento histórico. geográfico. de personas en la educación primaria Libros de texto',3),(429,'373 - Educación secundaria',3),(430,'374 - Educación de adultos',3),(431,'375 - Currículos',3),(432,'375.004 - Ciencia de los computadores en la enseñanza media Libros de texto',3),(433,'375.653 - Taquigrafía en la enseñanza media Libros de texto',3),(434,'375.657 - Contabilidad en la enseñanza media Libros de texto',3),(435,'375.78 - Música en la enseñanza media Libros de texto',3),(436,'375.81 - Filosofía en la enseñanza media Libros de texto',3),(437,'375.815 - Psicología en la enseñanza media Libros de texto',3),(438,'375.816 - Lógica en la enseñanza media Libros de texto',3),(439,'375.817 - Ética (Filosofía moral) en la enseñanza media Libros de texto',3),(440,'375.82 - Religión en la enseñanza media Libros de texto',3),(441,'375.83 - Ciencias sociales en la enseñanza media Libros de texto',3),(442,'375.831 - Estadística en la enseñanza media Libros de texto',3),(443,'375.833 - Economía en la enseñanza media Libros de texto',3),(444,'375.84 - Español en la enseñanza media Libros de texto',3),(445,'375.842 - Inglés en la enseñanza media Libros de texto',3),(446,'375.843 - Francés en la enseñanza media Libros de texto',3),(447,'375.845 - Italiano en la enseñanza media Libros de texto',3),(448,'375.85 - Ciencias naturales en la enseñanza media Libros de texto',3),(449,'375.851 - Matemáticas en la enseñanza media Libros de texto',3),(450,'375.853 - Física en la enseñanza media Libros de texto',3),(451,'375.854 - Química en la enseñanza media Libros de texto',3),(452,'375.857 - Ciencias de la vida Biología Libros de texto',3),(453,'375.858 - Plantas en la enseñanza media Libros de texto',3),(454,'375.860 - Literatura española en la enseñanza media Libros de texto',3),(455,'375.865 - Gerencia en la enseñanza media Libros de texto',3),(456,'375.87 - Tecnología (Ciencias aplicadas) en la enseñanza media Libros de texto',3),(457,'375.873 - Latín. libros de texto para la enseñanza media',3),(458,'375.879 - Educación física en la enseñanza media Libros te texto',3),(459,'375.891 - Geografía en la enseñanza media Libros de texto',3),(460,'375.894 - Historia en la enseñanza media Libros de texto',3),(461,'376 - Derecho en la enseñanza media Libros de texto',3),(462,'378 - Educación superior',3),(463,'378.2 - Grados académicos y temas relacionados',3),(464,'378.3 - Ayuda estudiantil y temas relacionados Becas',3),(465,'379 - Asuntos de política pública en educación',3),(466,'379.2 - Asuntos específicos de política en educación pública',3),(467,'380 - Comercio. comunicaciones. transporte',3),(468,'380.1 - Comercio',3),(469,'381 - Comercio interno',3),(470,'382 - Comercio internacional (Comercio exterior)',3),(471,'382.5 - Comercio de importación ',3),(472,'382.6 - Comercio de exportación',3),(473,'382.7 - Política arancelaria',3),(474,'382.9 - Acuerdos comerciales',3),(475,'383 - Comunicación postal',3),(476,'384 - Comunicaciones Telecomunicación',3),(477,'384.54 - Radiodifusión',3),(478,'384.55 - Televisión',3),(479,'384.6 - Telefonía',3),(480,'385 - Transporte ferroviario',3),(481,'386 - Transporte por vía acuática interior y en trasbordador',3),(482,'386.42 - Canales interoceánicos',3),(483,'387 - Transporte acuático. aéreo. espacial',3),(484,'387.1 - Puertos',3),(485,'387.7 - Transporte aéreo ',3),(486,'388 - Transporte Transporte terrestre',3),(487,'388.4 - Transporte local',3),(488,'388.42 - Sistemas de tránsito ferroviario local Metro',3),(489,'389 - Metrología y estandarización',3),(490,'390 - Costumbres. etiqueta. folclor',3),(491,'391 - Traje y apariencia personal',3),(492,'391.6 - Apariencia personal',3),(493,'392 - Costumbres del ciclo de vida y de la vida doméstica',3),(494,'392.3 - Costumbres relacionadas con las moradas y las ares domésticas',3),(495,'392.5 - Costumbres de boda y matrimonio',3),(496,'392.6 - Costumbres de las relaciones entre los sexos',3),(497,'392.9 - Costumbres relacionadas con el tratamiento de personas adultas',3),(498,'393 - Costumbres mortuorias',3),(499,'394.1 - Costumbres de comer. beber, uso de drogas',3),(500,'394.3 - Costumbres recreativas Juguetes',3),(501,'394.4 - Ceremonias y observancias oficiales',3),(502,'394.6 - Ferias',3),(503,'395 - Etiqueta (Modales)',3),(504,'398 - Folclor',3),(505,'398.03 - Diccionarios de folclor',3),(506,'398.2 - Literatura folclórica',3),(507,'398.3 - Fenómenos naturales y físicos como temas de folclor',3),(508,'398.35 - Humanidad y existencia humana en el folclor',3),(509,'398.353 - Cuerpo humano en el folclor',3),(510,'398.355 - Asuntos sociales en el folclor',3),(511,'398.4 - Fenómenos paranaturales y legendarios como temas del folclor',3),(512,'398.41 - Creencias populares',3),(513,'398.45 - Seres paranormales de forma humana y semihumana',3),(514,'401 - Filosofía y teoría de las lenguas',4),(515,'401.9 - Principios psicológicos de las lenguas',4),(516,'403 - Diccionarios y enciclopedias de lenguas',4),(517,'407 - Educación. investigación estudios relacionados con las lenguas',4),(518,'409 - Tratamiento geográfico y de personas en las lenguas',4),(519,'410 - Lingüística',4),(520,'411 - Sistemas de escritura',4),(521,'412 - Etimología',4),(522,'413 - Diccionarios de lingüística',4),(523,'414 - Fonología y fonética',4),(524,'415 - Gramática',4),(525,'417 - Dialectología y lingüística histórica',4),(526,'417.7 - Lingüística histórica',4),(527,'418 - Uso estándar Lingüística aplicada',4),(528,'418.4 - Lectura',4),(529,'419 - Lenguaje no verbal no hablado ni escrito',4),(530,'420 - Inglés e inglés antiguo',4),(531,'421 - Sistema de escritura y fonología ingleses',4),(532,'422 - Etimología inglesa',4),(533,'423 - Diccionarios de inglés',4),(534,'425 - Gramática del inglés estándar',4),(535,'427 - Variaciones de la lengua inglesa',4),(536,'428 - Uso del inglés estándar',4),(537,'430 - Lenguas germánicas Alemán',4),(538,'438 - Uso del alemán estándar',4),(539,'440 - Lenguas romances Francés',4),(540,'441 - Sistema de escritura y fonología franceses',4),(541,'443 - Diccionarios de francés',4),(542,'445 - Gramática francesa',4),(543,'448 - Uso del francés estándar',4),(544,'450 - Italiano. rumano. retorromano',4),(545,'451 - Sistema de escritura y fonología italianos',4),(546,'458 - Uso del italiano estándar',4),(547,'460 - Lenguas española y portuguesa',4),(548,'461 - Sistema de escritura y fonología españoles',4),(549,'462 - Etimología española',4),(550,'463 - Diccionarios de español',4),(551,'465 - Gramática española',4),(552,'467 - Variaciones de la lengua española',4),(553,'467.972 - Español de México, Honduras',4),(554,'467.982 - Español de la Argentina',4),(555,'467.985 - Español de Perú',4),(556,'467.987 - Español de Venezuela',4),(557,'467.989 - Español del Uruguay',4),(558,'468 - Uso del español estándar',4),(559,'469 - Portugués',4),(560,'470 - Lenguas itálicas Latín',4),(561,'471 - Escritura y fonología latinas clásicas',4),(562,'473 - Diccionarios de latín clásico',4),(563,'475 - Gramática latina clásica',4),(564,'478 - Uso del latín clásico',4),(565,'480 - Lenguas helénicas Griego clásico',4),(566,'481 - Escritura y fonología griegas clásicas',4),(567,'482 - Etimología griega clásica',4),(568,'485 - Gramática griega clásica',4),(569,'490 - Otras lenguas',4),(570,'495.1 - Chino',4),(571,'495.4 - Lenguas tibetobirmanas',4),(572,'495.6 - Japonés',4),(573,'497 - Lenguas nativas norteamericanas',4),(574,'498 - Lenguas nativas sudamericanas',4),(575,'500.5 - Ciencias espaciales',5),(576,'500.9 - Historia natural',5),(577,'501 - Filosofía y teoría de la ciencia',5),(578,'503 - Diccionarios y enciclopedias de la ciencias naturales',5),(579,'507 - Educación. investigación. temas relacionados con las ciencias naturales',5),(580,'509 - Tratamiento histórico. geográfico. de personas en las ciencias naturales',5),(581,'510 - Matemáticas',5),(582,'510.1 - Filosofía y teoría de las matemáticas',5),(583,'511 - Principios generales de las matemáticas',5),(584,'511.6 - Análisis combinatorio',5),(585,'511.8 - Modelos matemáticos y simulación',5),(586,'512 - Algebra. teoría de los números',5),(587,'513 - Aritmética',5),(588,'514 - Topología',5),(589,'515 - Análisis',5),(590,'515.3 - Cálculo y ecuaciones diferenciales',5),(591,'515.4 - Cálculo y ecuaciones integrales',5),(592,'515.7 - Análisis funcional ',5),(593,'515.8 - Funciones de variables complejas',5),(594,'516 - Geometría',5),(595,'516.2 - Geometría euclidiana',5),(596,'516.3 - Geometría analítica',5),(597,'516.6 - Geometría descriptiva abstracta',5),(598,'519 - Probabilidades y matemáticas aplicadas',5),(599,'519.5 - Matemáticas estadísticas ',5),(600,'519.7 - Programación',5),(601,'520 - Astronomía y ciencias afines',5),(602,'521 - Mecánica celeste',5),(603,'522 - Técnicas. equipo materiales de astronomía',5),(604,'523 - Cuerpos y fenómenos celestes específicos',5),(605,'523.1 - El universo. galaxias. quásares',5),(606,'523.2 - Sistema Solar',5),(607,'523.7 - Sol',5),(608,'525 - La tierra (Geografía astronómica)',5),(609,'526 - Geografía matemática ',5),(610,'526.8 - Dibujo de mapas',5),(611,'526.9 - Topografía ',5),(612,'527 - Navegación celeste',5),(613,'528 - Efemérides',5),(614,'529 - Cronología',5),(615,'530 - Física',5),(616,'530.1 - Teoría y física matemática',5),(617,'530.15 - Física matemática',5),(618,'530.4 - Estados de la materia',5),(619,'530.7 - Instrumentación',5),(620,'530.8 - Medición',5),(621,'531 - Mecánica',5),(622,'531.11 - Dinámica',5),(623,'531.112 - Cinemática ',5),(624,'531.12 - Estática',5),(625,'531.14 - Masa y gravedad',5),(626,'531.16 - Mecánica de partículas',5),(627,'531.3 - Dinámica de sólidos',5),(628,'531.6 - Energía',5),(629,'532 - Mecánica de fluidos Mecánica de líquidos',5),(630,'533.6 - Aeromecánica',5),(631,'534 - Sonido y vibraciones relacionadas',5),(632,'535 - Luz y fenómenos parafóticos',5),(633,'535.2 - Óptica física ',5),(634,'535.6 - Color',5),(635,'536 - Calor',5),(636,'536.7 - Termodinámica ',5),(637,'537 - Electricidad y electrónica',5),(638,'538 - Magnetismo',5),(639,'539 - Física moderna',5),(640,'539.75 - Física atómica y nuclear',5),(641,'540 - Química y ciencias afines',5),(642,'540.1 - Filosofía y teoría de la química',5),(643,'540.7 - Educación. investigación. temas relacionados con la química',5),(644,'541 - Química física y teórica',5),(645,'541.37 - Electroquímica y Magnetoquímica',5),(646,'541.38 - Radioquímica',5),(647,'542 - Técnicas. equipo. materiales de la química',5),(648,'543 - Química analítica',5),(649,'545 - Análisis cuantitativo',5),(650,'546 - Química inorgánica',5),(651,'546.2 - Hidrógeno y sus compuestos',5),(652,'546.8 - Tabla periódica',5),(653,'547 - Química orgánica',5),(654,'547.3 - Química analítica',5),(655,'547.7 - Lípidos',5),(656,'547.71 - Terpenos y aceites esenciales',5),(657,'547.73 - Micromoléculas y compuestos relacionados ',5),(658,'547.75 - Enzimas',5),(659,'547.781 - Azúcares',5),(660,'547.83 - Petróleo',5),(661,'547.84 - Polímeros de alto grado',5),(662,'547.843 - Polímeros flexibles',5),(663,'549 - Mineralogía',5),(664,'549.23 - Metales',5),(665,'550 - Ciencias de la tierra',5),(666,'551 - Geología. hidrología. meteorología',5),(667,'551.21 - Volcanes',5),(668,'551.22 - Temblores de tierra',5),(669,'551.23 - Aguas y gases termales',5),(670,'551.4 - Geomorfología e hidrosfera',5),(671,'551.46 - Oceanografía',5),(672,'551.48 - Aguas dulces',5),(673,'551.49 - Aguas subterráneas (aguas subsuperficiales)',5),(674,'551.5 - Meteorología ',5),(675,'551.523 - Interacciones tierra-atmósfera',5),(676,'551.552 - Huracanes',5),(677,'551.57 - Hidrometeorología ',5),(678,'551.6 - Climatología',5),(679,'551.7 - Geología histórica',5),(680,'551.8 - Geología estructural',5),(681,'551.9 - Geoquímica',5),(682,'552 - Petrología',5),(683,'553 - Geología económica',5),(684,'553.2 - Materiales carbonosos',5),(685,'553.8 - Gemas',5),(686,'557 - Ciencias de la tierra de América del Norte',5),(687,'558 - Ciencias de la tierra de América del Sur',5),(688,'560 - Paleontología Paleozoología',5),(689,'561 - Paleobotánica, microorganismos fósiles',5),(690,'561.7 - Pteridophyta (Pteridofitas) fósiles',5),(691,'569 - Mammalia (Mamíferos) fósiles',5),(692,'570 - Ciencias de la vida Biología',5),(693,'570.7 - Educación. investigación. temas relacionados con la biología',5),(694,'571 - Fisiología y temas relacionados',5),(695,'571.1 - Fisiología de Animales',5),(696,'571.3 - Anatomía y morfología',5),(697,'571.5 - Biología tisular y regional',5),(698,'571.6 - Biología celular',5),(699,'571.8 - Reproducción, desarrollo, maduración',5),(700,'571.81 - Reproducción. desarrollo. crecimiento de Animales',5),(701,'571.86 - Embriología',5),(702,'571.9 - Enfermedades Patología',5),(703,'572 - Bioquímica',5),(704,'575 - Partes específicas de y sistemas fisiológicos en plantas',5),(705,'576 - Genética y evolución',5),(706,'576.54 - Variación genética',5),(707,'576.8 - Evolución',5),(708,'576.83 - Origen de la vida',5),(709,'577 - Ecología',5),(710,'578.6 - Biología económica',5),(711,'579 - Microorganismos. hongos. algas',5),(712,'579.2 - Virus y organismos subvirales y organismos subvirales',5),(713,'579.24 - Virus y organismos subvirales ',5),(714,'579.3 - Procariotas (Bacterias)',5),(715,'579.5 - Hongos',5),(716,'579.8 - Algas',5),(717,'580 - Plantas',5),(718,'580.74 - Museos. colecciones. exposiciones de plantas',5),(719,'581 - Temas específicos en historia natural',5),(720,'581.07 - Educación. enseñanza. temas relacionados con las plantas',5),(721,'581.6 - Botánica económica',5),(722,'581.7 - Plantas de medioambientes específicos. ecología vegetal',5),(723,'581.9 - Tratamiento de plantas por continentes. países. localidades específicos',5),(724,'582 - Plantas destacadas por características y flores',5),(725,'582.16 - Árboles',5),(726,'583 - Magnoliosida (Dicotiledóneas)',5),(727,'584 - Liliopsida (Monocotiledóneas)',5),(728,'590 - Animales',5),(729,'590.7 - Educación. investigación. temas relacionados con los Animales',5),(730,'590.74 - Museos. colecciones. exposiciones de Animales',5),(731,'591.3 - Genética, evolución, cría de animales',5),(732,'591.5 - Comportamiento animal',5),(733,'591.6 - Zoología económica',5),(734,'591.7 - Animales de medioambientes específicos. ecología animal',5),(735,'592 - Invertebrados',5),(736,'593 - Invertebrados marinos y del litoral',5),(737,'594 - Mollusca (Moluscos) y Molluscoidea (Moluscoideos)',5),(738,'595 - Arthropoda (Artrópodos)',5),(739,'595.7 - Insecta (Insectos)',5),(740,'596 - Chordata (Cordados)',5),(741,'597 - Vertebrados de sangre fría Pisces (Peces)',5),(742,'597.8 - Amphibia (Anfibios)',5),(743,'598 - Aves (Pájaros)',5),(744,'599 - Mammalia (Mamíferos)',5),(745,'599.9 - Antropología física',5),(746,'599.93 - Hombre prehistórico',5),(747,'599.94 - Antropometría',5),(748,'599.97 - Razas humanas',5),(749,'601 - Filosofía y teoría de la tecnología',6),(750,'603 - Diccionarios y enciclopedias de tecnología',6),(751,'604 - Temas especiales de tecnología',6),(752,'607 - Educación. investigación. temas relacionados con la tecnología',6),(753,'608 - Invenciones y patentes',6),(754,'609 - Tratamiento histórico. geográfico. de personas en la tecnología',6),(755,'610 - Ciencias médicas Medicina',6),(756,'610.28 - Técnicas y procedimientos auxiliares, aparatos. equipo. materiales',6),(757,'610.69 - Personal médico',6),(758,'610.7 - Educación. investigación. enfermería. temas relacionados',6),(759,'610.736 - Enfermería especializada',6),(760,'611 - Anatomía humana. citología. histología',6),(761,'612 - Fisiología humana',6),(762,'612.04 - Fisiología de actividades específicas',6),(763,'612.1 - Sangre y circulación',6),(764,'612.2 - Respiración',6),(765,'612.3 - Digestión',6),(766,'612.4 - Secreción. excreción. funciones relacionadas',6),(767,'612.6 - Reproducción. desarrollo. maduración',6),(768,'612.7 - Sistema musculoesquelético',6),(769,'612.8 - Funciones nerviosas Funciones sensoriales',6),(770,'613 - Promoción de la salud',6),(771,'613.1 - Factores medioambientales en la higiene',6),(772,'613.2 - Dietética',6),(773,'613.28 - Elementos nutritivos específicos',6),(774,'613.4 - Aseo personal y temas relacionados',6),(775,'613.62 - Salud industrial y ocupacional',6),(776,'613.7 - Yoga',6),(777,'613.71 - Ejercicio y actividades deportivas',6),(778,'613.8 - Abuso de sustancias (Abuso de drogas)',6),(779,'613.9 - Control de la natalidad. tecnología de la reproducción. higiene sexual',6),(780,'613.96 - Manuales de técnica sexual',6),(781,'614 - Medicina forense. incidencia de enfermedades. medicina preventiva',6),(782,'614.1 - Medicina forense (Jurisprudencia médica)',6),(783,'614.4 - Incidencia y medidas públicas para prevenir enfermedades',6),(784,'614.43 - Portadores de enfermedades (Vectores) y su control',6),(785,'614.44 - Medicina preventiva pública',6),(786,'614.49 - Historia de las epidemias',6),(787,'614.51 - Enfermedades bacterianas',6),(788,'614.547 - Enfermedades de transmisión sexual',6),(789,'614.58 - Zoonosis',6),(790,'614.59 - Enfermedades de regiones. sistemas. órganos. otras enfermedades',6),(791,'615 - Farmacología y terapéutica',6),(792,'615.19 - Química farmacéutica',6),(793,'615.3 - Farmacognosia',6),(794,'615.4 - Farmacia práctica',6),(795,'615.5 - Terapéutica',6),(796,'615.532 - Homeopatía',6),(797,'615.533 - Osteopatía',6),(798,'615.534 - Quiropráctica',6),(799,'615.6 - Métodos de medicación',6),(800,'615.7 - Farmacodinamia',6),(801,'615.8 - Fisioterapia',6),(802,'615.834 - Climatoterapia',6),(803,'615.837 - Musicoterapia',6),(804,'615.84 - Radioterapia',6),(805,'615.851 - Psicoterapias',6),(806,'615.851 2 - Hipnoterapia',6),(807,'615.851.5 - Ergoterapia Ludoterapia',6),(808,'615.851.6 - Biblioterapia',6),(809,'615.852 - Hieroterapia Curación por la fe',6),(810,'615.853 - Hidroterapia',6),(811,'615.854 - Dietoterapia Vitaminoterapia',6),(812,'615.856 - Curanderismo',6),(813,'615.882 - Medicina popular',6),(814,'615.892 - Acupuntura',6),(815,'615.9 - Terapéutica toxicológica',6),(816,'615.904 - Toxicología industrial',6),(817,'615.908 - Intoxicaciones',6),(818,'615.909 - Envenenamientos',6),(819,'616 - Enfermedades',6),(820,'616.025 - Urgencias médicas',6),(821,'616.042 - Enfermedades genéticas (hereditarias)',6),(822,'616.043 - Enfermedades congénitas',6),(823,'616.047 - Manifestaciones de enfermedad',6),(824,'616.07 - Patología',6),(825,'616.075 - Diagnóstico y pronóstico',6),(826,'616.079 - Inmunidad',6),(827,'616.08 - Medicina psicosomática',6),(828,'616.09 - Historias de casos',6),(829,'616.1 - Enfermedades del sistema cardiovascular',6),(830,'616.2 - Enfermedades del sistema respiratorio',6),(831,'616.3 - Enfermedades del sistema digestivo',6),(832,'616.4 - Enfermedades de los sistemas hematopoyéticos. glandular. endocrino',6),(833,'616.5 - Enfermedades del tegumento. cabello. uñas',6),(834,'616.54 - Enfermedades varias Fiebre amarilla',6),(835,'616.541 - Fiebre amarilla',6),(836,'616.6 - Enfermedades del sistema urogenital. urinario',6),(837,'616.7 - Enfermedades del sistema musculoesquelético',6),(838,'616.8 - Enfermedades del sistema nervioso y trastornos mentales',6),(839,'616.855 - Trastornos del habla y del lenguaje',6),(840,'616.858 - Trastornos de la personalidad. del intelecto. del control del impulso',6),(841,'616.86 - Abuso de sustancias (Abuso de drogas)',6),(842,'616.87 - Enfermedades de los nervios craneales. espinales. periféricos',6),(843,'616.89 - Psicología patológica y clínica',6),(844,'616.891 - Trastornos mentales',6),(845,'616.895 - Psicosis maníacodepresiva (Trastornos bipolares)',6),(846,'616.897 - Paranoia',6),(847,'616.898 - Esquizofrenia. autismo. demencia senil',6),(848,'616.91 - Enfermedades eruptivas (Exantemas)',6),(849,'616.92 - Enfermedades bacterianas y virales',6),(850,'616.95 - Enfermedades transmitidas sexualmente. zoonosis',6),(851,'616.953 - Rabia (Hidrofobia)',6),(852,'616.96 - Enfermedades parasitarias',6),(853,'616.969 - Enfermedades causadas por hongos',6),(854,'616.97 - Enfermedades del sistema inmune',6),(855,'616.98 - Enfermedades no transmisibles y medicina ambiental',6),(856,'616.991 - Fiebre reumática',6),(857,'616.992 - Tumores',6),(858,'616.995 - Tuberculosis',6),(859,'616.998 - Lepra (Enfermedad de Hansen)',6),(860,'616.999 - Enfermedades inmunodeficientes Sida',6),(861,'617 - Ramas varias de la medicina Cirugía',6),(862,'617.1 - Lesiones y heridas',6),(863,'617.3 - Ortopedia',6),(864,'617.4 - Cirugías por sistemas',6),(865,'617.5 - Medicina regional Cirugía regional',6),(866,'617.6 - Odontología',6),(867,'617.7 - Oftalmología',6),(868,'617.8 - Otología y audiología',6),(869,'617.9 - Cirugía operatoria y campos especiales de la cirugía',6),(870,'617.95 - Cirugía plástica cosmética y restaurativa',6),(871,'617.96 - Anestesiología',6),(872,'617.97 - Cirugía pediátrica',6),(873,'618 - Ginecología y otras especialidades médicas',6),(874,'618.92 - Pediatría',6),(875,'618.97 - Geriatría',6),(876,'619 - Medicina experimental',6),(877,'620 - Ingeniería y operaciones afines',6),(878,'620.1 - Mecánica y materiales de Ingeniería',6),(879,'620.11 - Materiales de Ingeniería',6),(880,'620.12 - Madera',6),(881,'620.13 - Materiales de mampostería',6),(882,'620.14 - Cerámica y materiales afines',6),(883,'620.8 - Factores humanos e Ingeniería de seguridad Ingeniería ambiental',6),(884,'620.82 - Factores humanos en Ingeniería Ergonomía',6),(885,'621 - Física aplicada ',6),(886,'621.1 - Ingeniería del vapor',6),(887,'621.2 - Tecnología de la potencia hidráulica',6),(888,'621.3 - Ingeniería eléctrica, electrónica',6),(889,'621.312 - Generación. modificación. almacenamiento de energía',6),(890,'621.313 - Maquinaria generadora y convertidores de energía',6),(891,'621.314 - Transformadores',6),(892,'621.319 - Transmisión Electrificación',6),(893,'621.32 - Iluminación',6),(894,'621.37 - Pruebas y mediciones de cantidades eléctricas',6),(895,'621.38 - Electrónica. Ingeniería de las comunicaciones',6),(896,'621.382 - Ingeniería de comunicaciones',6),(897,'621.384 - Radio y radar',6),(898,'621.386 - Equipo telefónico terminal',6),(899,'621.388 - Televisión ',6),(900,'621.39 - Ingeniería de computadores',6),(901,'621.392 - Análisis y diseño de sistemas',6),(902,'621.402 - Ingeniería térmica',6),(903,'621.43 - Motores de combustión interna',6),(904,'621.436 - Motores diesel y semidiesel',6),(905,'621.46 - Motores eléctricos y relacionados',6),(906,'621.47 - Ingeniería de la energía solar',6),(907,'621.48 - Ingeniería nuclear',6),(908,'621.5 - Tecnología neumática. del vacío. de bajas temperatura',6),(909,'621.56 - Tecnología de bajas temperaturas',6),(910,'621.7 - Ingeniería de máquinas',6),(911,'621.825 - uniones. embragues. juntas universales',6),(912,'621.86 - Equipo para manejo de materiales',6),(913,'621.87 - Grúas. cabrias. elevadores',6),(914,'621.89 - Tribología',6),(915,'621.9 - Herramientas',6),(916,'621.902 - Máquinas herramientas',6),(917,'621.97 - Equipos para asegurar y unir',6),(918,'622 - Minería y operaciones relacionadas',6),(919,'622.2 - Técnicas de excavación',6),(920,'622.4 - Medio ambiente minero',6),(921,'622.7 - Beneficio de las minas',6),(922,'623 - Ingeniería militar y náutica',6),(923,'623.262 - Minas terrestres',6),(924,'623.5 - Balística y artillería',6),(925,'623.74 - Vehículos militares',6),(926,'623.8 - Ingeniería y maniobras náuticas',6),(927,'623.88 - Manejo de tipos específicos de naves',6),(928,'623.89 - Navegación',6),(929,'624 - Ingeniería civil',6),(930,'624.1 - Ingeniería estructural y construcción subterránea',6),(931,'624.3 - Tipos específicos de puentes',6),(932,'625 - Ingeniería de ferrocarriles y de carreteras',6),(933,'625.7 - Carreteras',6),(934,'625.8 - Revestimientos artificiales de carreteras',6),(935,'627 - Ingeniería hidráulica',6),(936,'627.2 - Bahías. puertos. radas',6),(937,'627.3 - Instalaciones portuarias',6),(938,'627.4 - Control de inundaciones',6),(939,'627.5 - Recuperación. irrigación. temas relacionados',6),(940,'627.7 - Operaciones subacuáticas',6),(941,'627.8 - Presas y embalses',6),(942,'628 - Ingeniería sanitaria y municipal',6),(943,'628.3 - Tratamiento y eliminación de aguas negras',6),(944,'628.4 - Tecnología de desechos. sanitarios públicos. limpieza de calles',6),(945,'628.5 - Tecnología del control de la contaminación',6),(946,'628.7 - Ingeniería sanitaria para áreas rurales',6),(947,'628.92 - Tecnología de la seguridad contra incendios',6),(948,'628.95 - Iluminación pública',6),(949,'629 - Otras ramas de la Ingeniería',6),(950,'629.4 - Astronáutica',6),(951,'629.46 - Ingeniería de la nave espacial no tripulada',6),(952,'629.8 - Ingeniería del control automático',6),(953,'629.892 - Robots (Autómatas)',6),(954,'630 - Agricultura y tecnologías relacionadas',6),(955,'630.2 - Miscelánea y principios científicos de la agricultura',6),(956,'630.7 - Educación. investigación. temas relacionados con la agricultura',6),(957,'631 - Técnicas. equipo. materiales',6),(958,'631.2 - Estructuras agrícolas',6),(959,'631.3 - Herramientas. maquinaria. aparatos. equipo',6),(960,'631.34 - Equipo para el cuidado y resguardo de plantas',6),(961,'631.4 - Ciencia del suelo (Edafología)',6),(962,'631.45 - Erosión de suelos',6),(963,'631.51 - Trabajo del suelo (Labranza)',6),(964,'631.54 - Injertación. poda. adiestramiento',6),(965,'631.58 - Métodos especiales de cultivo',6),(966,'631.6 - Desmonte. drenaje. repoblación vegetal',6),(967,'631.7 - Conservación del agua',6),(968,'631.8 - Fertilizantes. acondicionadores del suelo. reguladores del crecimiento',6),(969,'632 - Lesiones. enfermedades. plagas vegetales',6),(970,'632.9 - Temas generales de control de plagas y de enfermedades',6),(971,'632.96 - Control biológico',6),(972,'633 - Cultivos de campo y de plantación',6),(973,'633.1 - Cereales',6),(974,'633.2 - Cultivos forrajeros',6),(975,'633.3 - Leguminosas',6),(976,'633.5 - Cultivos de fibra',6),(977,'633.6 - Cultivos para azúcar. jarabe. feculentos',6),(978,'633.7 - Cultivos alcaloideos',6),(979,'633.8 - Otros cultivos para procesamiento industrial',6),(980,'633.88 - Plantas medicinales',6),(981,'634 - Huertos. frutas. silvicultura',6),(982,'634.5 - Nueces',6),(983,'634.6 - Frutas tropicales y subtropicales',6),(984,'634.7 - Bayas y frutas herbáceas',6),(985,'634.8 - Uvas',6),(986,'634.9 - Silvicultura',6),(987,'634.972 - Dicotiledóneas',6),(988,'634.975 - Gimnospermas',6),(989,'634.98 - Explotación y productos forestales',6),(990,'635 - Cultivos hortícolas (Horticultura)',6),(991,'635.1 - Raíces',6),(992,'635.2 - Tubérculos y bulbos comestibles',6),(993,'635.3 - Hojas. flores. tallos comestibles',6),(994,'635.65 - Legumbres',6),(995,'635.67 - Maíz',6),(996,'635.7 - Hierbas aromáticas y dulces',6),(997,'635.8 - Champiñones y trufas',6),(998,'635.9 - Flores y plantas ornamentales',6),(999,'636 - Producción animal (Zootecnia)',6),(1000,'636.089 - Ciencias veterinarias Medicina veterinaria',6),(1001,'636.1 - Equinos Caballos',6),(1002,'636.2 - Rumiantes y Camilidae (Camélidos) Bóvidae (Bóvidos) Ganado',6),(1003,'636.296 - Llamas (Guanaco. Alpacas)',6),(1004,'636.3 - Rumiantes menores Ovejas',6),(1005,'636.39 - Cabras',6),(1006,'636.4 - Cerdos',6),(1007,'636.5 - Aves de corral Pollos',6),(1008,'636.592 - Pavos',6),(1009,'636.68 - Aves canoras y ornamentales',6),(1010,'636.7 - Perros',6),(1011,'636.8 - Gatos',6),(1012,'637 - Procesamiento lechero y productos relacionados',6),(1013,'637.1 - Procesamiento lechero ',6),(1014,'637.3 - Procesamiento de queso',6),(1015,'637.4 - Elaboración de postres helados',6),(1016,'638 - Cultivo de insectos',6),(1017,'638.1 - Cultivo de abejas (Apicultura)',6),(1018,'639 - Caza. pesca. conservación',6),(1019,'639.2 - Pesca comercial. captura de ballenas. captura de focas',6),(1020,'639.3 - Cultivo de vertebrados de sangre fría De peces',6),(1021,'639.4 - Pesquería y cultivo de moluscos',6),(1022,'639.9 - Conservación de recursos biológicos',6),(1023,'640 - Economía doméstica y vida familiar',6),(1024,'640.4 - Aspectos específicos del manejo de la casa',6),(1025,'640.7 - Educación. investigación. temas relacionados con el manejo de la casa',6),(1026,'640.73 - Guías de evaluación y compra',6),(1027,'641 - Alimentos y bebidas',6),(1028,'641.2 - Bebidas',6),(1029,'641.3 - Alimentos',6),(1030,'641.4 - Conservación y almacenamiento de alimentos',6),(1031,'641.562 - Cocina para personas de edades específicas',6),(1032,'641.563 - Cocina por razones de salud. apariencia. personales',6),(1033,'641.566 - cocina para restricciones y observancias de la iglesia cristiana',6),(1034,'641.572 - Cocina para hoteles y restaurantes',6),(1035,'641.578 - Cocina al aire libre',6),(1036,'641.58 - Cocina con combustibles. aparatos. utensilios específicos',6),(1037,'641.588 - Cocina lenta y sin fuego Microondas',6),(1038,'641.59 - Cocina característica de medioambientes geográficos específicos Étnica',6),(1039,'641.61 - Cocina de alimentos conservados',6),(1040,'641.7 - Procesos y técnicas específicos para cocinar',6),(1041,'641.84 - Emparedados (Sándwiches)',6),(1042,'641.85 - Conservas y bombones',6),(1043,'641.86 - Postres',6),(1044,'642 - Comidas y servicio a la mesa',6),(1045,'642.6 - Servicio a la mesa',6),(1046,'642.7 - Accesorios de mesa',6),(1047,'643 - Vivienda y equipo de la casa',6),(1048,'644 - Servicios de la casa',6),(1049,'645 - Dotaciones de la casa',6),(1050,'646 - Costura. vestuario. vida personal',6),(1051,'646.1 - Materiales y equipo de costura',6),(1052,'646.2 - Costura y operaciones relacionadas',6),(1053,'646.3 - Vestuario y accesorios',6),(1054,'646.4 - Confección del vestuario y de los accesorios',6),(1055,'646.6 - Cuidado del vestuario y de los accesorios',6),(1056,'646.7 - Manejo de la vida persona y familiar Acicalamiento',6),(1057,'646.724 - Cuidado del cabello',6),(1058,'646.726 - Cuidado de la cara. de la piel',6),(1059,'646.727 - Manicure y pedicure',6),(1060,'646.75 - Físico y forma',6),(1061,'647 - Gerencia de viviendas públicas',6),(1062,'648 - Cuidado de la casa',6),(1063,'649 - Crianza de niños y atención domiciliaria de personas',6),(1064,'650 - Gerencia y servicios auxiliares',6),(1065,'651 - Servicios de oficina',6),(1066,'651.3 - Manejo de la oficina',6),(1067,'651.5 - Manejo de registros Archivos',6),(1068,'651.7 - Comunicación Creación y transmisión de registros',6),(1069,'651.8 - Procesamiento de datos Aplicaciones del computador',6),(1070,'652 - Procesos de comunicación escrita',6),(1071,'653 - Taquigrafía ',6),(1072,'657 - Contabilidad',6),(1073,'657.45 - Auditoría',6),(1074,'658 - Gerencia general',6),(1075,'658.2 - Manejo de planta',6),(1076,'658.3 - Gerencia de personal (Gerencia de recursos humanos)',6),(1077,'658.32 - Administración de salarios y sueldos',6),(1078,'658.38 - Salud. seguridad. bienestar del empleado',6),(1079,'658.4 - Gerencia ejecutiva',6),(1080,'658.42 - Alta gerencia',6),(1081,'658.43 - Gerencia intermedia ',6),(1082,'658.45 - Comunicación',6),(1083,'658.47 - Inteligencia y seguridad en los negocios',6),(1084,'658.5 - Gerencia de producción',6),(1085,'658.7 - Manejo de materiales',6),(1086,'658.8 - Gerencia de distribución (Mercadeo)',6),(1087,'658.81 - Gerencia de ventas',6),(1088,'658.82 - Promoción de ventas',6),(1089,'658.83 - Investigación de mercados',6),(1090,'658.84 - Canales de mercadeo (Canales de distribución)',6),(1091,'658.85 - Venta personal (Arte de vender)',6),(1092,'658.87 - Mercadeo mediante canales de venta al por menor',6),(1093,'658.874 - Almacenes laterales (en concesión)',6),(1094,'658.878 - Supermercados ',6),(1095,'658.879 - Almacenes de descuentos',6),(1096,'658.88 - Manejo del crédito',6),(1097,'659 - Publicidad y relaciones públicas',6),(1098,'660 - Ingeniería Química',6),(1099,'660.2 - Temas generales en Ingeniería química',6),(1100,'660.6 - Biotecnología',6),(1101,'661 - Tecnología de químicos industriales',6),(1102,'662 - Explosivos. combustibles. productos relacionados',6),(1103,'663 - Tecnología de bebidas',6),(1104,'663.1 - Bebidas alcohólicas',6),(1105,'663.2 - Vino',6),(1106,'663.3 - Bebidas fermentadas y malteadas',6),(1107,'663.5 - Licores destilados',6),(1108,'663.6 - Bebidas no alcohólicas',6),(1109,'663.9 - Bebidas fermentadas no alcohólicas Tisanas',6),(1110,'664 - Tecnología de alimentos',6),(1111,'664.1 - Azúcares. jarabes. sus productos derivados',6),(1112,'664.3 - Grasas y aceites',6),(1113,'664.5 - Ingredientes para sazonar',6),(1114,'664.62 - Alimentos para bebés',6),(1115,'664.63 - Alimentos de bajas calorías',6),(1116,'664.65 - Preparaciones',6),(1117,'664.66 - Alimentos para animales',6),(1118,'664.7 - Granos. otras semillas. sus productos derivados',6),(1119,'664.752 - Productos de panadería',6),(1120,'664.8 - Frutas y vegetales',6),(1121,'664.9 - Carnes y alimentos afines',6),(1122,'665 - Aceites. grasas. ceras. grasas industriales',6),(1123,'665.3 - Grasas y aceites vegetales',6),(1124,'665.4 - Aceites y ceras minerales',6),(1125,'665.5 - Petróleo',6),(1126,'665.7 - Gas natural y gases manufacturados',6),(1127,'666 - Cerámica y tecnologías afines',6),(1128,'666.3 - Alfarería',6),(1129,'666.7 - Productos refractarios y de arcilla estructural',6),(1130,'667.2 - Tintes y pigmentos',6),(1131,'667.6 - Pinturas y pintura',6),(1132,'668 - Tecnología de otros productos orgánicos',6),(1133,'668.1 - Agentes activos de superficie Jabones',6),(1134,'668.3 - Adhesivos y productos relacionados',6),(1135,'668.4 - Plásticos',6),(1136,'668.5 - Perfumes y cosméticos',6),(1137,'668.6 - Químicos agrícolas',6),(1138,'668.65 - Plaguicidas',6),(1139,'669 - Metalurgia',6),(1140,'669.9 - Metalurgia física y química',6),(1141,'670 - Manufactura',6),(1142,'671 - Metalistería y productos metálicos',6),(1143,'671.2 - Fundición (Vaciado)',6),(1144,'671.3 - Trabajo mecánico y procesos relacionados',6),(1145,'671.5 - Unión y corte de metales',6),(1146,'671.732 - Galvanizado',6),(1147,'672 - Hierro. acero otras aleaciones ferrosas',6),(1148,'674 - Procesamiento de madera aserrada. productos de madera. corcho',6),(1149,'674.84 - Desechos y residuos de madera',6),(1150,'675 - Procesamiento del cuero y de la piel',6),(1151,'675.23 - Curtido del cuero y de la piel',6),(1152,'676 - Tecnología de la pulpa y del papel',6),(1153,'676.2 - Conversión de pulpa en papel. productos de papel',6),(1154,'676.282 - Papel para artes gráficas',6),(1155,'677 - Textiles',6),(1156,'677.4 - Textiles de fibras sintéticas',6),(1157,'677.64 - Tapices. tapetes. alfombras',6),(1158,'678.32 - Llantas',6),(1159,'678.5 - Látexes',6),(1160,'680 - Manufactura para usos específicos',6),(1161,'681 - Instrumentos de precisión y otros dispositivos',6),(1162,'681.8 - Instrumentos musicales',6),(1163,'682 - Trabajo de forja pequeña (Herrería)',6),(1164,'683 - Ferretería y aparatos de la casa',6),(1165,'683.4 - Armas de fuego pequeñas',6),(1166,'684 - Muebles y talleres de hogar',6),(1167,'685 - Artículos de cuero. de piel. productos relacionados',6),(1168,'685.3 - Calzado y productos relacionados',6),(1169,'686 - Imprenta y actividades relacionadas',6),(1170,'686.209 - Tratamiento histórico. geográfico. de personas en la imprenta',6),(1171,'686.22 - Tipografía',6),(1172,'686.23 - Trabajo de impresión (Impresión)',6),(1173,'687 - Vestuario y accesorios',6),(1174,'688 - Otros productos acabados y empaques',6),(1175,'690 - Construcción',6),(1176,'690.1 - Elementos estructurales',6),(1177,'690.2 - Actividades generales en la construcción',6),(1178,'690.24 - Mantenimiento y reparación',6),(1179,'691 - Materiales de construcción',6),(1180,'696 - Servicios públicos',6),(1181,'697 - Calefacción. ventilación. aire acondicionado',6),(1182,'698 - Acabado detallado',6),(1183,'701 - Filosofía de las bellas artes y artes decorativas',7),(1184,'701.18 - Crítica y apreciación',7),(1185,'703 - Diccionarios de las bellas artes y artes decorativas',7),(1186,'707 - Educación. investigación. temas relacionados con las Artes',7),(1187,'708 - Galerías. museos. colecciones privadas',7),(1188,'709 - Tratamiento histórico. geográfico. de personas en las Artes',7),(1189,'709.01 - Desde el período más antiguo hasta 499',7),(1190,'709.02 - Siglos VI-XV',7),(1191,'709.03 - Período moderno',7),(1192,'709.44 - Historia del arte francés',7),(1193,'709.45 - Historia del arte italiano',7),(1194,'709.46 - Historia del arte español',7),(1195,'709.7 - Historia del arte de América del Norte',7),(1196,'709.72 - Historia del arte mexicano',7),(1197,'709.728.1 - Historia del arte guatemalteco',7),(1198,'709.728.3 - Historia del arte hondureño',7),(1199,'709.728.6 - Historia del arte costarricense',7),(1200,'709.8 - Historia del arte de América del Sur',7),(1201,'709.82 - Historia del arte argentino',7),(1202,'709.83 - Historia del arte chileno',7),(1203,'709.85 - Historia del arte peruano',7),(1204,'709.861 - Historia del arte colombiano',7),(1205,'709.866 - Historia del arte ecuatoriano',7),(1206,'709.87 - Historia del arte venezolano',7),(1207,'710 - Urbanismo y arte paisajístico',7),(1208,'711 - Planificación del espacio (Urbanismo)',7),(1209,'711.2 - Planificación internacional y nacional',7),(1210,'711.5 - Clases específicas de áreas',7),(1211,'712 - Arquitectura paisajística',7),(1212,'718 - Diseño paisajístico de cementerios',7),(1213,'719 - Paisajes naturales',7),(1214,'720 - Arquitectura',7),(1215,'720.1 - Filosofía y teoría de la arquitectura',7),(1216,'720.7 - Arquitectura de 1900-1999',7),(1217,'720.9 - Tratamiento histórico. geográfico. de personas en la arquitectura',7),(1218,'721 - Estructura arquitectónica',7),(1219,'722 - Arquitectura hasta a.C. 300',7),(1220,'724 - Arquitectura desde 1400',7),(1221,'725 - Estructuras públicas',7),(1222,'726 - Edificios para propósitos religiosos',7),(1223,'727 - Edificios para educación e investigación',7),(1224,'727.6 - Edificios de museos',7),(1225,'727.8 - Edificios de bibliotecas',7),(1226,'728 - Edificios residenciales y relacionados',7),(1227,'729 - Diseño y decoración',7),(1228,'730 - Artes plásticas Escultura',7),(1229,'730.1 - Filosofía y teoría de la escultura',7),(1230,'730.9 - Tratamiento histórico. geográfico de personas en la escultura',7),(1231,'730.92 - Tratamiento histórico, geográfico, de personas de la escultura',7),(1232,'731 - Procesos. formas. temas de la escultura',7),(1233,'735 - Escultura desde 1400',7),(1234,'735.23 - Escultura 1900-1999',7),(1235,'736 - Talla y tallados',7),(1236,'736.98 - Corte y plegado de papel',7),(1237,'737 - Numismática y sigilografía',7),(1238,'738 - Artes cerámicas',7),(1239,'739 - Metalistería artística',7),(1240,'739.7 - Armas y armaduras',7),(1241,'740 - Dibujo y artes decorativas',7),(1242,'741 - Dibujo y dibujos',7),(1243,'741.01 - Filosofía y teoría del dibujo',7),(1244,'741.09 - Tratamiento histórico. geográfico. de personas en el dibujo',7),(1245,'741.2 - Técnicas. procedimientos. aparatos. equipo. materiales',7),(1246,'741.5 - Dibujos animados. caricaturas. tiras caminas',7),(1247,'741.6 - Diseño gráfico. ilustración. arte comercial',7),(1248,'745 - Artes decorativas',7),(1249,'745.5 - Artesanías',7),(1250,'745.6 - Caligrafía. diseño heráldico. iluminación',7),(1251,'745.7 - Coloreado decorativo',7),(1252,'745.9 - Otras artes decorativas',7),(1253,'747 - Decoración de interiores',7),(1254,'748 - Vidrio',7),(1255,'749 - Muebles y accesorios',7),(1256,'750 - Pintura y pinturas',7),(1257,'750.1 - Filosofía y teoría de la pintura',7),(1258,'751 - Técnicas. procedimientos. aparatos. equipos. materiales. formas',7),(1259,'751.6 - Restauración de pinturas Preservación de pinturas',7),(1260,'752 - Color',7),(1261,'753 - Simbolismo. alegoría. mitología. leyenda',7),(1262,'754 - Pinturas de género',7),(1263,'755 - Religión y pintura',7),(1264,'757 - Figuras humanas',7),(1265,'758 - Otros temas',7),(1266,'759 - Tratamiento histórico. geográfico. de personas en la pintura',7),(1267,'760 - Artes gráficas Arte de grabar y grabados',7),(1268,'760.9 - Tratamiento histórico. geográfico. de personas en el grabado',7),(1269,'761 - Procesos en relieve (impresión de planchas de madera)',7),(1270,'763 - Procesos litográficos (planográficos)',7),(1271,'764 - Cromolitografía y serigrafía',7),(1272,'769 - Grabados',7),(1273,'769.5 - Formas de grabados',7),(1274,'770 - Fotografía y fotografías',7),(1275,'770.1 - Filosofía y teoría de la fotografía',7),(1276,'770.9 - Tratamiento histórico. geográfico. de personas en la fotografía',7),(1277,'771 - Técnicas. equipo. materiales. formas',7),(1278,'778 - Campos y clases de fotografía',7),(1279,'778.5 - Cinematografía. producción de video. actividades relacionadas',7),(1280,'780 - Música',7),(1281,'780.1 - Filosofía y teoría de la música',7),(1282,'780.7 - Educación. investigación. presentaciones. temas relacionados',7),(1283,'780.9 - Tratamiento histórico. geográfico. de personas en la música',7),(1284,'780.903 - La música en 1450-',7),(1285,'780.904 - La música en 1900-1999',7),(1286,'781 - Principios generales y formas musicales',7),(1287,'781.3 - Composición musical',7),(1288,'781.5 - Clases de música',7),(1289,'781.6 - Tradiciones de la música',7),(1290,'781.7 - Música sacra',7),(1291,'782 - Música vocal',7),(1292,'782.1 - Formas vocales dramáticas Óperas',7),(1293,'784 - Instrumentos y su música',7),(1294,'785 - Conjuntos con un solo instrumento',7),(1295,'786 - Instrumentos de teclado y otros',7),(1296,'787 - Instrumentos de cuerda (Cordófonos)',7),(1297,'788 - Instrumentos de viento (Aérofonos)',7),(1298,'790 - Artes recreativas y de la actuación',7),(1299,'790.1 - Actividades recreativas',7),(1300,'790.192 - Actividades y programas por niveles de edad',7),(1301,'791 - Representaciones públicas',7),(1302,'791.44 - Radio',7),(1303,'791.5 - Arte del titiritero y teatros de juguetes',7),(1304,'791.8 - Representaciones de Animales',7),(1305,'792 - Presentaciones escénicas',7),(1306,'792.01 - Filosofía. teoría. estética del teatro',7),(1307,'792.02 - Técnicas. procedimientos. equipo. materiales. Miscelánea',7),(1308,'792.09 - Tratamiento histórico. geográfico. de personas en el teatro',7),(1309,'792.1 - Tragedia y teatro serio',7),(1310,'792.2 - Comedia y melodrama',7),(1311,'792.3 - Pantomima',7),(1312,'792.7 - Revistas de variedades y danza teatral',7),(1313,'792.8 - Ballet y danza moderna',7),(1314,'793 - Juegos y diversiones bajo techo',7),(1315,'793.2 - Fiestas y entretenimientos',7),(1316,'793.3 - Danzas sociales. folclóricas. nacionales',7),(1317,'793.5 - Juegos de prendas y trucos',7),(1318,'793.7 - Juegos no caracterizados por la acción',7),(1319,'793.8 - Magia y actividades relacionadas',7),(1320,'794 - Juegos de destreza bajo techo',7),(1321,'794.1 - Ajedrez',7),(1322,'795 - Juegos de suerte',7),(1323,'795.1 - Juegos de dados',7),(1324,'795.2 - Juegos de ruleta y de mesa',7),(1325,'795.3 - Juegos que dependen de sacar números o fichas',7),(1326,'795.4 - Juegos de cartas',7),(1327,'796 - Deportes y juegos atléticos y al aire libre',7),(1328,'796.3 - Juegos de pelota',7),(1329,'796.31 - Pelota lanzada o golpeada con la mano',7),(1330,'796.32 - Baloncesto',7),(1331,'796.334 - Fútbol',7),(1332,'796.34 - Juegos de raqueta',7),(1333,'796.352 - Golf',7),(1334,'796.353 - Polo',7),(1335,'796.355 - Jockey sobre césped',7),(1336,'796.357 - Béisbol',7),(1337,'796.4 - Levantamiento de pesas. pista y campo. gimnasia',7),(1338,'796.42 - Pista y campo',7),(1339,'796.48 - Juegos olímpicos',7),(1340,'796.5 - Vida al aire libre',7),(1341,'796.6 - Ciclismo y actividades relacionadas',7),(1342,'796.7 - Conducción de vehículos motorizados',7),(1343,'796.8 - Deportes de lucha',7),(1344,'796.86 - Esgrima',7),(1345,'796.9 - Deportes en hielo y nieve',7),(1346,'796.91 - Patinaje sobre hielo',7),(1347,'797 - Deportes acuáticos y aéreos',7),(1348,'798 - Deportes ecuestres y carreras de Animales',7),(1349,'798.2 - Equitación',7),(1350,'798.4 - Carreras de caballos Carreras sin obstáculos',7),(1351,'799 - Pesca. caza. tiro',7),(1352,'801 - Filosofía y teoría de la literatura',8),(1353,'801.92 - Psicología de la literatura',8),(1354,'801.93 - Estética de la literatura',8),(1355,'801.95 - Crítica de la literatura',8),(1356,'803 - Diccionarios y enciclopedias de literatura',8),(1357,'807 - Educación. investigación. temas relacionados con la literatura',8),(1358,'808 - Retórica y colecciones de literatura',8),(1359,'808.068 - Literatura infantil',8),(1360,'808.1 - Retórica de la poesía',8),(1361,'808.2 - Retórica del teatro',8),(1362,'808.3 - Retórica de la novelística',8),(1363,'808.4 - Retórica de los ensayos',8),(1364,'808.5 - Retórica del discurso',8),(1365,'808.543 - Narración de cuentos',8),(1366,'808.56 - Conversación',8),(1367,'808.6 - Retórica de las cartas',8),(1368,'808.7 - Retórica del humor y de la sátira',8),(1369,'808.8 - Colecciones de textos literarios de más de dos literaturas',8),(1370,'809 - Historia. descripción. evaluación crítica de más de dos literaturas',8),(1371,'820 - Literatura inglesa e inglesa antigua',8),(1372,'821 - Poesía inglesa',8),(1373,'822 - Teatro inglés',8),(1374,'823 - Novelística inglesa',8),(1375,'824 - Ensayos ingleses',8),(1376,'827 - Humor y sátira ingleses',8),(1377,'829 - Literatura inglesa antigua (anglosajona)',8),(1378,'830 - Literatura de las lenguas germánicas',8),(1379,'831 - Poesía alemana',8),(1380,'832 - Teatro alemán',8),(1381,'833 - Novelística alemana',8),(1382,'834 - Ensayos alemanes ',8),(1383,'836 - Cartas alemanas',8),(1384,'839 - Otras literaturas germánicas',8),(1385,'839.1 - Literatura yiddish',8),(1386,'839.31 - Literatura holandesa',8),(1387,'839.5 - Literaturas escandinavas (germánicas nórdicas)',8),(1388,'839.7 - Literatura sueca',8),(1389,'839.81 - Literatura danesa',8),(1390,'839.83 - Literatura noruega',8),(1391,'840 - Literatura de las lenguas romances',8),(1392,'841 - Poesía francesa',8),(1393,'842 - Teatro francés',8),(1394,'843 - Novelística francesa',8),(1395,'844 - Ensayos franceses',8),(1396,'845 - Discursos franceses',8),(1397,'846 - Cartas francesas',8),(1398,'847 - Humor y sátira franceses',8),(1399,'849 - Literaturas provenzal y catalana',8),(1400,'850 - Literatura italiana. rumana. retorromana',8),(1401,'851 - Poesía italiana',8),(1402,'852 - Teatro italiano',8),(1403,'853 - Novelística italiana',8),(1404,'854 - Ensayos italianos',8),(1405,'859 - Literatura rumana y retorromana',8),(1406,'860 - Literaturas española y portuguesa',8),(1407,'860.03 - Diccionarios de literatura española',8),(1408,'860.09 - Tratamiento histórico. geográfico. de personas en la literatura',8),(1409,'860A - Literatura argentina',8),(1410,'860B - Literatura boliviana',8),(1411,'860CH - Literatura chilena',8),(1412,'860CO - Literatura colombiana',8),(1413,'860CR - Literatura costarricense',8),(1414,'860CU - Literatura cubana',8),(1415,'860E - Literatura ecuatoriana',8),(1416,'860ES - Literatura salvadoreña',8),(1417,'860G - Literatura guatemalteca',8),(1418,'860HO - Literatura hondureña',8),(1419,'860M - Literatura mexicana',8),(1420,'860N - Literatura nicaragüense',8),(1421,'860P - Literatura panameña',8),(1422,'860PA - Literatura paraguaya',8),(1423,'860PE - Literatura peruana',8),(1424,'860RD - Literatura Dominicana',8),(1425,'860U - Literatura uruguaya',8),(1426,'860V - Literatura venezolana',8),(1427,'861 - Poesía española',8),(1428,'861A - Poesía argentina',8),(1429,'861B - Poesía boliviana',8),(1430,'861CH - Poesía chilena',8),(1431,'861CO - Poesía colombiana',8),(1432,'861CR - Poesía costarricense',8),(1433,'861CU - Poesía cubana',8),(1434,'861EC - Poesía ecuatoriana',8),(1435,'861G - Poesía guatemalteca',8),(1436,'861H - Poesía hondureña',8),(1437,'861M - Poesía mexicana',8),(1438,'861N - Poesía nicaragüense',8),(1439,'861P - Poesía panameña',8),(1440,'861PA - Poesía paraguaya',8),(1441,'861PE - Poesía peruana',8),(1442,'861PR - Poesía puertorriqueña',8),(1443,'861RD - Poesía Dominicana',8),(1444,'861U - Poesía uruguaya',8),(1445,'861V - Poesía venezolana',8),(1446,'862 - Teatro español',8),(1447,'862A - Teatro argentino',8),(1448,'862B - Teatro boliviano',8),(1449,'862CH - Teatro chileno',8),(1450,'862CO - Teatro colombiano',8),(1451,'862CR - Teatro costarricense',8),(1452,'862CU - Teatro cubano',8),(1453,'862EC - Teatro ecuatoriano',8),(1454,'862ES - Teatro salvadoreño',8),(1455,'862G - Teatro guatemalteco',8),(1456,'862H - Teatro hondureño',8),(1457,'862M - Teatro mexicano',8),(1458,'862N - Teatro nicaragüense',8),(1459,'862P - Teatro panameño',8),(1460,'862PA - Teatro paraguayo',8),(1461,'862PE - Teatro peruano',8),(1462,'862RD - Teatro dominicano',8),(1463,'862U - Teatro uruguayo',8),(1464,'863 - Novelística española',8),(1465,'863A - Novelística argentina',8),(1466,'863B - Novelística boliviana',8),(1467,'863CH - Novelística chilena',8),(1468,'863CO - Novelística colombiana',8),(1469,'863CR - Novelística costarricense',8),(1470,'863CU - Novelística cubana',8),(1471,'863EC - Novelística ecuatoriana',8),(1472,'863ES - Novelística salvadoreña',8),(1473,'863G - Novelística guatemalteca',8),(1474,'863HO - Novelística hondureña',8),(1475,'863M - Novelística mexicana',8),(1476,'863N - Novelística nicaragüense',8),(1477,'863P - Novelística panameña',8),(1478,'863PA - Novelística paraguaya',8),(1479,'863PE - Novelística peruana',8),(1480,'863PR - Novelística puertorriqueña',8),(1481,'863RD - Noveística dominicana',8),(1482,'863U - Novelística uruguaya',8),(1483,'863V - Novelística venezolana',8),(1484,'864 - Ensayos españoles',8),(1485,'864 RD - Ensayos dominicanos',8),(1486,'864A - Ensayos argentinos',8),(1487,'864B - Ensayos bolivianos',8),(1488,'864CH - Ensayos chilenos',8),(1489,'864CO - Ensayos colombianos',8),(1490,'864CR - Ensayos costarricenses',8),(1491,'864CU - Ensayos cubanos',8),(1492,'864EC - Ensayos ecuatorianos',8),(1493,'864ES - Ensayos salvadoreños',8),(1494,'864G - Ensayos guatemaltecos',8),(1495,'864HO - Ensayos hondureños',8),(1496,'864M - Ensayos mexicanos',8),(1497,'864N - Ensayos nicaragüenses',8),(1498,'864P - Ensayos panameños',8),(1499,'864PA - Ensayos paraguayos',8),(1500,'864PE - Ensayos peruanos',8),(1501,'864PR - Ensayos portorriqueños',8),(1502,'864U - Ensayos uruguayos',8),(1503,'864V - Ensayos venezolanos',8),(1504,'865 - Discursos españoles',8),(1505,'865A - Oratoria argentina',8),(1506,'865CH - Oratoria chilena',8),(1507,'865CU - Oratoria cubana',8),(1508,'865EC - Oratoria ecuatoriana',8),(1509,'865V - Oratoria venezolana',8),(1510,'866 - Cartas españolas',8),(1511,'866A - Cartas argentinas',8),(1512,'866CH - Cartas chilenas',8),(1513,'866CU - Cartas cubanas',8),(1514,'866EC - Cartas ecuatorianas',8),(1515,'866M - Cartas mexicanas',8),(1516,'867 - Humor y sátira españoles',8),(1517,'867A - Humor y sátira argentinos',8),(1518,'867CH - Humor y sátira chilenos',8),(1519,'867CO - Humor y sátira colombianos',8),(1520,'867CU - Humor y sátira cubanos',8),(1521,'867EC - Humor y sátira ecuatorianos',8),(1522,'867M - Humor y sátira mexicanos',8),(1523,'867U - Humor y sátira uruguayos',8),(1524,'869 - Literatura portuguesa',8),(1525,'869.1 - Poesía portuguesa',8),(1526,'869.1B - Poesía brasileña',8),(1527,'869.3 - Novelística portuguesa',8),(1528,'869.3B - Novelística brasileña',8),(1529,'869.4 - Ensayos portugueses',8),(1530,'869.4B - Ensayos brasileños ',8),(1531,'870 - Literaturas itálicas Literatura latina',8),(1532,'871 - Poesía latina',8),(1533,'873 - Poesía y novelística épicas latinas',8),(1534,'880 - Literaturas helénicas Literatura griega clásica',8),(1535,'881 - Poesía griega clásica',8),(1536,'882 - Poesía y teatro dramáticos griegos clásicos',8),(1537,'883 - Poesía y novelística épicas griegas clásicas',8),(1538,'885 - Discursos griegos clásicos',8),(1539,'886 - Cartas griegas clásicas',8),(1540,'889 - Literatura griega moderna',8),(1541,'890 - Literaturas de otras lenguas',8),(1542,'891 - Indoeuropeas. orientales y célticas',8),(1543,'891.1 - Literaturas indoiranias',8),(1544,'891.7 - Literaturas eslavas orientales Literatura rusa',8),(1545,'891.71 - Poesía rusa',8),(1546,'891.72 - Teatro ruso',8),(1547,'891.73 - Novelística rusa',8),(1548,'891.74 - Ensayos rusos',8),(1549,'891.8 - Literaturas eslavas',8),(1550,'891.9 - Literaturas bálticas y otras literaturas indoeuropeas',8),(1551,'892 - Literaturas afroasiáticas (camitosemíticas) Literaturas semíticas',8),(1552,'892.4 - Literatura hebrea',8),(1553,'892.43 - Novelística hebrea',8),(1554,'892.7 - Literaturas de las lenguas árabe y maltesa',8),(1555,'892.73 - Novelística de las lenguas árabe y maltesa',8),(1556,'893 - Literaturas afroasiáticas no semíticas',8),(1557,'894.3 - Literatura turca',8),(1558,'894.511 - Literatura húngara (magiar)',8),(1559,'895 - Del Asia oriental y sudoriental',8),(1560,'895.1 - Literatura china',8),(1561,'895.6 - Literatura japonesa',8),(1562,'895.7 - Literatura coreana',8),(1563,'896 - Literaturas africanas',8),(1564,'897 - Literaturas nativas norteamericanas',8),(1565,'898 - Literaturas nativas sudamericanas',8),(1566,'899 - Literaturas de las lenguas no austronesias y de las austronesias',8),(1567,'901 - Filosofía y teoría de la Historia',9),(1568,'903 - Diccionarios y enciclopedias de la Historia Universal',9),(1569,'904 - Relatos colectivos de acontecimientos',9),(1570,'907 - Educación. investigación. temas relacionados con la Historia',9),(1571,'907.2 - Investigación histórica Historiografía',9),(1572,'909 - Historia universal',9),(1573,'910 - Geografía y viajes',9),(1574,'910.01 - Filosofía y teoría de la geografía y de los viajes',9),(1575,'910.02 - La tierra (Geografía física)',9),(1576,'910.3 - Diccionarios. enciclopedias. concordancias. índices geográficos',9),(1577,'910.4 - Relatos de viajes',9),(1578,'910.9 - Tratamiento histórico. geográfico. de personas en la geografía',9),(1579,'911 - Geografía histórica',9),(1580,'911.7 - Geografía histórica de América del Norte y Central',9),(1581,'911.8 - Geografía histórica de América del Sur',9),(1582,'912 - Representaciones gráficas',9),(1583,'912.4 - Atlas de Europa',9),(1584,'912.5 - Atlas de Asia',9),(1585,'912.6 - Atlas de África',9),(1586,'912.7 - Atlas de América del Norte y Central',9),(1587,'912.8 - Atlas de América del Sur',9),(1588,'912.9 - Atlas de otras partes del mundo',9),(1589,'914 - Geografía y viajes en Europa',9),(1590,'915 - Geografía y viajes en Asia',9),(1591,'916 - Geografía y viajes en África',9),(1592,'917 - Geografía y viajes en América del Norte y Central',9),(1593,'918 - Geografía y viajes en América del Sur',9),(1594,'918.71 - Geografía y viajes en Cuba',9),(1595,'918.82 - Geografía y viajes en Argentina',9),(1596,'918.89 - Geografía y viajes en Uruguay',9),(1597,'919 - Geografía de y viajes en otras áreas',9),(1598,'920 - Biografía. genealogía. insignias',9),(1599,'920.02 - Colecciones generales de biografía',9),(1600,'920.03 - Colecciones generales de biografía por continentes, países, localidades',9),(1601,'920.07 - Colecciones generales de biografía en América del Norte y Central',9),(1602,'920.08 - Colecciones generales de biografía en América del Sur',9),(1603,'920.082 - Colecciones generales de biografía en Argentina',9),(1604,'920.1 - Bibliógrafos',9),(1605,'920.4 - Biografía Editores y vendedores de libros',9),(1606,'920.5 - Biografías de periodistas y comentaristas de noticias',9),(1607,'920.71 - Biografía Hombres',9),(1608,'920.72 - Biografía Mujeres',9),(1609,'921 - Biografía Filósofos y psicólogos',9),(1610,'922 - Biografía Líderes. pensadores. trabajadores religiosos',9),(1611,'923 - Biografía Personas en ciencias sociales',9),(1612,'924 - Biografía Filólogos y lexicógrafos',9),(1613,'925 - Biografía Científicos',9),(1614,'926 - Biografía Personas en tecnología',9),(1615,'927 - Biografía Personas en las artes y en recreación',9),(1616,'928 - Biografía Personas en literatura. historia. biografía. genealogía',9),(1617,'929 - Genealogía. nombres. insignias',9),(1618,'929.2 - Historias de familias',9),(1619,'929.4 - Nombres personales',9),(1620,'929.6 - Heráldica',9),(1621,'929.7 - Alta burguesía. casas reales. nobleza. órdenes de caballería',9),(1622,'929.8 - Premios. órdenes. condecoraciones. autógrafos',9),(1623,'929.9 - Formas de insignias w identificación',9),(1624,'930 - Historia del mundo antiguo hasta a.C. 499',9),(1625,'930.1 - Arqueología',9),(1626,'930.5 - Arqueología histórica desde 1 a 499 d C.',9),(1627,'932 - Historia de Egipto hasta 640',9),(1628,'933 - Historia de Palestina hasta 70',9),(1629,'936 - Historia de Europa al norte y al occidente de Italia hasta a.C. 499',9),(1630,'937 - Historia de Italia y territorios adyacentes hasta 476',9),(1631,'938 - Historia de Grecia hasta 323',9),(1632,'939 - Historia de otras partes del mundo antiguo hasta a.C. 640',9),(1633,'940 - Historia general de Europa',9),(1634,'940.1 - Historia de período antiguo hasta 1453',9),(1635,'940.2 - Historia de Europa 1453-',9),(1636,'940.3 - Primera guerra mundial. 1914-1918',9),(1637,'940.4 - Historia de Europa 1918-',9),(1638,'940.53 - Segunda Guerra mundial. 1939-1945',9),(1639,'941 - Historia de Islas británicas',9),(1640,'943 - Historia de Europa Central Alemania',9),(1641,'944 - Historia de Francia y Mónaco',9),(1642,'945 - Historia de Península Itálica e islas adyacentes',9),(1643,'947 - Historia de Europa Oriental Rusia',9),(1644,'949 - Historia de otras partes de Europa',9),(1645,'950 - Historia general de Asia Lejano Oriente',9),(1646,'951 - Historia de China y áreas adyacentes',9),(1647,'951.9 - Historia de Corea',9),(1648,'952 - Historia de Japón',9),(1649,'953 - Historia de Península de Araba e islas adyacentes',9),(1650,'954 - Historia de Asia del Sur India',9),(1651,'956 - Historia de Medio Oriente (Cercano Oriente)',9),(1652,'956.9 - Historia de Siria. Líbano. Chipre. Israel. Jordania',9),(1653,'958 - Historia de Asia Central',9),(1654,'960 - Historia general de África',9),(1655,'962 - Historia de Egipto y Sudán',9),(1656,'967 - Historia de África central e islas cercanas',9),(1657,'970 - Historia general de América del Norte',9),(1658,'972 - Historia de Mesoamérica (América Media) México',9),(1659,'972.81 - Historia de Guatemala',9),(1660,'972.83 - Historia de Honduras',9),(1661,'972.84 - Historia de El Salvador',9),(1662,'972.85 - Historia de Nicaragua',9),(1663,'972.86 - Historia de Costa Rica',9),(1664,'972.87 - Historia de Panamá',9),(1665,'972.9 - Historia de Indias Occidentales (Antillas) y Bermudas',9),(1666,'972.91 - Historia de Cuba',9),(1667,'972.93 - Historia de República Dominicana',9),(1668,'972.94 - Historia de Haití',9),(1669,'973 - Historia de Estados Unidos',9),(1670,'980 - Historia general de América del Sur',9),(1671,'980.01 - Historia de América del Sur Período antiguo hasta 1806',9),(1672,'980.02 - Historia de América del Sur Período de luchas por la independencia. 1806-1830',9),(1673,'980.03 - Historia de América del Sur 1830-1999',9),(1674,'980.04 - Historia de América del Sur 2000',9),(1675,'981 - Historia de Brasil',9),(1676,'982 - Historia de Argentina',9),(1677,'983 - Historia de Chile',9),(1678,'984 - Historia de Bolivia',9),(1679,'985 - Historia de Perú',9),(1680,'986 - Historia de Colombia y Ecuador',9),(1681,'986.6 - Historia de Ecuador',9),(1682,'987 - Historia de Venezuela',9),(1683,'988 - Historia de Guayanas',9),(1684,'989 - Historia de Paraguay y Uruguay',9),(1685,'989.5 - Historia de Uruguay',9),(1686,'990 - Historia general de otras áreas',9),(1687,'996 - Historia de otras partes del Océano Pacífico Polinesia',9),(1688,'998 - Historia de Islas árticas y Antártica',9);
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
INSERT INTO `c_tamanio` VALUES (1,'GB'),(2,'KB'),(3,'MB'),(4,'Min');
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
INSERT INTO `c_tinta` VALUES (1,'Offset'),(2,'Digital'),(3,'Tipográfica'),(4,'Xerográfica'),(5,'Otra');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_tipo_contenido`
--

LOCK TABLES `c_tipo_contenido` WRITE;
/*!40000 ALTER TABLE `c_tipo_contenido` DISABLE KEYS */;
INSERT INTO `c_tipo_contenido` VALUES (1,'Crónica periodística'),(2,'Cuento'),(3,'Educación Básica y Media'),(4,'Ensayo'),(5,'Libros Universitarios'),(6,'Literatura Infantil'),(7,'Poesía'),(8,'Novela'),(9,'Tesis doctorado'),(10,'Capítulo'),(11,'NO UTILIZAR'),(12,'Preescolar');
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
INSERT INTO `c_tipo_papel` VALUES (1,'Biblia'),(2,'Bond'),(3,'Esmaltado, couche'),(4,'Periódico'),(5,'Papeles especiales'),(6,'Propal beige'),(7,'Propalcote'),(8,'Propalibros'),(9,'Propalmate'),(10,'Otro');
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
INSERT INTO `seccion_solicitud` VALUES (1,'Tema','t','tema',1,'solicitud_id',1),(2,'Idioma','lng','sol_idioma',2,'solicitud',1),(3,'Colaboradores','colab','colaboradores',3,'solicitud_id',1),(4,'Traduccion','trns','traduccion',4,'solicitud_id',1),(5,'Información de edición','ed','edicion',5,'solicitud_id',1),(6,'Comercialización','cmrc','comercializable',6,'solicitud_id',0),(7,'Descripción física electrónica','dfe','desc_electronica',7,'solicitud_id',0),(8,'Descripción física impresa','dfi','desc_fisica_impresa',7,'solicitud_id',0),(9,'Pago electrónico','epay','epay',8,'solicitud_id',0),(10,'Código de barras','bc','barcode',10,'solicitud_id',0);
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

-- Dump completed on 2016-12-09  1:23:29
