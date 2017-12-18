CREATE DATABASE  IF NOT EXISTS `bd_chc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_chc`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_chc
-- ------------------------------------------------------
-- Server version	8.0.0-dmr-log

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
-- Table structure for table `cartafianza`
--

DROP TABLE IF EXISTS `cartafianza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartafianza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  `Obras_id` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`Obras_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_CartaFianza_Obras1_idx` (`Obras_id`),
  CONSTRAINT `fk_CartaFianza_Obras1` FOREIGN KEY (`Obras_id`) REFERENCES `obras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartafianza`
--

LOCK TABLES `cartafianza` WRITE;
/*!40000 ALTER TABLE `cartafianza` DISABLE KEYS */;
INSERT INTO `cartafianza` VALUES (1,'carta fianza 1',1,1);
/*!40000 ALTER TABLE `cartafianza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cf_fechas`
--

DROP TABLE IF EXISTS `cf_fechas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cf_fechas` (
  `det_cartafianza_id` int(11) NOT NULL,
  `fechaemision` date NOT NULL,
  `fechavencimiento` date NOT NULL,
  `es_amortizado` char(1) NOT NULL,
  PRIMARY KEY (`det_cartafianza_id`,`fechaemision`),
  UNIQUE KEY `fechaemision_UNIQUE` (`fechaemision`),
  KEY `fk_cf_fechas_det_cartafianza1_idx` (`det_cartafianza_id`),
  CONSTRAINT `fk_cf_fechas_det_cartafianza1` FOREIGN KEY (`det_cartafianza_id`) REFERENCES `det_cartafianza` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cf_fechas`
--

LOCK TABLES `cf_fechas` WRITE;
/*!40000 ALTER TABLE `cf_fechas` DISABLE KEYS */;
INSERT INTO `cf_fechas` VALUES (1,'2017-11-20','2017-11-20','0'),(1,'2017-11-21','2017-11-30','0');
/*!40000 ALTER TABLE `cf_fechas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clieprov`
--

DROP TABLE IF EXISTS `clieprov`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clieprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Razon_Social` varchar(150) NOT NULL,
  `ruc` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruc_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clieprov`
--

LOCK TABLES `clieprov` WRITE;
/*!40000 ALTER TABLE `clieprov` DISABLE KEYS */;
INSERT INTO `clieprov` VALUES (1,'MUNICIPALIDAD MORROPON',NULL),(2,'MUCHO CEMENTO ','12345678123');
/*!40000 ALTER TABLE `clieprov` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cobrarpagardoc`
--

DROP TABLE IF EXISTS `cobrarpagardoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cobrarpagardoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obras_id` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Fecha` date NOT NULL,
  `Numero` char(25) NOT NULL,
  `ValorInicial` decimal(17,6) NOT NULL,
  `ReajusteFP` decimal(17,6) DEFAULT NULL,
  `AdelantoDirecto` decimal(17,6) DEFAULT NULL,
  `AdelantoMateriales` decimal(17,6) DEFAULT NULL,
  `DeduccionRAD` decimal(17,6) DEFAULT NULL,
  `DediccionRAM` decimal(17,6) DEFAULT NULL,
  `MontoTotal` decimal(17,6) NOT NULL,
  `Pagado` decimal(17,6) NOT NULL,
  `Saldo` decimal(17,6) NOT NULL,
  `Tipo` char(1) NOT NULL,
  `Detraccion` char(2) DEFAULT NULL,
  `documento_id` int(11) NOT NULL,
  `clieprov_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`obras_id`,`documento_id`,`clieprov_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_CobrarPagarDoc_Obras1_idx` (`obras_id`),
  KEY `fk_cobrarpagardoc_documento1_idx` (`documento_id`),
  KEY `fk_cobrarpagardoc_clieprov1_idx` (`clieprov_id`),
  CONSTRAINT `fk_CobrarPagarDoc_Obras1` FOREIGN KEY (`obras_id`) REFERENCES `obras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cobrarpagardoc_clieprov1` FOREIGN KEY (`clieprov_id`) REFERENCES `clieprov` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cobrarpagardoc_documento1` FOREIGN KEY (`documento_id`) REFERENCES `documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobrarpagardoc`
--

LOCK TABLES `cobrarpagardoc` WRITE;
/*!40000 ALTER TABLE `cobrarpagardoc` DISABLE KEYS */;
INSERT INTO `cobrarpagardoc` VALUES (1,1,'Valorizacion N°1 Junio','2017-11-20','123',200000.000000,50.000000,300.000000,800.000000,500.000000,400.000000,198050.000000,0.000000,198050.000000,'A','NO',3,1);
/*!40000 ALTER TABLE `cobrarpagardoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctactecpd`
--

DROP TABLE IF EXISTS `ctactecpd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctactecpd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Pago` decimal(17,6) NOT NULL,
  `Fecha` date NOT NULL,
  `CobrarPagarDoc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`CobrarPagarDoc_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_ctactecpd_CobrarPagarDoc_idx` (`CobrarPagarDoc_id`),
  CONSTRAINT `fk_ctactecpd_CobrarPagarDoc` FOREIGN KEY (`CobrarPagarDoc_id`) REFERENCES `cobrarpagardoc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctactecpd`
--

LOCK TABLES `ctactecpd` WRITE;
/*!40000 ALTER TABLE `ctactecpd` DISABLE KEYS */;
/*!40000 ALTER TABLE `ctactecpd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `det_cartafianza`
--

DROP TABLE IF EXISTS `det_cartafianza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `det_cartafianza` (
  `id` int(11) NOT NULL,
  `CartaFianza_id` int(11) NOT NULL,
  `numero` char(10) NOT NULL,
  `gastofinac` decimal(17,6) NOT NULL,
  `montorenov` decimal(17,6) NOT NULL,
  `fechaemision` date NOT NULL,
  `fechavencren` date NOT NULL,
  PRIMARY KEY (`id`,`CartaFianza_id`),
  KEY `fk_det_cartafianza_CartaFianza1_idx` (`CartaFianza_id`),
  CONSTRAINT `fk_det_cartafianza_CartaFianza1` FOREIGN KEY (`CartaFianza_id`) REFERENCES `cartafianza` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `det_cartafianza`
--

LOCK TABLES `det_cartafianza` WRITE;
/*!40000 ALTER TABLE `det_cartafianza` DISABLE KEYS */;
INSERT INTO `det_cartafianza` VALUES (1,1,'123',213234.000000,23243.000000,'2017-11-20','2017-11-20');
/*!40000 ALTER TABLE `det_cartafianza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (1,'Adelanto Directo',1),(2,'Adelanto Materiales',1),(3,'Valorizacion',1);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(350) NOT NULL,
  `Empresa` varchar(50) NOT NULL,
  `NombreCorto` varchar(15) NOT NULL,
  `Monto_Inicial` decimal(17,6) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NombreCorto_UNIQUE` (`NombreCorto`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` VALUES (1,'chamaca11111111111111111','municipalidad chamaca','chamaca',93434557.000000,1),(5,'empty 23234','empty11','23234345',3454365456.000000,1),(6,'morropon','1234','morro12t',456567.000000,1),(7,'MORROPONMORROPON','MORROPON','morropon',34545657.000000,1);
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `nick` char(15) NOT NULL,
  `clave` char(50) NOT NULL,
  `tipousuario` char(1) NOT NULL,
  PRIMARY KEY (`nick`),
  UNIQUE KEY `nick_UNIQUE` (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('1','c4ca4238a0b923820dcc509a6f75849b','A');
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

-- Dump completed on 2017-11-20 14:33:05
