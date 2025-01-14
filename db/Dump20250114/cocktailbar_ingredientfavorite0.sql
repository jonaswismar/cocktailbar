CREATE DATABASE  IF NOT EXISTS `cocktailbar` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cocktailbar`;
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
-- Table structure for table `ingredientfavorite`
--

DROP TABLE IF EXISTS `ingredientfavorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredientfavorite` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '1',
  `user` int NOT NULL,
  `ingredient` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_INDEX` (`user`),
  KEY `ingredient_INDEX` (`ingredient`),
  CONSTRAINT `ingredientfavorite_id_ingredient` FOREIGN KEY (`ingredient`) REFERENCES `ingredient` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `ingredientfavorite_id_user` FOREIGN KEY (`user`) REFERENCES `user` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientfavorite`
--

LOCK TABLES `ingredientfavorite` WRITE;
/*!40000 ALTER TABLE `ingredientfavorite` DISABLE KEYS */;
INSERT INTO `ingredientfavorite` VALUES (4,_binary '','2025-01-08 17:20:22','2025-01-08 17:20:22',1,2,10);
/*!40000 ALTER TABLE `ingredientfavorite` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14  0:16:24
