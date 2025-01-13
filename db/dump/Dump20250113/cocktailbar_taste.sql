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
-- Table structure for table `taste`
--

DROP TABLE IF EXISTS `taste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taste` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client` int NOT NULL DEFAULT '1',
  `taste` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci,
  `icon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'fa-duotone fa-wine-bottle',
  `ingredient_count` int NOT NULL DEFAULT '0',
  `cocktail_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `taste_UNIQUE` (`taste`),
  FULLTEXT KEY `taste_FULLTEXT` (`taste`) /*!80000 INVISIBLE */,
  FULLTEXT KEY `description_FULLTEXT` (`description`),
  FULLTEXT KEY `nameanddescription` (`taste`,`description`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taste`
--

LOCK TABLES `taste` WRITE;
/*!40000 ALTER TABLE `taste` DISABLE KEYS */;
INSERT INTO `taste` VALUES (1,_binary '','2025-01-01 00:00:00','2025-01-08 23:41:39',0,'fruchtig','Der Geschmack \"fruchtig\" ist in der Cocktailmixologie besonders beliebt und sorgt für frische, lebendige Aromen. Fruchtige Cocktails nutzen die Vielfalt von Obst wie Zitrusfrüchten, Beeren, Steinfrüchten und tropischen Früchten, um süße und saftige Geschmackserlebnisse zu kreieren. Diese Aromen bringen nicht nur Süße, sondern auch eine angenehme Säure, die die Balance in jedem Drink unterstützt. Fruchtige Cocktails sind ideal für sommerliche Anlässe und verleihen jedem Getränk eine einladende, fröhliche Note, die sowohl visuell als auch geschmacklich anspricht','fa-duotone fa-apple-whole',90,42),(2,_binary '','2025-01-01 00:00:00','2025-01-08 23:43:06',0,'süß','Der Geschmack \"süß\" spielt eine zentrale Rolle in der Cocktailmixologie und verleiht Drinks eine angenehme, einladende Note. Süße Aromen stammen oft von Zuckern, Sirupen, Limonaden oder fruchtigen Zutaten. Sie balancieren die Bitterkeit und Säure anderer Zutaten aus und schaffen ein harmonisches Geschmackserlebnis. Süße Cocktails sind besonders beliebt bei denen, die nach einem milden und schmackhaften Genuss suchen. Sie eignen sich hervorragend für festliche Anlässe und laden dazu ein, mit verschiedenen Kombinationen zu experimentieren, um kreative und ansprechende Drinks zu kreieren','fa-duotone fa-candy',174,0),(3,_binary '','2025-01-01 00:00:00','2025-01-08 23:42:37',0,'sauer','Der Geschmack \"sauer\" ist ein wesentlicher Bestandteil der Cocktailmixologie und sorgt für eine erfrischende und lebendige Note. Sauerstoffe wie Zitrussaft, insbesondere Limetten- und Zitronensaft, bringen eine angenehme Frische in Drinks. Sie balancieren die Süße aus und intensivieren die Aromen anderer Zutaten. Sauere Cocktails sind oft spritzig und anregend, ideal für heiße Tage oder gesellige Anlässe. Sie laden dazu ein, mit verschiedenen Zutaten zu experimentieren und kreative Kombinationen zu entwickeln, die sowohl Geschmack als auch visuelle Attraktivität bieten. Sauer ist der Schlüssel zu einem ausgewogenen und geschmacklich spannenden Cocktail','fa-duotone fa-lemon',24,0),(4,_binary '','2025-01-01 00:00:00','2025-01-08 23:40:09',0,'frisch','Der Geschmack \"frisch\" ist in der Cocktailmixologie unverzichtbar und vermittelt ein Gefühl von Leichtigkeit und Lebendigkeit. Frische Zutaten wie Kräuter, Zitrusfrüchte und saisonales Obst bringen eine belebende Note in Cocktails. Sie fördern die Balance zwischen Süße und Säure und sorgen für ein erfrischendes Trinkerlebnis. Frische Aromen sprechen die Sinne an und laden dazu ein, innovative Kombinationen zu kreieren, die sowohl geschmacklich als auch visuell ansprechend sind. Cocktails mit frischen Elementen sind ideal für gesellige Anlässe und Sommerpartys, da sie den Genuss und die Freude am Trinken hervorheben','fa-duotone fa-cherries',22,0),(5,_binary '','2025-01-01 00:00:00','2025-01-01 00:00:00',0,'funky','Der Geschmack \"funky\" in der Cocktailmixologie bezieht sich auf unkonventionelle, überraschende und oft komplexe Aromen, die den Gaumen herausfordern. Funky Cocktails kombinieren exotische Zutaten wie fermentierte Elemente, Kräuter, Gewürze und ungewöhnliche Früchte, um interessante Geschmackserlebnisse zu schaffen. Diese Drinks laden zum Experimentieren ein und bieten die Möglichkeit, die Grenzen traditioneller Cocktails zu überschreiten. Die Verwendung von funky Aromen bringt eine spielerische und kreative Note in die Mixologie, ideal für Abenteuerlustige und Kenner, die auf der Suche nach neuen Geschmackshorizonten sind. Funky Cocktails sind sowohl aufregend als auch ein Gesprächsthema auf jeder Veranstaltung','fa-duotone fa-music-note',0,0),(6,_binary '','2025-01-01 00:00:00','2025-01-08 23:30:49',0,'intressant','Der Geschmack \"interessant\" in der Cocktailmixologie beschreibt Aromen, die Neugier wecken und unerwartete Geschmackskombinationen bieten. Diese Cocktails nutzen eine Vielfalt an Zutaten, von exotischen Früchten über gewürzte Liköre bis hin zu handwerklich hergestellten Sirupen, um ein komplexes Geschmackserlebnis zu schaffen. Sie regen zum Nachdenken und Entdecken an, indem sie traditionelle Rezepte neu interpretieren und innovative Akzente setzen. Interessante Cocktails sind ideal für Kenner und Abenteurer, die ihre Sinne herausfordern möchten. Sie laden ein, verschiedene Geschmäcker zu erkunden und fördern Gespräche über die Vielfalt der Cocktailwelt','fa-duotone fa-hand-pointer',2,0),(7,_binary '','2025-01-01 00:00:00','2025-01-08 23:14:02',0,'cool','Der Geschmack \"cool\" in der Cocktailmixologie verkörpert eine erfrischende und oft belebende Note, die für ein angenehmes Trinkerlebnis sorgt. Diese Cocktails kombinieren kühlende Zutaten wie Minze, Gurke oder aromatische Bitter, um eine entspannende Atmosphäre zu schaffen. Cool Cocktails sind ideal für heiße Sommertage oder gesellige Abende, da sie eine ausgewogene Mischung aus Frische und Geschmack bieten. Oft werden sie mit Eis oder in gefrorener Form serviert, was die kühlende Wirkung verstärkt. Die Kreativität bei der Gestaltung dieser Drinks ermöglicht es, verschiedene Aromen zu kombinieren und ein einzigartiges, ansprechendes Geschmackserlebnis zu bieten, das Gäste begeistert','fa-duotone fa-icicles',4,0),(8,_binary '','2025-01-01 00:00:00','2025-01-08 23:36:27',0,'spritzig','Der Geschmack \"spritzig\" in der Cocktailmixologie beschreibt eine lebhafte und erfrischende Note, die oft durch kohlensäurehaltige Zutaten oder Zitrusfrüchte erzeugt wird. Spritzige Cocktails bieten eine anregende Kombination aus Säure und Sprudel, die den Gaumen belebt und für ein fröhliches Trinkerlebnis sorgt. Sie sind ideal für gesellige Anlässe und Sommerpartys, da sie Leichtigkeit und Freude vermitteln. Oftmals werden sie mit frischen Kräutern oder fruchtigen Garnituren verfeinert, um zusätzliche Aromen zu schaffen. Spritzige Cocktails laden dazu ein, verschiedene Zutaten zu kombinieren und kreative Variationen auszuprobieren, wodurch jeder Drink einzigartig und ansprechend wird','fa-duotone fa-chart-scatter-bubble',20,0),(9,_binary '','2025-01-01 00:00:00','2025-01-08 23:27:48',0,'cremig','Der Geschmack \"cremig\" in der Cocktailmixologie beschreibt eine reichhaltige, samtige Textur, die ein luxuriöses Trinkerlebnis bietet. Cremige Cocktails verwenden Zutaten wie Sahne, Kokosmilch oder Milchprodukte, um eine weiche und harmonische Konsistenz zu schaffen. Sie sind oft süß und verleihen Drinks ein wohliges Gefühl. Beliebt sind Klassiker wie Pina Colada oder White Russian, die die cremige Komponente mit fruchtigen oder spirituosen Aromen kombinieren. Diese Cocktails sind ideal für entspannte Abende oder als Dessert-Alternative. Die Vielfalt an Möglichkeiten, von klassischen Rezepten bis zu kreativen Neuinterpretationen, macht cremige Cocktails zu einem Genuss für jeden Gaumen','fa-duotone fa-ice-cream',22,0),(10,_binary '','2025-01-01 00:00:00','2025-01-08 23:27:41',0,'exotisch','Der Geschmack \"exotisch\" in der Cocktailmixologie entführt die Sinne auf eine geschmackliche Reise in ferne Länder. Exotische Cocktails kombinieren ungewöhnliche Zutaten wie tropische Früchte, Gewürze und aromatische Kräuter, um ein einzigartiges und aufregendes Geschmackserlebnis zu schaffen. Sie bieten oft eine bunte Palette an Aromen, die von süß und sauer bis hin zu würzig und bitter reichen. Beliebte Zutaten sind Ananas, Mango, Passionsfrucht oder Kokosnuss, die zusammen mit Spirituosen wie Rum oder Gin verwendet werden. Diese Cocktails sind ideal für gesellige Anlässe und bringen ein Gefühl von Abenteuer und Entspannung. Exotische Cocktails inspirieren dazu, neue Geschmackskombinationen auszuprobieren und die Vielfalt der Mixkunst zu entdecken','fa-duotone fa-pineapple',34,0),(11,_binary '','2025-01-01 00:00:00','2025-01-08 23:43:28',0,'würzig','Der Geschmack \"würzig\" in der Cocktailmixologie bringt eine aufregende Dimension in Drinks, indem er durch verschiedene Gewürze und Aromen Tiefe und Komplexität verleiht. Würzige Cocktails verwenden Zutaten wie Ingwer, Zimt, Pfeffer oder Chili, die eine angenehme Schärfe und Wärme bieten. Sie können sowohl süß als auch sauer sein und oft mit Spirituosen wie Rum, Whiskey oder Tequila kombiniert werden. Diese Cocktails sind ideal für Genießer, die das Außergewöhnliche suchen, und bieten eine hervorragende Möglichkeit, die Geschmäcker der Welt zu entdecken. Würzige Cocktails sind nicht nur ein Genuss für den Gaumen, sondern auch ein visuelles Erlebnis, oft dekoriert mit frischen Kräutern oder aromatischen Garnituren, die den Geschmack weiter unterstreichen','fa-duotone fa-pepper',55,0),(12,_binary '','2025-01-01 00:00:00','2025-01-08 23:42:37',0,'aromatisch','Der Geschmack \"aromatisch\" in der Cocktailmixologie zeichnet sich durch komplexe und vielschichtige Aromen aus, die das Trinkerlebnis bereichern. Aromatische Cocktails nutzen eine Kombination aus Kräutern, Gewürzen, Früchten und besonderen Spirituosen, um ein intensives Geschmackserlebnis zu schaffen. Zutaten wie Basilikum, Rosmarin oder verschiedene Bitter verleihen den Drinks eine Tiefe, die sowohl süß als auch herb sein kann. Diese Cocktails sind ideal für Genießer, die Nuancen schätzen und neue Geschmackskombinationen entdecken möchten. Oftmals werden sie mit ansprechenden Garnituren serviert, die das aromatische Profil unterstreichen und visuell beeindrucken. Aromatische Cocktails laden dazu ein, die Sinne zu öffnen und die Vielfalt der Aromen in der Mixkunst zu erkunden','fa-duotone fa-pan-food',91,37),(13,_binary '','2025-01-01 00:00:00','2025-01-08 23:31:38',0,'trocken','Der Geschmack \"trocken\" in der Cocktailmixologie bezieht sich auf Drinks, die weniger süß sind und eine klare, klare Aromenstruktur aufweisen. Trockenheit wird oft durch den Einsatz von trockenen Vermouths, hochwertigen Spirituosen und bitteren Zutaten erreicht. Diese Cocktails sind ideal für Liebhaber von kräftigen, nuancierten Geschmäckern. Zu den bekanntesten trockenen Cocktails gehören der Dry Martini und der Negroni, die sowohl in der Bar als auch zu Hause geschätzt werden. Trockenheit kann durch verschiedene Garnituren wie Oliven oder Zitronenzesten ergänzt werden, die den Geschmack weiter betonen. Diese Cocktails sind perfekt für gehobene Anlässe und eignen sich gut als Aperitif, um den Appetit anzuregen und den Gaumen auf das bevorstehende Essen vorzubereiten','fa-duotone fa-wine-bottle',5,0),(14,_binary '','2025-01-01 00:00:00','2025-01-08 23:36:27',0,'bitter','Der Geschmack \"bitter\" spielt eine zentrale Rolle in der Cocktailmixologie und verleiht Drinks Tiefe und Komplexität. Bittere Aromen entstehen durch die Verwendung von Zutaten wie Bitterstoffen, Kräutern, bestimmten Spirituosen oder aromatisierten Likören. Klassiker wie der Negroni oder der Old Fashioned nutzen Bitterkeit, um eine harmonische Balance zu süßen und sauren Elementen zu schaffen. Diese Cocktails sind ideal für Kenner, die nuancierte Geschmäcker schätzen und die vielfältigen Aromen der Mixkunst erkunden möchten. Die Bitterkeit kann auch durch Garnituren wie Zitronenschalen oder Kirschen akzentuiert werden, die das Geschmackserlebnis abrunden. Bittere Cocktails fördern oft das gesellige Miteinander und sind perfekt für entspannte Abende oder besondere Anlässe','fa-duotone fa-feather-pointed',24,0),(15,_binary '','2025-01-01 00:00:00','2025-01-08 23:41:26',0,'alkoholisch','Der Geschmack \"alkoholisch\" ist ein zentraler Aspekt der Cocktailmixologie und beschreibt das Vorhandensein von Alkohol als dominierenden Geschmacksträger. Dieser Geschmack kann durch verschiedene Spirituosen wie Whisky, Gin, Rum oder Tequila hervorgehoben werden, die jeweils ihre eigenen charakteristischen Aromen und Nuancen einbringen. Alkoholische Cocktails wie der Whiskey Sour oder der Daiquiri betonen die Essenz der verwendeten Spirituose und schaffen ein intensives Geschmackserlebnis. Der alkoholische Geschmack wird oft durch süße, saure oder bittere Komponenten ausgeglichen, um die Balance zu fördern und den Genuss zu maximieren. Solche Cocktails eignen sich ideal für gesellige Zusammenkünfte oder besondere Anlässe, bei denen die Qualität der Spirituosen und die Kunst des Mixens im Vordergrund stehen','fa-duotone fa-wine-glass',48,0),(16,_binary '','2025-01-01 00:00:00','2025-01-08 23:41:07',0,'salzig','Der Geschmack \"salzig\" in Cocktails bringt eine spannende Dimension in die Mixkunst und ergänzt oft die Aromen anderer Zutaten. Salzigkeit wird häufig durch Meersalz oder gesalzene Zutaten wie Oliven oder Gurken erreicht. Cocktails wie der Dirty Martini oder der Bloody Mary nutzen salzige Elemente, um die Geschmackskomplexität zu erhöhen und eine harmonische Balance zu schaffen. Salzigkeit kann auch die Süße und Säure eines Drinks ausgleichen, was zu einem erfrischenden Erlebnis führt. Diese Geschmacksrichtung ist ideal für experimentierfreudige Genießer, die neue Geschmackskombinationen entdecken möchten. Salzige Cocktails eignen sich hervorragend für gesellige Anlässe und passen gut zu herzhaften Snacks oder Tapas, die das Geschmackserlebnis abrunden','fa-duotone fa-salt-shaker',8,0),(17,_binary '','2025-01-01 00:00:00','2025-01-08 23:43:28',0,'scharf','Der Geschmack \"scharf\" in Cocktails bringt eine aufregende, würzige Note in die Mixologie. Schärfe kann durch Zutaten wie frische Chilischoten, Pfeffer oder sogar scharfe Saucen erzeugt werden. Cocktails wie der Spicy Margarita oder der Bloody Mary nutzen diese intensiven Aromen, um das Geschmackserlebnis zu intensivieren und eine unerwartete Würze zu verleihen. Scharfe Cocktails sind ideal für abenteuerlustige Genießer, die gerne neue Kombinationen ausprobieren. Die Schärfe kann auch durch fruchtige oder süße Elemente gemildert werden, was eine interessante Balance schafft. Diese Getränke sind perfekt für gesellige Anlässe und verleihen jedem Cocktailabend einen Hauch von Exotik und Abenteuer','fa-duotone fa-pepper-hot',14,0),(18,_binary '','2025-01-01 00:00:00','2025-01-08 23:36:02',0,'herb','Der Geschmack \"herb\" in Cocktails ist eine faszinierende Komplexität, die oft durch bittere oder tanninhaltige Zutaten erreicht wird. Kräuterliköre, Bitterstoffe und bestimmte Weinsorten wie Vermouth tragen zur herben Note bei. Drinks wie der Negroni oder der Americano zeigen, wie Bitterkeit das Geschmackserlebnis vertiefen und die Aromen harmonisch ausbalancieren können. Herb ist ideal für Genießer, die komplexe und raffinierte Getränke schätzen. Diese Geschmacksrichtung passt hervorragend zu herzhaften Snacks und eröffnet neue Genussdimensionen, die sich von süßen oder fruchtigen Cocktails abheben. Herb macht Cocktails zu einem unvergesslichen Erlebnis, das sowohl Neulinge als auch erfahrene Kenner begeistert','fa-duotone fa-seedling',11,0),(19,_binary '','2025-01-01 00:00:00','2025-01-08 23:42:27',0,'erfrischend','Der Geschmack \"erfrischend\" in Cocktails vermittelt ein Gefühl von Leichtigkeit und Lebendigkeit. Zutaten wie Zitrusfrüchte, frische Kräuter und sprudelnde Limonaden tragen dazu bei, eine belebende Wirkung zu erzeugen. Klassiker wie der Mojito oder der Gin Fizz sind perfekte Beispiele für erfrischende Cocktails, die an heißen Tagen Genuss und Erfrischung bieten. Diese Drinks sind ideal, um Durst zu stillen und gute Laune zu verbreiten. Durch den Einsatz von Eis und frischen Zutaten entsteht ein belebendes Trinkerlebnis, das den Gaumen kitzelt. Erfrischende Cocktails sind vielseitig und eignen sich sowohl für gesellige Anlässe als auch für entspannende Abende. Sie laden dazu ein, neue Geschmackskombinationen zu erkunden und die Vielfalt der Mixologie zu genießen','fa-duotone fa-bottle-water',26,50),(20,_binary '','2025-01-01 00:00:00','2025-01-08 23:38:10',0,'bittersüß','Der Geschmack \"bittersüß\" in Cocktails vereint die Gegensätze von Süße und Bitterkeit zu einem faszinierenden Geschmackserlebnis. Diese Balance schafft Komplexität und Tiefe, die viele Drinks besonders macht. Zutaten wie Amaro, Aperitifs und bestimmte Liköre wie Campari oder Aperol sind zentrale Akteure in bittersüßen Cocktails. Drinks wie der Negroni oder der Boulevardier zeigen, wie harmonisch diese Geschmäcker zusammenarbeiten können. Diese Kombination spricht sowohl Liebhaber süßer als auch herber Aromen an und eignet sich hervorragend für gesellige Abende oder entspannte Cocktails. Bittersüße Cocktails laden dazu ein, neue Geschmacksebenen zu entdecken und die Vielfalt der Mixkunst zu erkunden. Sie sind ideal für diejenigen, die das Spiel der Aromen schätzen und sich gerne auf eine geschmackliche Reise begeben','fa-duotone fa-feather-pointed',13,0),(21,_binary '','2025-01-01 00:00:00','2025-01-08 23:40:18',0,'nussig','Der Geschmack \"nussig\" in Cocktails bringt eine warme, reichhaltige Dimension in die Mixologie. Nussige Aromen stammen häufig von Zutaten wie Nusslikören, Mandel- oder Haselnuss-Sirup und sogar von bestimmten Spirituosen wie Frangelico oder Amaretto. Diese Aromen verleihen Drinks wie dem Nutty Russian oder dem Amaretto Sour eine subtile Süße und Komplexität. Nussige Cocktails sind ideal für entspannte Abende, da sie oft mit Cremigkeit und einer angenehmen Textur harmonieren. Sie eignen sich perfekt für die kalte Jahreszeit oder besondere Anlässe, wenn man sich nach etwas Besonderem sehnt. Die nussige Note kann sowohl in klassischen als auch in modernen Rezepten glänzen und lädt dazu ein, die Vielfalt der Aromen zu entdecken','fa-duotone fa-chestnut',11,0),(22,_binary '','2025-01-08 18:15:54','2025-01-08 23:35:20',1,'rauchig','','fa-duotone fa-smog',6,0),(23,_binary '','2025-01-08 23:12:10','2025-01-08 23:35:48',1,'erdig','','fa-duotone fa-earth-europe',4,0),(24,_binary '','2025-01-08 23:12:47','2025-01-08 23:17:05',1,'blumig','','fa-duotone fa-flower',2,0),(25,_binary '','2025-01-08 23:13:48','2025-01-08 23:13:48',1,'holzig','','fa-duotone fa-tree',0,0);
/*!40000 ALTER TABLE `taste` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-13 13:31:37
