-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: cocktailbar
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '1',
  `unitshort` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unitshortX` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unitname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `unittype` int NOT NULL DEFAULT '3',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `unitname_UNIQUE` (`unitname`),
  KEY `unitname_INDEX` (`unitname`) /*!80000 INVISIBLE */,
  KEY `unittype_INDEX` (`unittype`),
  FULLTEXT KEY `nameandshortanddescription` (`unitname`,`unitshort`,`unitshortX`,`description`),
  CONSTRAINT `unit_id_unittype` FOREIGN KEY (`unittype`) REFERENCES `unittype` (`ID`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Ant.','Ant.',NULL,'fa-duotone fa-solid fa-droplet-percent','Anteil',4),(2,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'BL','BL',NULL,'fa-duotone fa-solid fa-spoon','Barlöffel',3),(3,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Bl.','Bl.',NULL,'fa-duotone fa-solid fa-leaf','Blatt',3),(4,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'cl','cl','Umr.:\r\n1 cl = 0,01 l','fa-duotone fa-solid fa-glass-half','Zentiliter',1),(5,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'3tel','3tel',NULL,'fa-duotone fa-solid fa-spinner-third','Drittel',4),(6,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'EisL','EisL',NULL,'fa-duotone fa-solid fa-spoon','Eislöffel',3),(7,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'EL','EL','1 EL ≙ 15 ml','fa-duotone fa-solid fa-bowl-spoon','Esslöffel',3),(8,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'g','g',NULL,'fa-duotone fa-solid fa-scale-unbalanced-flip','Gramm',2),(9,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Hälfte','Hälften',NULL,'fa-duotone fa-solid fa-circle-half','Hälfte',4),(10,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'ml','ml','Umr.:\r\n1 ml = 0,001 l','fa-duotone fa-solid fa-glass-half','Milliliter',1),(11,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'oz','oz','Umr.:\r\n1 oz = 0,03 l','fa-duotone fa-solid fa-glass-half','Unze',1),(12,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Prise','Prisen',NULL,'fa-duotone fa-solid fa-salt-shaker','Prise',3),(13,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Raspel','Raspeln',NULL,'fa-duotone fa-solid fa-grate','Raspel',3),(14,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Schale','Schalen',NULL,'fa-duotone fa-solid fa-banana','Schale',3),(15,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Scheibe','Scheiben',NULL,'fa-duotone fa-solid fa-pizza','Scheibe',3),(16,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Schuss','Schüsse',NULL,'fa-duotone fa-solid fa-whiskey-glass','Schuss',3),(17,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Spritzer','Spritzer',NULL,'fa-duotone fa-solid fa-droplet','Spritzer',3),(18,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Stängel','Stängel',NULL,'fa-duotone fa-solid fa-leafy-green','Stängel',3),(19,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'St.','St.',NULL,'fa-duotone fa-solid fa-cubes-stacked','Stück',4),(20,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Ta.','Ta.',NULL,'fa-duotone fa-solid fa-mug','Tasse',1),(21,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'TL','TL','1 TL ≙ 5 ml','fa-duotone fa-solid fa-spoon','Teelöffel',3),(22,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Tr.','Tr.',NULL,'fa-duotone fa-solid fa-eye-dropper-half','Tropfen',1),(23,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Twist','Twists',NULL,'fa-duotone fa-solid fa-tornado','Twist',3),(24,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Vt.','Vt.',NULL,'fa-duotone fa-solid fa-circle-quarters','Viertel',4),(25,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Würfel','Würfel',NULL,'fa-duotone fa-solid fa-dice','Würfel',3),(26,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Zweig','Zweige',NULL,'fa-duotone fa-solid fa-leafy-green','Zweig',3),(27,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Ganz','Ganz',NULL,'fa-solid fa-circle','Ganz',4),(28,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'Str.','Str.',NULL,'fa-duotone fa-solid fa-lines-leaning','Streifen',3),(29,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'l','l',NULL,'fa-duotone fa-solid fa-jug','Liter',1);
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14  0:16:00
