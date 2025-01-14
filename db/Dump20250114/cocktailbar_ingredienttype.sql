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
-- Table structure for table `ingredienttype`
--

DROP TABLE IF EXISTS `ingredienttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredienttype` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '1',
  `typename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci,
  `icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ingredient_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `typename_UNIQUE` (`typename`),
  FULLTEXT KEY `typename_FULLTEXT` (`typename`) /*!80000 INVISIBLE */,
  FULLTEXT KEY `description_FULLTEXT` (`description`) /*!80000 INVISIBLE */,
  FULLTEXT KEY `nameanddescription` (`typename`,`description`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredienttype`
--

LOCK TABLES `ingredienttype` WRITE;
/*!40000 ALTER TABLE `ingredienttype` DISABLE KEYS */;
INSERT INTO `ingredienttype` VALUES (1,_binary '','2025-01-01 00:00:00','2025-01-08 17:37:06',0,'Saft','Saft ist eine essentielle Zutat in der Cocktailmixologie, die für Geschmack, Frische und Farbe sorgt. Ob frisch gepresst oder in Flaschen erhältlich, Säfte wie Zitrone, Orange, Cranberry und Ananas verleihen Cocktails eine ausgewogene Süße und Säure. Sie harmonieren mit Spirituosen, fördern die Vielfalt in Mixgetränken und sind perfekt für Erfrischungen, die das Geschmackserlebnis bereichern','fa-duotone fa-solid fa-bottle-water',28),(2,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Gemüse','Gemüse ist eine vielseitige Zutat in der Cocktailmixologie, die frische Aromen und interessante Texturen hinzufügt. Von Gurken und Sellerie bis zu Karotten und Paprika bieten Gemüseoptionen erfrischende und gesunde Alternativen. Sie können in Cocktails verwendet werden, um Geschmack zu intensivieren oder als Garnierung zu dienen, und eröffnen spannende Kombinationen, die sowohl klassisch als auch modern sind','fa-duotone fa-solid fa-carrot',12),(3,_binary '','2025-01-01 00:00:00','2025-01-13 19:01:53',0,'Obst/Frucht','Obst und Früchte sind unverzichtbare Zutaten in der Cocktailmixologie, die Geschmack, Farbe und Frische verleihen. Von saftigen Zitrusfrüchten über aromatische Beeren bis hin zu tropischen Varianten wie Ananas und Mango, jedes Obst bringt seine eigene Süße und Säure mit. Sie können frisch verwendet, püriert oder als Garnierung eingesetzt werden, um Cocktails zu verfeinern und das Geschmackserlebnis zu bereichern','fa-duotone fa-solid fa-apple-whole',34),(4,_binary '','2025-01-01 00:00:00','2025-01-08 17:36:48',0,'Gewürz','Gewürze sind ein faszinierender Zutatentyp in der Cocktailmixologie, der Tiefe und Komplexität in die Drinks bringt. Von klassischen Gewürzen wie Zimt und Muskatnuss bis zu exotischen Varianten wie Kardamom und Sternanis, sie verleihen Cocktails eine aromatische Note. Gewürze können frisch, getrocknet oder als Sirup verwendet werden und eröffnen kreative Möglichkeiten, um Geschmäcker zu kombinieren und einzigartige Geschmackserlebnisse zu schaffen','fa-duotone fa-solid fa-pepper-hot',23),(5,_binary '','2025-01-01 00:00:00','2025-01-08 17:27:35',0,'Sirup','Sirup ist eine essentielle Zutat in der Cocktailmixologie, die Süße und Komplexität hinzufügt. Ob klassisch wie Zuckersirup oder aromatisiert mit Früchten, Kräutern oder Gewürzen, Sirupe ermöglichen die Anpassung von Cocktails an verschiedene Geschmäcker. Sie sorgen für eine harmonische Balance und sind entscheidend für die Kreation von erfrischenden und ansprechenden Drinks','fa-duotone fa-solid fa-glass-water-droplet',49),(6,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Kräuter','Kräuter sind ein unverzichtbarer Bestandteil der Cocktailmixologie, die frische Aromen und komplexe Geschmacksnoten einbringen. Von klassischen Kräutern wie Minze und Basilikum bis hin zu exotischen Sorten wie Estragon oder Rosmarin, sie können frisch, getrocknet oder als Sirup verwendet werden. Kräuter verleihen Cocktails eine besondere Tiefe, fördern kreative Kombinationen und sorgen für ansprechende Garnierungen, die das Geschmackserlebnis bereichern','fa-duotone fa-solid fa-seedling',5),(7,_binary '','2025-01-01 00:00:00','2025-01-08 23:28:49',0,'Getränk','Getränke sind grundlegende Zutaten in der Cocktailmixologie, die als Basis oder Ergänzung für Cocktails dienen. Dazu zählen Spirituosen wie Wodka, Rum und Gin, sowie Mixgetränke wie Limonade, Tonic Water und Säfte. Die Auswahl des richtigen Getränks beeinflusst Geschmack, Textur und Gesamtbalance eines Cocktails und eröffnet unzählige kreative Möglichkeiten für erfrischende Mischungen','fa-duotone fa-solid fa-glass-water',32),(8,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Eiscreme','Eiscreme ist eine aufregende Zutat in der Cocktailmixologie, die cremige Textur und süße Aromen hinzufügt. Sie eignet sich hervorragend für gefrorene Cocktails und Dessert-Drinks, die sowohl erfrischend als auch indulgent sind. Eiscreme kann in Kombination mit Spirituosen wie Wodka oder Rum verwendet werden, um einzigartige, geschmackvolle Cocktails zu kreieren, die nicht nur köstlich sind, sondern auch optisch ansprechend. Sie fördert kreative Mixmöglichkeiten und macht jeden Drink zu einem besonderen Erlebnis','fa-duotone fa-solid fa-ice-cream',2),(9,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Medikament','Medikamente sind ein faszinierender, wenn auch seltener Zutatentyp in der Cocktailmixologie, der für besondere Effekte und geschmackliche Nuancen sorgt. Diese Zutaten, wie Bitterstoffe oder spezielle Sirupe, können nicht nur den Geschmack eines Cocktails intensivieren, sondern auch eine gewisse Funktionalität bieten. Sie verleihen Drinks Tiefe und Komplexität, während sie gleichzeitig die Kreativität des Mixologen herausfordern. Mit Bedacht eingesetzt, können sie die Geschmackserlebnisse bereichern und neue Dimensionen in klassischen Rezepten eröffnen','fa-duotone fa-solid fa-prescription-bottle-medical',1),(10,_binary '','2025-01-01 00:00:00','2025-01-08 22:59:42',0,'Alkohol','Alkohol ist die zentrale Zutat in der Cocktailmixologie, die den Geschmack und die Struktur der Drinks bestimmt. Von klassischen Spirituosen wie Gin, Wodka und Rum bis zu Likören und Aperitifs, die Vielfalt der Alkohole ermöglicht eine nahezu unbegrenzte Kreativität. Die Wahl des Alkohols beeinflusst die Balance, Aromen und die Gesamtwirkung des Cocktails und schafft eine Grundlage für zahlreiche Variationen. Durch die Kombination verschiedener Alkoholtypen entstehen komplexe Geschmackserlebnisse, die sowohl traditionell als auch innovativ sind','fa-duotone fa-solid fa-martini-glass',180),(12,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Süßigkeiten','Süßigkeiten sind eine kreative und verspielte Zutat in der Cocktailmixologie, die Drinks einen einzigartigen Geschmack und eine dekorative Note verleihen. Von Bonbons über Gummibärchen bis hin zu Schokolade und Karamell können Süßigkeiten als Garnitur oder Bestandteil eingesetzt werden. Sie bringen süße Aromen und visuelle Attraktivität in Cocktails, ideal für besondere Anlässe oder Themenpartys. Die Verwendung von Süßigkeiten fördert die Experimentierfreude und eröffnet neue Geschmackskombinationen, die sowohl Kinder als auch Erwachsene ansprechen','fa-duotone fa-solid fa-cookie-bite',5),(13,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Lebensmittel','Lebensmittel sind eine vielseitige Zutat in der Cocktailmixologie, die Aromen, Texturen und visuelle Elemente einbringen. Dazu gehören frische Zutaten wie Obst, Gemüse und Kräuter, die in Cocktails verarbeitet oder als Garnitur verwendet werden. Lebensmittel fördern kreative Kombinationen und ermöglichen es Mixologen, einzigartige Geschmackserlebnisse zu schaffen. Die Verwendung von Lebensmitteln verleiht den Drinks eine besondere Note, hebt sie hervor und spricht die Sinne an, wodurch jede Kreation zu einem unvergesslichen Erlebnis wird','fa-duotone fa-solid fa-burger',23),(14,_binary '','2025-01-01 00:00:00','2025-01-04 05:59:34',0,'Bitter','Bitter sind essentielle Zutaten in der Cocktailmixologie, die Tiefe und Komplexität hinzufügen. Sie werden häufig in Form von Bitterstoffen oder Likören wie Angostura und Campari eingesetzt. Bitter balancieren die Süße und erhöhen die Geschmacksvielfalt eines Cocktails. Durch ihre kräftigen Aromen fördern sie die Experimentierfreude und ermöglichen es Mixologen, aufregende und unvergessliche Geschmackserlebnisse zu kreieren. Sie sind entscheidend für viele klassische Rezepte und bieten eine spannende Grundlage für innovative Cocktails','fa-duotone fa-solid fa-bottle-droplet',4),(15,_binary '','2025-01-01 00:00:00','2025-01-13 15:26:51',0,'Sonstiges','Der Zutatentyp \"Sonstiges\" umfasst eine Vielzahl von Zutaten, die nicht in die gängigen Kategorien fallen, aber dennoch in der Cocktailmixologie eine wichtige Rolle spielen. Dazu gehören spezielle Essenzen, unkonventionelle Aromastoffe, oder ungewöhnliche Garnituren. Diese Zutaten bringen innovative Akzente und persönliche Note in Cocktails. Durch ihre Verwendung können Mixologen kreative Grenzen überschreiten und einzigartige Geschmackserlebnisse schaffen. \"Sonstiges\" ist der Raum für Experimentierfreude und Individualität, der es ermöglicht, Drinks zu kreieren, die sowohl optisch als auch geschmacklich überraschen','fa-duotone fa-solid fa-cubes-stacked',4);
/*!40000 ALTER TABLE `ingredienttype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-14  0:15:58
