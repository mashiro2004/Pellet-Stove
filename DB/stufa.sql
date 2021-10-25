-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: stufa
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-0+deb11u1

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
-- Table structure for table `domenica`
--

DROP TABLE IF EXISTS `domenica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domenica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domenica`
--

LOCK TABLES `domenica` WRITE;
/*!40000 ALTER TABLE `domenica` DISABLE KEYS */;
INSERT INTO `domenica` VALUES (4,'07:00','','','21:00','','','','');
/*!40000 ALTER TABLE `domenica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giovedi`
--

DROP TABLE IF EXISTS `giovedi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giovedi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giovedi`
--

LOCK TABLES `giovedi` WRITE;
/*!40000 ALTER TABLE `giovedi` DISABLE KEYS */;
INSERT INTO `giovedi` VALUES (2,'04:50','','','21:00','','','14:00','07:50');
/*!40000 ALTER TABLE `giovedi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lunedi`
--

DROP TABLE IF EXISTS `lunedi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lunedi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lunedi`
--

LOCK TABLES `lunedi` WRITE;
/*!40000 ALTER TABLE `lunedi` DISABLE KEYS */;
INSERT INTO `lunedi` VALUES (78,'04:50','','','21:00','','','14:00','07:50');
/*!40000 ALTER TABLE `lunedi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `martedi`
--

DROP TABLE IF EXISTS `martedi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `martedi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `martedi`
--

LOCK TABLES `martedi` WRITE;
/*!40000 ALTER TABLE `martedi` DISABLE KEYS */;
INSERT INTO `martedi` VALUES (14,'04:50','','','21:00','','','14:00','07:50');
/*!40000 ALTER TABLE `martedi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mercoledi`
--

DROP TABLE IF EXISTS `mercoledi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mercoledi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mercoledi`
--

LOCK TABLES `mercoledi` WRITE;
/*!40000 ALTER TABLE `mercoledi` DISABLE KEYS */;
INSERT INTO `mercoledi` VALUES (7,'04:50','','','21:00','','','13:00','07:50');
/*!40000 ALTER TABLE `mercoledi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sabato`
--

DROP TABLE IF EXISTS `sabato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sabato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sabato`
--

LOCK TABLES `sabato` WRITE;
/*!40000 ALTER TABLE `sabato` DISABLE KEYS */;
INSERT INTO `sabato` VALUES (5,'07:00','','','21:00','','','','');
/*!40000 ALTER TABLE `sabato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venerdi`
--

DROP TABLE IF EXISTS `venerdi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venerdi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inizio1` text NOT NULL,
  `inizio2` text NOT NULL,
  `inizio3` text NOT NULL,
  `fine1` text NOT NULL,
  `fine2` text NOT NULL,
  `fine3` text NOT NULL,
  `alza` text NOT NULL,
  `abbassa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venerdi`
--

LOCK TABLES `venerdi` WRITE;
/*!40000 ALTER TABLE `venerdi` DISABLE KEYS */;
INSERT INTO `venerdi` VALUES (3,'04:50','','','21:00','','','13:00','07:50');
/*!40000 ALTER TABLE `venerdi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-21 19:10:18
