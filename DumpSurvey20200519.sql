-- MySQL dump 10.13  Distrib 5.7.2
--
-- Host: 127.0.0.1    Database: survey
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `bsta_status`
--


DROP TABLE IF EXISTS `bsta_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bsta_status` (
  `stan_code` int(1) NOT NULL,
  `stac_name` varchar(60) NOT NULL,
  PRIMARY KEY (`stan_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsta_status`
--

LOCK TABLES `bsta_status` WRITE;
/*!40000 ALTER TABLE `bsta_status` DISABLE KEYS */;
INSERT INTO `bsta_status` VALUES (1,'Active'),(2,'Retired');
/*!40000 ALTER TABLE `bsta_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `btyp_type`
--

DROP TABLE IF EXISTS `btyp_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `btyp_type` (
  `typn_code` int(1) NOT NULL,
  `typc_name` varchar(30) NOT NULL,
  PRIMARY KEY (`typn_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `btyp_type`
--

LOCK TABLES `btyp_type` WRITE;
/*!40000 ALTER TABLE `btyp_type` DISABLE KEYS */;
INSERT INTO `btyp_type` VALUES (1,'Admin'),(2,'User');
/*!40000 ALTER TABLE `btyp_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buse_user`
--

DROP TABLE IF EXISTS `buse_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buse_user` (
  `usec_id` varchar(100) NOT NULL,
  `usec_email` varchar(100) DEFAULT NULL,
  `usec_name` varchar(100) NOT NULL,
  `usec_surname` varchar(100) NOT NULL,
  `usen_type` int(1) NOT NULL,
  `usen_status` int(1) NOT NULL,
  `usec_pwd` varchar(30) NOT NULL,
  PRIMARY KEY (`usec_id`),
  KEY `fk_buse_bsta` (`usen_status`),
  KEY `fk_buse_btyp` (`usen_type`),
  CONSTRAINT `fk_buse_bsta` FOREIGN KEY (`usen_status`) REFERENCES `bsta_status` (`stan_code`),
  CONSTRAINT `fk_buse_btyp` FOREIGN KEY (`usen_type`) REFERENCES `btyp_type` (`typn_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buse_user`
--

LOCK TABLES `buse_user` WRITE;
/*!40000 ALTER TABLE `buse_user` DISABLE KEYS */;
INSERT INTO `buse_user` VALUES ('admin',NULL,'name','surname',1,1,'pwd'),('user',NULL,'name','surname',2,1,'pwd');
/*!40000 ALTER TABLE `buse_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-19 17:40:41
