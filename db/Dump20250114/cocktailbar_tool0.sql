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
-- Table structure for table `tool`
--

DROP TABLE IF EXISTS `tool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tool` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '1',
  `toolname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cocktail_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `toolname_UNIQUE` (`toolname`),
  FULLTEXT KEY `toolname_FULLTEXT` (`toolname`),
  FULLTEXT KEY `description_FULLTEXT` (`description`),
  FULLTEXT KEY `tool_FULLTEXT` (`toolname`,`description`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tool`
--

LOCK TABLES `tool` WRITE;
/*!40000 ALTER TABLE `tool` DISABLE KEYS */;
INSERT INTO `tool` VALUES (1,_binary '','2025-01-13 10:53:44','2025-01-13 11:01:52',1,'Ausgießer','Sie werden auf Flaschenhälse gesteckt und erlauben ein zügigeres Abmessen und Eingießen','fa-duotone fa-light ',0),(2,_binary '','2025-01-13 10:53:44','2025-01-13 10:53:44',1,'Barglas (auch Rühr- oder Mixglas)','Dickwandiges, hohes Glas mit Ausgießschnabel. Im Barglas werden hauptsächlich Shortdrinks gemixt. Diese bestehen zumeist aus Spirrituosen und Likör, Vermouth, Sirup oder Südwein, beinhalten jedoch keine Säfte oder trübenden Zutaten. Mit dem Barglas werden die meisten Before- und After Drinks zuubereitet','fa-duotone fa-light fa-glass',0),(3,_binary '','2025-01-13 10:57:03','2025-01-13 10:57:03',1,'Barlöffel','Der ca. 25 Zentimeter lange Löffel dient zum Verrühren von Cocktailzutaten mit Eiswürfeln im Barglas. Er ist gleichzeitig eine kleine Maßeinheit für dickflüssige Liköre, Sirupe oder Cremes. In den Rezepten steht die Maßeinheit \"ein Barlöffel\" für das Volumen von 5 Mililitern.','fa-duotone fa-light fa-spoon',0),(4,_binary '','2025-01-13 11:01:52','2025-01-13 11:01:52',1,'Barmesser','Ein mittelgroßes Sägemesser zum Schneiden von Früchten. Messer mit zwei Spitzen eignen sich auch zum Aufspießen von Fruchtstücken, ein größeres Obstmesser für Früchte wie Ananas.','fa-duotone fa-light fa-knife-kitchen',0),(5,_binary '','2025-01-13 11:01:52','2025-01-13 11:01:52',1,'Barsieb (Strainer oder Double Strain)','Das Spiralsieb hält beim Abseihen aus dem Shaker oder Barglas die Eisstücke zuurück.','fa-duotone fa-light ',0),(6,_binary '','2025-01-13 11:03:32','2025-01-13 11:03:32',1,'Blender','Ein elekttrischer Mixer, der über einen nach uunten gerichteten Metalstab mit Qirl verfügt. Dieeser vermischt in einem von uunten eingehängten Metalbecher die Zutaten.','fa-duotone fa-light fa-blender',0),(7,_binary '','2025-01-13 11:11:29','2025-01-13 11:11:29',1,'Champangerflaschenverschluß','Damit werden angebrochene Champanger- oder Sektflaschen fest verschlossen, der Kohlesäureverrlust also verhindert. Er erlaubt eine angebrochene Flasche bis zum nächsten Tag aufzubewahren.','fa-duotone fa-light ',0),(8,_binary '','2025-01-13 11:11:29','2025-01-13 11:11:29',1,'Cocktailspieße','Kleine Spießchen aus Holz oder Kunststoff zuum Aufspießen von Cocktailkirschen, Oliven usw.','fa-duotone fa-light fa-pipe',0),(9,_binary '','2025-01-13 11:11:29','2025-01-13 11:11:29',1,'Elektromixer','Der Elektromixer (auch Standmixer) dient zum Pürieren von Früchten und Gemüse, zur Zubereitung von Mixgetränken mit schwer mischbaren Zutaten und auch zum Sahne schlagen. Er ist anstelle des Shakers gut einsetzbar, wenn größere Mengen zubereitet werden sollen.','fa-duotone fa-light fa-blender',0),(10,_binary '','2025-01-13 11:11:29','2025-01-13 11:11:29',1,'Eiseimer','Ein Gefäß aus Glas, Kunststoff oder Metall zur Aufbewahrung von Eiswürfeln. Er sollte sich auuch zum Aufstellen am Tisch eignen.','fa-duotone fa-light fa-bucket',0),(11,_binary '','2025-01-13 11:13:13','2025-01-13 11:13:13',1,'Eiszange uund Eisschaufel','Zum Aufnehmeen von Eiswürfeln, die in Trinkgläser, Shaker oder Barglas gegeben.','fa-duotone fa-light ',0),(12,_binary '','2025-01-13 11:19:47','2025-01-13 11:19:47',1,'Hebelkorkenzieher','Er sollte eine breite Spirale haben und mit einem Schneidemesser sowie einem Kapselheber ausgerüstet sein.','fa-duotone fa-light ',0),(13,_binary '','2025-01-13 11:19:47','2025-01-13 11:19:47',1,'Holzstößel (auch Stößel aus Edelstahl)','Braucht man zum Ausdrücken von Limetten oder Minze im Glas.','fa-duotone fa-light ',0),(14,_binary '','2025-01-13 11:19:47','2025-01-13 11:19:47',1,'Messbecher (auch Measuuuring Cup oder Jigger)','aus Metall, Glas oder Plastik. Die klassischen Metall-Modelle fassen auuf einer Seite 20 ml, auf der Gegenseite 40ml Flüssigkeit. Es sind auch Modelle mit Skalierung bis 50ml, mit Fassungsvermögen 30 und 50ml, 30 und 60ml, 25 und 50ml oder US-amerikanische mit Ounce-(Unzen)-Einteilung (fl oz = 29,5 ml) erhältlich','fa-duotone fa-light ',0),(15,_binary '','2025-01-13 11:20:57','2025-01-13 11:20:57',1,'Muskatreibe','Zum Abreiben von Muskatnüssen. Am besten sind Reiben mit Vorratsbehälter zuur Aufbewahrung der Muskatnuss.','fa-duotone fa-light ',0),(16,_binary '','2025-01-13 11:23:59','2025-01-13 11:23:59',1,'Schneidebrett','Ein größeres Holz- oder Kuunststoffbrett als UUnterlage beim Schneiden von Früchten.','fa-duotone fa-light ',0),(17,_binary '','2025-01-13 11:31:17','2025-01-13 11:31:17',1,'Shaker (schüttelbecher)','Drei Modelle von Shakern sind auf dem Markt: der zweiteilige aus Edelstahl oder Silber, der dreiteilige aus Edelstahl oder Silber mit im Mittelteil eingebauten Sieb und der Bostonshaker, der aus einem kleineren Glasteil und einem größeren Edelstahlteil besteht. Geschüttelt werden alle Mixgetränke, die schwer vermischbare Zutaten enthalten. Als Faustregel gilt: Alle Mixgetränke die Säfte oder Sahne enthalten, werden geschüttelt. Somitt ist die Frage, ob gerührrt oder geschütttelt wird, aufgruund der Zutaten sofort beantwortet. Fachgemäßes Schütteln bewirrkt eine gute Vermischung, außerdem wird rasch die Kälte des Eises angenommen, und man erhält bei vielen Rezepten eine schöne Schaumkrone.','fa-duotone fa-light ',0),(18,_binary '','2025-01-13 11:35:05','2025-01-13 11:35:05',1,'Spiralschäler','Auch Zestenreißer oder Kannelierrmesser. Damit lassen sich lange dünne Schalen von Bio-Orangen oder -Zitronen schälen.','fa-duotone fa-light ',0),(19,_binary '','2025-01-13 11:35:05','2025-01-13 11:35:05',1,'Stirrer','Ein langer Kunststoffstab zuum Rühren von Lonkdrings und zum Aufspießen von Früchten.','fa-duotone fa-light ',0),(20,_binary '','2025-01-13 11:35:05','2025-01-13 11:35:05',1,'Feines Teesieb','Dieses hält beim Abgießen mit dem Barsieb (dem sogenannten Double Strain) kleinere Fruchstücke oderm mitgeschüttelte Minzblätter etc. zurück.','fa-duotone fa-light ',0),(21,_binary '','2025-01-13 11:35:05','2025-01-13 11:35:05',1,'Trinkhalme','Sollten in verschiedenen Längen und Farben vorhanden sein','fa-duotone fa-light ',0);
/*!40000 ALTER TABLE `tool` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14  0:16:29
