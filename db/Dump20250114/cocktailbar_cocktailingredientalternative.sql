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
-- Table structure for table `cocktailingredientalternative`
--

DROP TABLE IF EXISTS `cocktailingredientalternative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cocktailingredientalternative` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '1',
  `cocktailingredient` int NOT NULL,
  `ingredient` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `cocktailingredient_INDEX` (`cocktailingredient`),
  KEY `ingredient_INDEX` (`ingredient`),
  CONSTRAINT `cocktailingredientalternative_id_cocktailingredient` FOREIGN KEY (`cocktailingredient`) REFERENCES `cocktailingredient` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `cocktailingredientalternative_id_ingredient` FOREIGN KEY (`ingredient`) REFERENCES `ingredient` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cocktailingredientalternative`
--

LOCK TABLES `cocktailingredientalternative` WRITE;
/*!40000 ALTER TABLE `cocktailingredientalternative` DISABLE KEYS */;
INSERT INTO `cocktailingredientalternative` VALUES (1,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,779,68),(2,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,848,42),(3,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,846,318),(4,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,925,319),(5,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,1152,311),(6,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,1387,319),(7,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,1631,64),(8,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,2035,42),(9,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,2259,306),(10,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,2533,289),(11,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,2578,282),(12,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,2798,319),(13,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,2963,60),(14,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,3082,42),(15,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,3262,319),(16,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,3840,289),(17,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,3883,319),(18,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,3904,68),(19,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4194,306),(20,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4201,311),(21,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4644,274),(22,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4760,311),(23,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4771,12),(24,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4834,205),(25,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,4947,289),(26,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,5115,15),(27,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,5271,67),(28,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,6360,311),(29,_binary '','2025-01-13 15:17:46','2025-01-13 15:17:46',1,7230,101);
/*!40000 ALTER TABLE `cocktailingredientalternative` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14  0:15:54
