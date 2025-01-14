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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL DEFAULT '3',
  `icon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'fa-regular fa-user',
  `bar` int NOT NULL DEFAULT '1',
  `ignoregarnish` bit(1) NOT NULL DEFAULT b'0',
  `startpage` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'welcome.php',
  `language` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'de',
  `metricunits` bit(1) NOT NULL DEFAULT b'1',
  `searchmode` int NOT NULL DEFAULT '1',
  `darkmode` varchar(45) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'auto',
  `theme` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `username_INDEX` (`username`),
  KEY `role_INDEX` (`role`),
  CONSTRAINT `id_role` FOREIGN KEY (`role`) REFERENCES `role` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,_binary '','2025-01-01 00:00:00','2025-01-04 06:47:20',0,'Admin','$2y$10$vgVnoLUJNloQzBAoejM9hu3EvB6REI9Y5wi0qwHihmkMnKnUAGWO6',1,'fa-regular fa-user-visor',1,_binary '\0','welcome.php','de',_binary '',1,'auto',NULL),(2,_binary '','2024-11-26 23:05:45','2025-01-13 12:00:26',0,'jonas','$2y$10$vgVnoLUJNloQzBAoejM9hu3EvB6REI9Y5wi0qwHihmkMnKnUAGWO6',1,'fa-regular fa-user-visor',1,_binary '\0','welcome.php','de',_binary '',1,'0','default'),(3,_binary '','2025-01-09 11:07:07','2025-01-13 07:36:35',1,'jonasg','$2y$10$p89uEgo8PSC9ztfGmqt1IuVvFNkChYEA2PpiEvFcKshh6i..weos2',3,'fa-regular fa-user',1,_binary '\0','welcome.php','de',_binary '',1,'dark',NULL),(4,_binary '','2025-01-09 11:25:22','2025-01-10 12:56:44',1,'jonasb','$2y$10$o/nUOpLozQihDjjwbo0l3OFnKokaRmIEPGq./Cu2Xwj836ciZdAKq',2,'fa-regular fa-user',1,_binary '\0','welcome.php','de',_binary '',1,'0','default'),(5,_binary '','2025-01-09 19:02:41','2025-01-09 19:02:41',1,'KTP','$2y$10$YpRluqzB/K6WsKMk1Zr3jOLFHFd/9dNfHKeOrhktJnMm3ZWNWG2B6',3,'fa-regular fa-user',1,_binary '\0','welcome.php','de',_binary '',1,'auto',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14  0:16:01
