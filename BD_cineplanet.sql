CREATE DATABASE  IF NOT EXISTS `bd_cineplanet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bd_cineplanet`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bd_cineplanet
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `asientos`
--

DROP TABLE IF EXISTS `asientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asientos` (
  `id_asiento` int(11) NOT NULL AUTO_INCREMENT,
  `fila` varchar(5) DEFAULT NULL,
  `columna` int(11) DEFAULT NULL,
  `id_sala_cine` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asiento`),
  KEY `fk_asientos_salas_cine_id_sala_cine_idx` (`id_sala_cine`),
  KEY `fk_id_estado_idx` (`id_estado`),
  CONSTRAINT `fk_asientos_salas_cine_id_sala_cine` FOREIGN KEY (`id_sala_cine`) REFERENCES `salas_cine` (`id_sala_cine`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_estado` FOREIGN KEY (`id_estado`) REFERENCES `asientos_estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=961 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asientos`
--

LOCK TABLES `asientos` WRITE;
/*!40000 ALTER TABLE `asientos` DISABLE KEYS */;
INSERT INTO `asientos` VALUES (1,'A',1,3,1),(2,'A',2,3,1),(3,'A',3,3,1),(4,'A',4,3,1),(5,'A',5,3,1),(6,'A',6,3,1),(7,'A',7,3,1),(8,'A',8,3,1),(9,'A',9,3,1),(10,'A',10,3,1),(11,'B',1,3,1),(12,'B',2,3,1),(13,'B',3,3,1),(14,'B',4,3,1),(15,'B',5,3,1),(16,'B',6,3,1),(17,'B',7,3,1),(18,'B',8,3,1),(19,'B',9,3,1),(20,'B',10,3,1),(21,'C',1,3,1),(22,'C',2,3,1),(23,'C',3,3,1),(24,'C',4,3,1),(25,'C',5,3,1),(26,'C',6,3,1),(27,'C',7,3,1),(28,'C',8,3,1),(29,'C',9,3,1),(30,'C',10,3,1),(31,'D',1,3,1),(32,'D',2,3,1),(33,'D',3,3,1),(34,'D',4,3,1),(35,'D',5,3,1),(36,'D',6,3,1),(37,'D',7,3,1),(38,'D',8,3,1),(39,'D',9,3,1),(40,'D',10,3,1),(41,'E',1,3,1),(42,'E',2,3,1),(43,'E',3,3,1),(44,'E',4,3,1),(45,'E',5,3,1),(46,'E',6,3,1),(47,'E',7,3,1),(48,'E',8,3,1),(49,'E',9,3,1),(50,'E',10,3,1),(51,'F',1,3,1),(52,'F',2,3,1),(53,'F',3,3,1),(54,'F',4,3,1),(55,'F',5,3,1),(56,'F',6,3,1),(57,'F',7,3,1),(58,'F',8,3,1),(59,'F',9,3,1),(60,'F',10,3,1),(61,'G',1,3,1),(62,'G',2,3,1),(63,'G',3,3,1),(64,'G',4,3,1),(65,'G',5,3,1),(66,'G',6,3,1),(67,'G',7,3,1),(68,'G',8,3,1),(69,'G',9,3,1),(70,'G',10,3,1),(71,'H',1,3,1),(72,'H',2,3,1),(73,'H',3,3,1),(74,'H',4,3,1),(75,'H',5,3,1),(76,'H',6,3,1),(77,'H',7,3,1),(78,'H',8,3,1),(79,'H',9,3,1),(80,'H',10,3,1),(81,'A',1,1,2),(82,'A',2,1,2),(83,'A',3,1,2),(84,'A',4,1,2),(85,'A',5,1,1),(86,'A',6,1,1),(87,'A',7,1,1),(88,'A',8,1,1),(89,'A',9,1,1),(90,'A',10,1,2),(91,'B',1,1,2),(92,'B',2,1,2),(93,'B',3,1,1),(94,'B',4,1,1),(95,'B',5,1,1),(96,'B',6,1,1),(97,'B',7,1,1),(98,'B',8,1,1),(99,'B',9,1,1),(100,'B',10,1,2),(101,'C',1,1,1),(102,'C',2,1,1),(103,'C',3,1,1),(104,'C',4,1,1),(105,'C',5,1,1),(106,'C',6,1,2),(107,'C',7,1,1),(108,'C',8,1,1),(109,'C',9,1,1),(110,'C',10,1,1),(111,'D',1,1,2),(112,'D',2,1,2),(113,'D',3,1,2),(114,'D',4,1,1),(115,'D',5,1,1),(116,'D',6,1,2),(117,'D',7,1,1),(118,'D',8,1,1),(119,'D',9,1,1),(120,'D',10,1,1),(121,'E',1,1,1),(122,'E',2,1,1),(123,'E',3,1,1),(124,'E',4,1,1),(125,'E',5,1,1),(126,'E',6,1,2),(127,'E',7,1,1),(128,'E',8,1,1),(129,'E',9,1,1),(130,'E',10,1,1),(131,'F',1,1,1),(132,'F',2,1,1),(133,'F',3,1,1),(134,'F',4,1,2),(135,'F',5,1,1),(136,'F',6,1,1),(137,'F',7,1,1),(138,'F',8,1,1),(139,'F',9,1,1),(140,'F',10,1,1),(141,'G',1,1,1),(142,'G',2,1,1),(143,'G',3,1,1),(144,'G',4,1,1),(145,'G',5,1,1),(146,'G',6,1,2),(147,'G',7,1,1),(148,'G',8,1,1),(149,'G',9,1,1),(150,'G',10,1,1),(151,'H',1,1,2),(152,'H',2,1,2),(153,'H',3,1,2),(154,'H',4,1,1),(155,'H',5,1,1),(156,'H',6,1,1),(157,'H',7,1,1),(158,'H',8,1,2),(159,'H',9,1,2),(160,'H',10,1,2),(161,'A',1,4,1),(162,'A',2,4,1),(163,'A',3,4,1),(164,'A',4,4,1),(165,'A',5,4,1),(166,'A',6,4,1),(167,'A',7,4,1),(168,'A',8,4,1),(169,'A',9,4,1),(170,'A',10,4,1),(171,'B',1,4,1),(172,'B',2,4,1),(173,'B',3,4,1),(174,'B',4,4,1),(175,'B',5,4,1),(176,'B',6,4,1),(177,'B',7,4,1),(178,'B',8,4,1),(179,'B',9,4,1),(180,'B',10,4,1),(181,'C',1,4,1),(182,'C',2,4,1),(183,'C',3,4,1),(184,'C',4,4,1),(185,'C',5,4,1),(186,'C',6,4,1),(187,'C',7,4,1),(188,'C',8,4,1),(189,'C',9,4,1),(190,'C',10,4,1),(191,'D',1,4,1),(192,'D',2,4,1),(193,'D',3,4,1),(194,'D',4,4,1),(195,'D',5,4,1),(196,'D',6,4,1),(197,'D',7,4,1),(198,'D',8,4,1),(199,'D',9,4,1),(200,'D',10,4,1),(201,'E',1,4,1),(202,'E',2,4,1),(203,'E',3,4,1),(204,'E',4,4,1),(205,'E',5,4,1),(206,'E',6,4,1),(207,'E',7,4,1),(208,'E',8,4,1),(209,'E',9,4,1),(210,'E',10,4,1),(211,'F',1,4,1),(212,'F',2,4,1),(213,'F',3,4,1),(214,'F',4,4,1),(215,'F',5,4,1),(216,'F',6,4,1),(217,'F',7,4,1),(218,'F',8,4,1),(219,'F',9,4,1),(220,'F',10,4,1),(221,'G',1,4,1),(222,'G',2,4,1),(223,'G',3,4,1),(224,'G',4,4,1),(225,'G',5,4,1),(226,'G',6,4,1),(227,'G',7,4,1),(228,'G',8,4,1),(229,'G',9,4,1),(230,'G',10,4,1),(231,'H',1,4,1),(232,'H',2,4,1),(233,'H',3,4,1),(234,'H',4,4,1),(235,'H',5,4,1),(236,'H',6,4,1),(237,'H',7,4,1),(238,'H',8,4,1),(239,'H',9,4,1),(240,'H',10,4,1),(241,'A',1,7,2),(242,'A',2,7,1),(243,'A',3,7,1),(244,'A',4,7,2),(245,'A',5,7,1),(246,'A',6,7,1),(247,'A',7,7,1),(248,'A',8,7,1),(249,'A',9,7,1),(250,'A',10,7,1),(251,'B',1,7,1),(252,'B',2,7,1),(253,'B',3,7,1),(254,'B',4,7,1),(255,'B',5,7,1),(256,'B',6,7,1),(257,'B',7,7,1),(258,'B',8,7,1),(259,'B',9,7,1),(260,'B',10,7,1),(261,'C',1,7,1),(262,'C',2,7,1),(263,'C',3,7,1),(264,'C',4,7,1),(265,'C',5,7,1),(266,'C',6,7,2),(267,'C',7,7,1),(268,'C',8,7,1),(269,'C',9,7,1),(270,'C',10,7,1),(271,'D',1,7,1),(272,'D',2,7,1),(273,'D',3,7,1),(274,'D',4,7,1),(275,'D',5,7,1),(276,'D',6,7,2),(277,'D',7,7,1),(278,'D',8,7,1),(279,'D',9,7,1),(280,'D',10,7,1),(281,'E',1,7,1),(282,'E',2,7,1),(283,'E',3,7,1),(284,'E',4,7,1),(285,'E',5,7,1),(286,'E',6,7,2),(287,'E',7,7,1),(288,'E',8,7,1),(289,'E',9,7,1),(290,'E',10,7,1),(291,'F',1,7,1),(292,'F',2,7,1),(293,'F',3,7,1),(294,'F',4,7,1),(295,'F',5,7,1),(296,'F',6,7,1),(297,'F',7,7,1),(298,'F',8,7,1),(299,'F',9,7,1),(300,'F',10,7,1),(301,'G',1,7,1),(302,'G',2,7,1),(303,'G',3,7,1),(304,'G',4,7,1),(305,'G',5,7,1),(306,'G',6,7,1),(307,'G',7,7,1),(308,'G',8,7,1),(309,'G',9,7,1),(310,'G',10,7,1),(311,'H',1,7,1),(312,'H',2,7,1),(313,'H',3,7,1),(314,'H',4,7,1),(315,'H',5,7,1),(316,'H',6,7,1),(317,'H',7,7,1),(318,'H',8,7,1),(319,'H',9,7,1),(320,'H',10,7,1),(321,'A',1,2,1),(322,'A',2,2,1),(323,'A',3,2,1),(324,'A',4,2,1),(325,'A',5,2,1),(326,'A',6,2,1),(327,'A',7,2,1),(328,'A',8,2,1),(329,'A',9,2,1),(330,'A',10,2,1),(331,'B',1,2,1),(332,'B',2,2,1),(333,'B',3,2,1),(334,'B',4,2,1),(335,'B',5,2,1),(336,'B',6,2,1),(337,'B',7,2,1),(338,'B',8,2,1),(339,'B',9,2,1),(340,'B',10,2,1),(341,'C',1,2,1),(342,'C',2,2,1),(343,'C',3,2,1),(344,'C',4,2,1),(345,'C',5,2,1),(346,'C',6,2,1),(347,'C',7,2,1),(348,'C',8,2,1),(349,'C',9,2,1),(350,'C',10,2,1),(351,'D',1,2,1),(352,'D',2,2,1),(353,'D',3,2,1),(354,'D',4,2,1),(355,'D',5,2,1),(356,'D',6,2,1),(357,'D',7,2,1),(358,'D',8,2,1),(359,'D',9,2,1),(360,'D',10,2,1),(361,'E',1,2,1),(362,'E',2,2,1),(363,'E',3,2,1),(364,'E',4,2,1),(365,'E',5,2,1),(366,'E',6,2,1),(367,'E',7,2,1),(368,'E',8,2,1),(369,'E',9,2,1),(370,'E',10,2,1),(371,'F',1,2,1),(372,'F',2,2,1),(373,'F',3,2,1),(374,'F',4,2,1),(375,'F',5,2,1),(376,'F',6,2,1),(377,'F',7,2,1),(378,'F',8,2,1),(379,'F',9,2,1),(380,'F',10,2,1),(381,'G',1,2,1),(382,'G',2,2,1),(383,'G',3,2,1),(384,'G',4,2,1),(385,'G',5,2,1),(386,'G',6,2,1),(387,'G',7,2,1),(388,'G',8,2,1),(389,'G',9,2,1),(390,'G',10,2,1),(391,'H',1,2,1),(392,'H',2,2,1),(393,'H',3,2,1),(394,'H',4,2,1),(395,'H',5,2,1),(396,'H',6,2,1),(397,'H',7,2,1),(398,'H',8,2,1),(399,'H',9,2,1),(400,'H',10,2,1),(401,'A',1,5,1),(402,'A',2,5,1),(403,'A',3,5,1),(404,'A',4,5,1),(405,'A',5,5,1),(406,'A',6,5,1),(407,'A',7,5,1),(408,'A',8,5,1),(409,'A',9,5,1),(410,'A',10,5,1),(411,'B',1,5,1),(412,'B',2,5,1),(413,'B',3,5,1),(414,'B',4,5,1),(415,'B',5,5,1),(416,'B',6,5,1),(417,'B',7,5,1),(418,'B',8,5,1),(419,'B',9,5,1),(420,'B',10,5,1),(421,'C',1,5,1),(422,'C',2,5,1),(423,'C',3,5,1),(424,'C',4,5,1),(425,'C',5,5,1),(426,'C',6,5,1),(427,'C',7,5,1),(428,'C',8,5,1),(429,'C',9,5,1),(430,'C',10,5,1),(431,'D',1,5,1),(432,'D',2,5,1),(433,'D',3,5,1),(434,'D',4,5,1),(435,'D',5,5,1),(436,'D',6,5,1),(437,'D',7,5,1),(438,'D',8,5,1),(439,'D',9,5,1),(440,'D',10,5,1),(441,'E',1,5,1),(442,'E',2,5,1),(443,'E',3,5,1),(444,'E',4,5,1),(445,'E',5,5,1),(446,'E',6,5,1),(447,'E',7,5,1),(448,'E',8,5,1),(449,'E',9,5,1),(450,'E',10,5,1),(451,'F',1,5,1),(452,'F',2,5,1),(453,'F',3,5,1),(454,'F',4,5,1),(455,'F',5,5,1),(456,'F',6,5,1),(457,'F',7,5,1),(458,'F',8,5,1),(459,'F',9,5,1),(460,'F',10,5,1),(461,'G',1,5,1),(462,'G',2,5,1),(463,'G',3,5,1),(464,'G',4,5,1),(465,'G',5,5,1),(466,'G',6,5,1),(467,'G',7,5,1),(468,'G',8,5,1),(469,'G',9,5,1),(470,'G',10,5,1),(471,'H',1,5,1),(472,'H',2,5,1),(473,'H',3,5,1),(474,'H',4,5,1),(475,'H',5,5,1),(476,'H',6,5,1),(477,'H',7,5,1),(478,'H',8,5,1),(479,'H',9,5,1),(480,'H',10,5,1),(481,'A',1,6,1),(482,'A',2,6,1),(483,'A',3,6,1),(484,'A',4,6,1),(485,'A',5,6,1),(486,'A',6,6,1),(487,'A',7,6,1),(488,'A',8,6,1),(489,'A',9,6,1),(490,'A',10,6,1),(491,'B',1,6,1),(492,'B',2,6,1),(493,'B',3,6,1),(494,'B',4,6,1),(495,'B',5,6,1),(496,'B',6,6,1),(497,'B',7,6,1),(498,'B',8,6,1),(499,'B',9,6,1),(500,'B',10,6,1),(501,'C',1,6,1),(502,'C',2,6,1),(503,'C',3,6,1),(504,'C',4,6,1),(505,'C',5,6,1),(506,'C',6,6,1),(507,'C',7,6,1),(508,'C',8,6,1),(509,'C',9,6,1),(510,'C',10,6,1),(511,'D',1,6,1),(512,'D',2,6,1),(513,'D',3,6,1),(514,'D',4,6,1),(515,'D',5,6,1),(516,'D',6,6,1),(517,'D',7,6,1),(518,'D',8,6,1),(519,'D',9,6,1),(520,'D',10,6,1),(521,'E',1,6,1),(522,'E',2,6,1),(523,'E',3,6,1),(524,'E',4,6,1),(525,'E',5,6,1),(526,'E',6,6,1),(527,'E',7,6,1),(528,'E',8,6,1),(529,'E',9,6,1),(530,'E',10,6,1),(531,'F',1,6,1),(532,'F',2,6,1),(533,'F',3,6,1),(534,'F',4,6,1),(535,'F',5,6,1),(536,'F',6,6,1),(537,'F',7,6,1),(538,'F',8,6,1),(539,'F',9,6,1),(540,'F',10,6,1),(541,'G',1,6,1),(542,'G',2,6,1),(543,'G',3,6,1),(544,'G',4,6,1),(545,'G',5,6,1),(546,'G',6,6,1),(547,'G',7,6,1),(548,'G',8,6,1),(549,'G',9,6,1),(550,'G',10,6,1),(551,'H',1,6,1),(552,'H',2,6,1),(553,'H',3,6,1),(554,'H',4,6,1),(555,'H',5,6,1),(556,'H',6,6,1),(557,'H',7,6,1),(558,'H',8,6,1),(559,'H',9,6,1),(560,'H',10,6,1),(721,'A',1,8,2),(722,'A',2,8,2),(723,'A',3,8,1),(724,'A',4,8,1),(725,'A',5,8,1),(726,'A',6,8,1),(727,'A',7,8,1),(728,'A',8,8,1),(729,'A',9,8,1),(730,'A',10,8,1),(731,'B',1,8,1),(732,'B',2,8,1),(733,'B',3,8,1),(734,'B',4,8,1),(735,'B',5,8,1),(736,'B',6,8,1),(737,'B',7,8,1),(738,'B',8,8,1),(739,'B',9,8,1),(740,'B',10,8,1),(741,'C',1,8,1),(742,'C',2,8,1),(743,'C',3,8,1),(744,'C',4,8,1),(745,'C',5,8,1),(746,'C',6,8,1),(747,'C',7,8,1),(748,'C',8,8,1),(749,'C',9,8,1),(750,'C',10,8,1),(751,'D',1,8,1),(752,'D',2,8,1),(753,'D',3,8,1),(754,'D',4,8,1),(755,'D',5,8,1),(756,'D',6,8,1),(757,'D',7,8,1),(758,'D',8,8,1),(759,'D',9,8,1),(760,'D',10,8,1),(761,'E',1,8,1),(762,'E',2,8,1),(763,'E',3,8,1),(764,'E',4,8,1),(765,'E',5,8,1),(766,'E',6,8,1),(767,'E',7,8,1),(768,'E',8,8,1),(769,'E',9,8,1),(770,'E',10,8,1),(771,'F',1,8,1),(772,'F',2,8,1),(773,'F',3,8,1),(774,'F',4,8,1),(775,'F',5,8,1),(776,'F',6,8,1),(777,'F',7,8,1),(778,'F',8,8,1),(779,'F',9,8,1),(780,'F',10,8,1),(781,'G',1,8,1),(782,'G',2,8,1),(783,'G',3,8,1),(784,'G',4,8,1),(785,'G',5,8,1),(786,'G',6,8,1),(787,'G',7,8,1),(788,'G',8,8,1),(789,'G',9,8,1),(790,'G',10,8,1),(791,'H',1,8,1),(792,'H',2,8,1),(793,'H',3,8,1),(794,'H',4,8,1),(795,'H',5,8,1),(796,'H',6,8,1),(797,'H',7,8,1),(798,'H',8,8,1),(799,'H',9,8,1),(800,'H',10,8,1),(801,'A',1,9,1),(802,'A',2,9,1),(803,'A',3,9,1),(804,'A',4,9,1),(805,'A',5,9,1),(806,'A',6,9,1),(807,'A',7,9,1),(808,'A',8,9,1),(809,'A',9,9,1),(810,'A',10,9,1),(811,'B',1,9,1),(812,'B',2,9,1),(813,'B',3,9,1),(814,'B',4,9,1),(815,'B',5,9,1),(816,'B',6,9,1),(817,'B',7,9,1),(818,'B',8,9,1),(819,'B',9,9,1),(820,'B',10,9,1),(821,'C',1,9,1),(822,'C',2,9,1),(823,'C',3,9,1),(824,'C',4,9,1),(825,'C',5,9,1),(826,'C',6,9,1),(827,'C',7,9,1),(828,'C',8,9,1),(829,'C',9,9,1),(830,'C',10,9,1),(831,'D',1,9,1),(832,'D',2,9,1),(833,'D',3,9,1),(834,'D',4,9,1),(835,'D',5,9,1),(836,'D',6,9,1),(837,'D',7,9,1),(838,'D',8,9,1),(839,'D',9,9,1),(840,'D',10,9,1),(841,'E',1,9,1),(842,'E',2,9,1),(843,'E',3,9,1),(844,'E',4,9,1),(845,'E',5,9,1),(846,'E',6,9,1),(847,'E',7,9,1),(848,'E',8,9,1),(849,'E',9,9,1),(850,'E',10,9,1),(851,'F',1,9,1),(852,'F',2,9,1),(853,'F',3,9,1),(854,'F',4,9,1),(855,'F',5,9,1),(856,'F',6,9,1),(857,'F',7,9,1),(858,'F',8,9,1),(859,'F',9,9,1),(860,'F',10,9,1),(861,'G',1,9,1),(862,'G',2,9,1),(863,'G',3,9,1),(864,'G',4,9,1),(865,'G',5,9,1),(866,'G',6,9,1),(867,'G',7,9,1),(868,'G',8,9,1),(869,'G',9,9,1),(870,'G',10,9,1),(871,'H',1,9,1),(872,'H',2,9,1),(873,'H',3,9,1),(874,'H',4,9,1),(875,'H',5,9,1),(876,'H',6,9,1),(877,'H',7,9,1),(878,'H',8,9,1),(879,'H',9,9,1),(880,'H',10,9,1),(881,'A',1,10,1),(882,'A',2,10,1),(883,'A',3,10,1),(884,'A',4,10,1),(885,'A',5,10,1),(886,'A',6,10,1),(887,'A',7,10,1),(888,'A',8,10,1),(889,'A',9,10,1),(890,'A',10,10,1),(891,'B',1,10,1),(892,'B',2,10,1),(893,'B',3,10,1),(894,'B',4,10,1),(895,'B',5,10,1),(896,'B',6,10,1),(897,'B',7,10,1),(898,'B',8,10,1),(899,'B',9,10,1),(900,'B',10,10,1),(901,'C',1,10,1),(902,'C',2,10,1),(903,'C',3,10,1),(904,'C',4,10,1),(905,'C',5,10,1),(906,'C',6,10,1),(907,'C',7,10,1),(908,'C',8,10,1),(909,'C',9,10,1),(910,'C',10,10,1),(911,'D',1,10,1),(912,'D',2,10,1),(913,'D',3,10,1),(914,'D',4,10,1),(915,'D',5,10,1),(916,'D',6,10,1),(917,'D',7,10,1),(918,'D',8,10,1),(919,'D',9,10,1),(920,'D',10,10,1),(921,'E',1,10,1),(922,'E',2,10,1),(923,'E',3,10,1),(924,'E',4,10,1),(925,'E',5,10,1),(926,'E',6,10,1),(927,'E',7,10,1),(928,'E',8,10,1),(929,'E',9,10,1),(930,'E',10,10,1),(931,'F',1,10,1),(932,'F',2,10,1),(933,'F',3,10,1),(934,'F',4,10,1),(935,'F',5,10,1),(936,'F',6,10,1),(937,'F',7,10,1),(938,'F',8,10,1),(939,'F',9,10,1),(940,'F',10,10,1),(941,'G',1,10,1),(942,'G',2,10,1),(943,'G',3,10,1),(944,'G',4,10,1),(945,'G',5,10,1),(946,'G',6,10,1),(947,'G',7,10,1),(948,'G',8,10,1),(949,'G',9,10,1),(950,'G',10,10,1),(951,'H',1,10,1),(952,'H',2,10,1),(953,'H',3,10,1),(954,'H',4,10,1),(955,'H',5,10,1),(956,'H',6,10,1),(957,'H',7,10,1),(958,'H',8,10,1),(959,'H',9,10,1),(960,'H',10,10,1);
/*!40000 ALTER TABLE `asientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asientos_estados`
--

DROP TABLE IF EXISTS `asientos_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asientos_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado_nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asientos_estados`
--

LOCK TABLES `asientos_estados` WRITE;
/*!40000 ALTER TABLE `asientos_estados` DISABLE KEYS */;
INSERT INTO `asientos_estados` VALUES (1,'libre'),(2,'ocupado');
/*!40000 ALTER TABLE `asientos_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cines`
--

DROP TABLE IF EXISTS `cines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cines` (
  `id_cine` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cine`),
  KEY `fk_cines_ciudades_idx` (`id_ciudad`),
  CONSTRAINT `fk_cines_ciudades` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cines`
--

LOCK TABLES `cines` WRITE;
/*!40000 ALTER TABLE `cines` DISABLE KEYS */;
INSERT INTO `cines` VALUES (1,'Cineplanet Alcázar','Av. Pardo y Aliaga 640, Miraflores',1),(2,'Cineplanet San Miguel','C.C. Plaza San Miguel, Lima',1),(3,'Cineplanet Primavera','C.C. Primavera Park Plaza, Lima',1),(4,'Cineplanet Arequipa Mall Aventura','Mall Aventura Porongoche',2),(5,'Cineplanet Trujillo Real Plaza','Real Plaza Trujillo',3),(6,'Cineplanet Chiclayo Real Plaza','Real Plaza Chiclayo',4),(7,'Cineplanet Piura Plaza del Sol','C.C. Plaza del Sol Piura',5),(8,'Cineplanet Ica','C.C. El Quinde Ica',6),(9,'Cineplanet Huancayo Open Plaza','Open Plaza Huancayo',7),(10,'Cineplanet Cusco Real Plaza','Real Plaza Cusco',8),(11,'Cineplanet Pucallpa','C.C. Open Plaza Pucallpa',9),(12,'Cineplanet Tacna','Mall Plaza Tacna',10);
/*!40000 ALTER TABLE `cines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cines_productos`
--

DROP TABLE IF EXISTS `cines_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cines_productos` (
  `id_cine` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_cine`,`id_producto`),
  KEY `fk_cines_productos_productos_idx` (`id_producto`),
  CONSTRAINT `fk_cines_productos_cines` FOREIGN KEY (`id_cine`) REFERENCES `cines` (`id_cine`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cines_productos_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cines_productos`
--

LOCK TABLES `cines_productos` WRITE;
/*!40000 ALTER TABLE `cines_productos` DISABLE KEYS */;
INSERT INTO `cines_productos` VALUES (1,1,50),(1,2,45),(1,3,40),(1,5,60),(1,6,55),(1,8,70),(1,9,30),(1,11,25),(1,12,20),(1,15,35),(1,18,40),(1,20,22),(2,2,40),(2,3,35),(2,4,50),(2,7,45),(2,9,55),(2,10,60),(2,12,25),(2,14,30),(2,16,35),(2,17,28),(2,19,20),(2,22,25),(3,1,55),(3,3,50),(3,5,60),(3,6,65),(3,7,40),(3,8,35),(3,11,30),(3,13,25),(3,15,45),(3,18,50),(3,19,20),(3,21,22),(4,2,48),(4,4,50),(4,5,52),(4,7,60),(4,9,40),(4,10,30),(4,12,35),(4,14,25),(4,16,45),(4,18,38),(4,20,40),(4,22,28),(5,1,55),(5,3,50),(5,4,40),(5,6,60),(5,8,70),(5,9,30),(5,11,25),(5,13,20),(5,15,35),(5,17,45),(5,19,22),(5,21,26),(6,2,48),(6,4,42),(6,5,55),(6,7,60),(6,9,35),(6,10,28),(6,12,32),(6,14,24),(6,16,38),(6,18,44),(6,20,50),(6,22,30),(12,1,50),(12,2,60),(12,3,80);
/*!40000 ALTER TABLE `cines_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Lima'),(2,'Arequipa'),(3,'Trujillo'),(4,'Chiclayo'),(5,'Piura'),(6,'Ica'),(7,'Huancayo'),(8,'Cusco'),(9,'Pucallpa'),(10,'Tacna');
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'78254174','Guillermo','Cutipa','guillermocut@gmail.com'),(2,'12345678','Juan','Pérez','juanper@gmail.com'),(3,'23456789','María','García','mariagar@gmail.com'),(4,'34567890','Luis','Fernández','luisfer@gmail.com'),(5,'45678901','Ana','Martínez','anamar@gmail.com'),(6,'56789012','Pedro','Rodríguez','pedrorod@gmail.com'),(7,'67890123','Laura','López','lauralop@gmail.com'),(8,'78901234','Carlos','Gómez','carlosgom@gmail.com'),(9,'89012345','Sofía','Díaz','sofiadia@gmail.com'),(10,'90123456','Diego','Torres','diegotor@gmail.com'),(11,'01234567','Lucía','Sánchez','luciasan@gmail.com'),(12,'11223344','José','Ramírez','joseram@gmail.com'),(13,'22334455','Elena','Morales','elenamor@gmail.com');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_boletos`
--

DROP TABLE IF EXISTS `detalles_boletos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalles_boletos` (
  `id_detalle_boleto` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcion` int(11) NOT NULL,
  `id_asiento` int(11) NOT NULL,
  `tipo` enum('General','Niño','Adulto Mayor') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_venta_boleto` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_boleto`),
  KEY `fk_funciones_detalles_boletos` (`id_funcion`),
  KEY `fk_asientos_detalles_boletos` (`id_asiento`),
  KEY `fk_detalles_boletos_venta` (`id_venta_boleto`),
  CONSTRAINT `fk_asientos_detalles_boletos` FOREIGN KEY (`id_asiento`) REFERENCES `asientos` (`id_asiento`),
  CONSTRAINT `fk_detalles_boletos_venta` FOREIGN KEY (`id_venta_boleto`) REFERENCES `ventas_boletos` (`id_venta_boleto`),
  CONSTRAINT `fk_funciones_detalles_boletos` FOREIGN KEY (`id_funcion`) REFERENCES `funciones` (`id_funcion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_boletos`
--

LOCK TABLES `detalles_boletos` WRITE;
/*!40000 ALTER TABLE `detalles_boletos` DISABLE KEYS */;
INSERT INTO `detalles_boletos` VALUES (1,24,91,'General',20.00,1),(2,24,92,'Adulto Mayor',20.00,1),(3,24,90,'General',20.00,3),(4,24,100,'Niño',20.00,3),(5,24,83,'General',20.00,5),(6,24,84,'General',20.00,5),(7,24,151,'General',20.00,6),(8,24,152,'Adulto Mayor',20.00,6),(9,24,153,'Niño',20.00,6),(10,24,111,'General',20.00,7),(11,24,112,'Adulto Mayor',12.00,7),(12,24,113,'Niño',10.00,7),(13,24,146,'Adulto Mayor',12.00,8),(14,24,106,'General',20.00,9),(15,24,116,'General',20.00,9),(16,24,126,'General',20.00,9),(17,24,158,'General',20.00,10),(18,24,159,'General',20.00,10),(19,24,160,'Niño',10.00,10),(20,24,134,'Adulto Mayor',12.00,11);
/*!40000 ALTER TABLE `detalles_boletos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_productos`
--

DROP TABLE IF EXISTS `detalles_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalles_productos` (
  `id_detalle_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `id_venta_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_producto`),
  KEY `fk_productos_detalles_productos` (`id_producto`),
  KEY `fk_detalles_productos_venta` (`id_venta_producto`),
  CONSTRAINT `fk_detalles_productos_venta` FOREIGN KEY (`id_venta_producto`) REFERENCES `ventas_productos` (`id_venta_producto`),
  CONSTRAINT `fk_productos_detalles_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_productos`
--

LOCK TABLES `detalles_productos` WRITE;
/*!40000 ALTER TABLE `detalles_productos` DISABLE KEYS */;
INSERT INTO `detalles_productos` VALUES (2,1,1,17.00,17.00,1),(3,2,1,25.00,25.00,1),(4,3,1,29.00,29.00,1),(5,4,1,21.00,21.00,1),(6,5,1,14.00,14.00,1),(7,6,1,12.00,12.00,1),(8,7,1,19.00,19.00,1),(9,8,1,22.00,22.00,1),(10,9,1,15.00,15.00,1),(11,10,1,17.00,17.00,1),(12,11,1,18.00,18.00,1),(14,1,1,17.00,17.00,3),(15,2,1,25.00,25.00,3),(16,3,1,29.00,29.00,3),(17,4,1,21.00,21.00,3),(18,5,1,14.00,14.00,3),(19,6,1,12.00,12.00,3),(20,7,1,19.00,19.00,3),(21,8,1,22.00,22.00,3),(22,9,1,15.00,15.00,3),(23,10,1,17.00,17.00,3),(24,11,1,18.00,18.00,3),(25,1,2,17.00,34.00,5),(26,11,1,18.00,18.00,5),(27,2,1,25.00,25.00,6),(28,6,1,12.00,12.00,6),(29,12,2,15.00,30.00,6),(30,11,3,18.00,54.00,7),(31,20,1,35.00,35.00,7),(32,11,1,18.00,18.00,8),(33,15,1,52.00,52.00,8),(34,12,3,15.00,45.00,9);
/*!40000 ALTER TABLE `detalles_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_cine` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `fk_id_cine_idx` (`id_cine`),
  KEY `fk_rol_empleados` (`id_rol`),
  CONSTRAINT `fk_id_cine` FOREIGN KEY (`id_cine`) REFERENCES `cines` (`id_cine`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_rol_empleados` FOREIGN KEY (`id_rol`) REFERENCES `rol_empleados` (`id_rol_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Juan','Peralta','74565258',1,'2004-07-05',10),(3,'Andrés','Mendoza','87654321',1,'1990-05-12',1),(4,'Camila','Rojas','98765432',2,'1988-03-22',2),(5,'Mateo','Silva','76543210',1,'1992-11-05',3),(6,'Valentina','Romero','65432109',3,'1995-07-17',1),(7,'Sebastián','Castro','54321098',2,'1985-02-09',4),(8,'Martina','Herrera','43210987',1,'1991-12-01',2),(9,'Emilio','Ortega','32109876',3,'1987-04-15',5),(10,'Renata','Vega','21098765',2,'1993-09-30',3),(11,'Tomás','Flores','10987654',1,'1990-06-21',6),(12,'Paula','Morales','99887766',3,'1994-08-11',4);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funciones`
--

DROP TABLE IF EXISTS `funciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funciones` (
  `id_funcion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `formato` enum('2D','3D') NOT NULL,
  `version_idioma` enum('Subtitulada','Doblada','Original') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `id_sala_cine` int(11) DEFAULT NULL,
  `id_tipo_sala_cine` int(11) NOT NULL,
  PRIMARY KEY (`id_funcion`),
  KEY `fk_peliculas` (`id_pelicula`),
  KEY `fk_salas_cine` (`id_sala_cine`),
  KEY `fk_tipos_salas_cine_funciones` (`id_tipo_sala_cine`),
  CONSTRAINT `fk_peliculas` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`),
  CONSTRAINT `fk_salas_cine` FOREIGN KEY (`id_sala_cine`) REFERENCES `salas_cine` (`id_sala_cine`),
  CONSTRAINT `fk_tipos_salas_cine_funciones` FOREIGN KEY (`id_tipo_sala_cine`) REFERENCES `tipos_salas_cine` (`id_tipo_sala_cine`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funciones`
--

LOCK TABLES `funciones` WRITE;
/*!40000 ALTER TABLE `funciones` DISABLE KEYS */;
INSERT INTO `funciones` VALUES (1,'2025-07-12','18:00:00','2D','Doblada',20.50,1,1,1),(2,'2025-07-12','21:00:00','3D','Subtitulada',28.00,1,2,2),(3,'2025-07-12','19:00:00','2D','Doblada',18.00,2,4,1),(4,'2025-07-12','20:30:00','2D','Doblada',18.00,5,6,1),(5,'2025-07-13','22:00:00','2D','Subtitulada',25.00,3,7,3),(6,'2025-07-13','19:30:00','3D','Subtitulada',30.00,4,8,2),(7,'2025-07-13','18:30:00','2D','Original',22.00,6,9,1),(8,'2025-07-14','20:00:00','2D','Subtitulada',24.00,8,10,3),(9,'2025-07-14','19:00:00','2D','Doblada',19.50,7,11,1),(10,'2025-07-14','21:30:00','2D','Subtitulada',25.00,9,12,1),(11,'2025-07-20','20:40:00','3D','Doblada',25.00,1,1,1),(12,'2025-07-21','18:30:00','3D','Subtitulada',22.00,1,2,1),(13,'2025-07-22','17:00:00','2D','Original',18.00,1,3,2),(14,'2025-07-20','20:40:00','3D','Doblada',25.00,1,4,1),(15,'2025-07-23','19:15:00','2D','Subtitulada',20.00,1,5,2),(16,'2025-07-23','19:15:00','2D','Subtitulada',20.00,1,8,2),(17,'2013-07-23','19:50:00','3D','Original',25.00,1,9,1),(18,'2025-07-23','19:50:00','3D','Original',25.00,1,9,1),(19,'2025-07-15','19:30:00','2D','Subtitulada',25.00,11,1,2),(20,'2025-07-15','19:30:00','2D','Doblada',25.00,11,4,1),(21,'2025-07-16','19:00:00','3D','Doblada',22.00,11,7,1),(22,'2025-07-16','19:00:00','2D','Doblada',20.00,11,8,1),(23,'2025-07-16','17:00:00','2D','Doblada',20.00,11,8,1),(24,'2025-07-17','15:00:00','2D','Subtitulada',20.00,11,1,1),(25,'2025-07-17','15:00:00','3D','Doblada',25.00,11,2,1),(26,'2025-07-17','17:30:00','3D','Original',30.00,11,3,6),(27,'2025-07-17','17:30:00','2D','Original',18.00,11,4,1),(28,'2025-07-17','20:00:00','3D','Subtitulada',28.50,11,5,6),(29,'2025-07-17','20:00:00','2D','Doblada',19.50,11,6,1),(30,'2025-07-18','15:00:00','2D','Subtitulada',20.00,11,7,1),(31,'2025-07-18','17:30:00','3D','Doblada',25.00,11,8,1),(32,'2025-07-18','20:00:00','3D','Original',30.00,11,9,6),(33,'2025-07-18','22:30:00','2D','Original',18.00,11,10,1),(34,'2025-07-17','17:00:00','2D','Subtitulada',20.00,11,1,1),(35,'2025-07-17','17:00:00','3D','Doblada',25.00,11,2,1),(36,'2025-07-17','19:30:00','3D','Original',30.00,11,3,6),(37,'2025-07-17','19:30:00','2D','Original',18.00,11,4,1),(38,'2025-07-17','22:00:00','3D','Subtitulada',28.50,11,5,6),(39,'2025-07-17','22:00:00','2D','Doblada',19.50,11,6,1),(40,'2025-07-18','17:00:00','2D','Subtitulada',20.00,11,7,1),(41,'2025-07-18','19:30:00','3D','Doblada',25.00,11,8,1),(42,'2025-07-18','22:00:00','3D','Original',30.00,11,9,6),(43,'2025-07-18','20:30:00','2D','Original',18.00,11,10,1),(44,'2025-07-17','13:00:00','2D','Subtitulada',20.00,11,1,1),(45,'2025-07-17','13:00:00','3D','Doblada',25.00,11,2,1),(46,'2025-07-17','15:30:00','3D','Original',30.00,11,3,6),(47,'2025-07-17','15:30:00','2D','Original',18.00,11,4,1),(48,'2025-07-17','18:00:00','3D','Subtitulada',28.50,11,5,6),(49,'2025-07-17','18:00:00','2D','Doblada',19.50,11,6,1),(50,'2025-07-18','13:00:00','2D','Subtitulada',20.00,11,7,1),(51,'2025-07-18','15:30:00','3D','Doblada',25.00,11,8,1),(52,'2025-07-18','18:00:00','3D','Original',30.00,11,9,6),(53,'2025-07-18','18:30:00','2D','Original',18.00,11,10,1);
/*!40000 ALTER TABLE `funciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'Acción'),(2,'Aventura'),(3,'Animación'),(4,'Comedia'),(5,'Drama'),(6,'Terror'),(7,'Ciencia Ficción'),(8,'Romance'),(9,'Familiar'),(10,'Documental');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `clasificacion` varchar(45) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id_pelicula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculas`
--

LOCK TABLES `peliculas` WRITE;
/*!40000 ALTER TABLE `peliculas` DISABLE KEYS */;
INSERT INTO `peliculas` VALUES (1,'Guardianes de la Galaxia Vol. 3','02:30:00','+14 años','Los Guardianes se enfrentan a nuevos peligros para proteger la galaxia.'),(2,'Intensamente 2','01:50:00','APT','Riley enfrenta nuevas emociones en su adolescencia.'),(3,'Deadpool & Wolverine','02:10:00','+18 años','Deadpool y Wolverine se unen en una aventura irreverente.'),(4,'El Planeta de los Simios: Nuevo Reino','02:25:00','+14 años','Una nueva era de simios se levanta para dominar la Tierra.'),(5,'Mi Villano Favorito 4','01:35:00','APT','Gru y los minions regresan con una nueva misión divertida.'),(6,'Un Lugar en Silencio: Día Uno','01:55:00','+14 años','Precuela que revela el inicio de la invasión alienígena.'),(7,'Garfield: Fuera de Casa','01:40:00','ATP','Garfield se aventura fuera de casa y vive desastres hilarantes.'),(8,'Furiosa: Mad Max Saga','02:20:00','+16 años','La historia de Furiosa antes de Mad Max: Fury Road.'),(9,'La Monja 2','01:45:00','+16 años','La terrorífica monja demoníaca regresa con más horror.'),(10,'Civil War','02:00:00','+16 años','Un thriller distópico sobre una guerra civil moderna en EE. UU.'),(11,'Cómo entrenar a tu dragón','02:05:00','APT','En la isla de Berk, donde los vikingos y los dragones han sido enemigos por generaciones, Hipo se distingue. El ingenioso, pero olvidado, hijo del Jefe Estoico el Vasto, Hipo desafía siglos de tradición cuando hace amistad con Chimuelo, el temido dragón Furia Nocturna. Su vínculo inusual revela la verdadera naturaleza de los dragones, retando las fundaciones de la sociedad vikinga.');
/*!40000 ALTER TABLE `peliculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculas_generos`
--

DROP TABLE IF EXISTS `peliculas_generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculas_generos` (
  `id_pelicula` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  PRIMARY KEY (`id_pelicula`,`id_genero`),
  KEY `fk_peliculas_generos_idx` (`id_genero`),
  KEY `fk_generos_peliculas_idx` (`id_pelicula`),
  CONSTRAINT `fk_generos_peliculas` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peliculas_generos` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculas_generos`
--

LOCK TABLES `peliculas_generos` WRITE;
/*!40000 ALTER TABLE `peliculas_generos` DISABLE KEYS */;
INSERT INTO `peliculas_generos` VALUES (1,1),(1,2),(1,7),(2,3),(2,4),(2,9),(3,1),(3,4),(3,7),(4,1),(4,2),(4,7),(5,3),(5,4),(5,9),(6,1),(6,6),(7,3),(7,4),(7,9),(8,1),(8,2),(8,7),(9,6),(10,1),(10,5),(11,2),(11,3),(11,9);
/*!40000 ALTER TABLE `peliculas_generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_productos_productos_tipos_idx` (`id_tipo`),
  CONSTRAINT `fk_productos_productos_tipos` FOREIGN KEY (`id_tipo`) REFERENCES `productos_tipos` (`id_producto_tipo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Gaseosa Mediana Pepsi',17,2),(2,'Popcorn Gigante Salado',25,1),(3,'Popcorn Gigante Dulce',29,1),(4,'Gaseosa Grande Pepsi',21,2),(5,'Gaseosa Personal Pepsi',14,2),(6,'Agua Mineral San Luis 500ml',12,2),(7,'Popcorn Mediano Salado',19,1),(8,'Popcorn Mediano Dulce',22,1),(9,'Popcorn Personal Salado',15,1),(10,'Popcorn Personal Dulce',17,1),(11,'Nachos con Queso',18,5),(12,'Hot Dog Clásico',15,5),(13,'Chocolate Sublime',10,5),(14,'Galletas Oreo',8,5),(15,'Combo Pareja (2 Popcorn Medianos + 2 Gaseosas Grandes)',52,4),(16,'Combo Familiar (1 Popcorn Gigante + 3 Gaseosas Grandes)',70,4),(17,'Combo Personal (1 Popcorn Personal + 1 Gaseosa Personal)',25,4),(18,'Promo Lunes 2x1 Popcorn Gigante',29,6),(19,'Promo Entrada + Popcorn Mediano',40,6),(20,'Vaso Coleccionable Avengers',35,3),(21,'Llavero Cineplanet',12,3),(22,'Polera Cineplanet',60,3);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_tipos`
--

DROP TABLE IF EXISTS `productos_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos_tipos` (
  `id_producto_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_producto_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_tipos`
--

LOCK TABLES `productos_tipos` WRITE;
/*!40000 ALTER TABLE `productos_tipos` DISABLE KEYS */;
INSERT INTO `productos_tipos` VALUES (1,'Popcorn'),(2,'Bebida'),(3,'Merchandising'),(4,'Combo'),(5,'Snack'),(6,'Promoción');
/*!40000 ALTER TABLE `productos_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_empleados`
--

DROP TABLE IF EXISTS `rol_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol_empleados` (
  `id_rol_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_empleados`
--

LOCK TABLES `rol_empleados` WRITE;
/*!40000 ALTER TABLE `rol_empleados` DISABLE KEYS */;
INSERT INTO `rol_empleados` VALUES (1,'Dulcería'),(2,'Tickets'),(3,'Seguridad');
/*!40000 ALTER TABLE `rol_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salas_cine`
--

DROP TABLE IF EXISTS `salas_cine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salas_cine` (
  `id_sala_cine` int(11) NOT NULL AUTO_INCREMENT,
  `num_sala` int(11) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `id_cine` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sala_cine`),
  KEY `fk_id_cine_idx` (`id_cine`),
  CONSTRAINT `fk_salas_cine_cines_id_cine` FOREIGN KEY (`id_cine`) REFERENCES `cines` (`id_cine`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salas_cine`
--

LOCK TABLES `salas_cine` WRITE;
/*!40000 ALTER TABLE `salas_cine` DISABLE KEYS */;
INSERT INTO `salas_cine` VALUES (1,1,80,1),(2,2,80,1),(3,3,80,1),(4,1,80,2),(5,2,80,2),(6,1,80,3),(7,1,80,4),(8,2,80,4),(9,1,80,5),(10,1,80,6),(11,2,80,6),(12,1,80,7),(13,1,80,8),(14,1,80,9),(15,1,80,10),(16,1,80,11),(17,1,80,12);
/*!40000 ALTER TABLE `salas_cine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_salas_cine`
--

DROP TABLE IF EXISTS `tipos_salas_cine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_salas_cine` (
  `id_tipo_sala_cine` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_sala_cine`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_salas_cine`
--

LOCK TABLES `tipos_salas_cine` WRITE;
/*!40000 ALTER TABLE `tipos_salas_cine` DISABLE KEYS */;
INSERT INTO `tipos_salas_cine` VALUES (2,'3D'),(5,'4DX'),(4,'IMAX'),(1,'Regular'),(3,'VIP'),(6,'Xtreme');
/*!40000 ALTER TABLE `tipos_salas_cine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_boletos`
--

DROP TABLE IF EXISTS `ventas_boletos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas_boletos` (
  `id_venta_boleto` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_cine` int(11) DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metodo_pago` enum('Efectivo','Tarjeta','Online') DEFAULT NULL,
  PRIMARY KEY (`id_venta_boleto`),
  KEY `fk_ventas_boletos_cliente` (`id_cliente`),
  KEY `fk_ventas_boletos_cine` (`id_cine`),
  CONSTRAINT `fk_ventas_boletos_cine` FOREIGN KEY (`id_cine`) REFERENCES `cines` (`id_cine`),
  CONSTRAINT `fk_ventas_boletos_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_boletos`
--

LOCK TABLES `ventas_boletos` WRITE;
/*!40000 ALTER TABLE `ventas_boletos` DISABLE KEYS */;
INSERT INTO `ventas_boletos` VALUES (1,2,1,'2025-07-15 03:29:48',40.00,'Efectivo'),(2,2,1,'2025-07-15 03:31:49',NULL,'Efectivo'),(3,2,1,'2025-07-15 03:32:47',40.00,'Tarjeta'),(4,2,1,'2025-07-15 04:03:07',NULL,'Tarjeta'),(5,2,1,'2025-07-15 04:09:15',40.00,'Tarjeta'),(6,2,1,'2025-07-15 04:17:41',60.00,'Efectivo'),(7,2,1,'2025-07-15 04:19:08',42.00,'Online'),(8,2,1,'2025-07-15 04:28:45',12.00,'Online'),(9,2,1,'2025-07-15 04:30:34',60.00,'Efectivo'),(10,2,1,'2025-07-15 04:34:30',50.00,'Tarjeta'),(11,2,1,'2025-07-15 04:35:14',12.00,'Efectivo');
/*!40000 ALTER TABLE `ventas_boletos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_productos`
--

DROP TABLE IF EXISTS `ventas_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas_productos` (
  `id_venta_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_cine` int(11) DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metodo_pago` enum('Efectivo','Tarjeta','Online') DEFAULT NULL,
  PRIMARY KEY (`id_venta_producto`),
  KEY `fk_ventas_productos_cliente` (`id_cliente`),
  KEY `fk_ventas_productos_empleado` (`id_empleado`),
  KEY `fk_ventas_productos_cine` (`id_cine`),
  CONSTRAINT `fk_ventas_productos_cine` FOREIGN KEY (`id_cine`) REFERENCES `cines` (`id_cine`),
  CONSTRAINT `fk_ventas_productos_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_ventas_productos_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_productos`
--

LOCK TABLES `ventas_productos` WRITE;
/*!40000 ALTER TABLE `ventas_productos` DISABLE KEYS */;
INSERT INTO `ventas_productos` VALUES (1,2,3,1,'2025-07-15 03:29:48',209.00,'Efectivo'),(2,2,3,1,'2025-07-15 03:31:49',NULL,'Efectivo'),(3,2,3,1,'2025-07-15 03:32:47',209.00,'Tarjeta'),(4,2,3,1,'2025-07-15 04:03:07',NULL,'Tarjeta'),(5,2,3,1,'2025-07-15 04:09:15',52.00,'Tarjeta'),(6,2,3,1,'2025-07-15 04:17:41',67.00,'Efectivo'),(7,2,3,1,'2025-07-15 04:19:08',89.00,'Online'),(8,2,3,1,'2025-07-15 04:34:30',70.00,'Tarjeta'),(9,2,3,1,'2025-07-15 04:35:14',45.00,'Efectivo');
/*!40000 ALTER TABLE `ventas_productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-15  5:14:24
