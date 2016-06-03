-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: couchinndb
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'Rwanda'),(2,'Somalia'),(3,'Yemen'),(4,'Iraq'),(5,'Saudi Arabia'),(6,'Iran'),(7,'Cyprus'),(8,'Tanzania'),(9,'Syria'),(10,'Armenia'),(11,'Kenya'),(12,'Congo'),(13,'Djibouti'),(14,'Uganda'),(15,'Central African Republic'),(16,'Seychelles'),(17,'Hashemite Kingdom of Jordan'),(18,'Lebanon'),(19,'Kuwait'),(20,'Oman'),(21,'Qatar'),(22,'Bahrain'),(23,'United Arab Emirates'),(24,'Israel'),(25,'Turkey'),(26,'Ethiopia'),(27,'Eritrea'),(28,'Egypt'),(29,'Sudan'),(30,'Greece'),(31,'Burundi'),(32,'Estonia'),(33,'Latvia'),(34,'Azerbaijan'),(35,'Republic of Lithuania'),(36,'Svalbard and Jan Mayen'),(37,'Georgia'),(38,'Republic of Moldova'),(39,'Belarus'),(40,'Finland'),(41,'Åland'),(42,'Ukraine'),(43,'Macedonia'),(44,'Hungary'),(45,'Bulgaria'),(46,'Albania'),(47,'Poland'),(48,'Romania'),(49,'Kosovo'),(50,'Zimbabwe'),(51,'Zambia'),(52,'Comoros'),(53,'Malawi'),(54,'Lesotho'),(55,'Botswana'),(56,'Mauritius'),(57,'Swaziland'),(58,'Réunion'),(59,'South Africa'),(60,'Mayotte'),(61,'Mozambique'),(62,'Madagascar'),(63,'Afghanistan'),(64,'Pakistan'),(65,'Bangladesh'),(66,'Turkmenistan'),(67,'Tajikistan'),(68,'Sri Lanka'),(69,'Bhutan'),(70,'India'),(71,'Maldives'),(72,'British Indian Ocean Territory'),(73,'Nepal'),(74,'Myanmar [Burma]'),(75,'Uzbekistan'),(76,'Kazakhstan'),(77,'Kyrgyzstan'),(78,'French Southern Territories'),(79,'Cocos [Keeling] Islands'),(80,'Palau'),(81,'Vietnam'),(82,'Thailand'),(83,'Indonesia'),(84,'Laos'),(85,'Taiwan'),(86,'Philippines'),(87,'Malaysia'),(88,'China'),(89,'Hong Kong'),(90,'Brunei'),(91,'Macao'),(92,'Cambodia'),(93,'Republic of Korea'),(94,'Japan'),(95,'North Korea'),(96,'Singapore'),(97,'Cook Islands'),(98,'East Timor'),(99,'Russia'),(100,'Mongolia'),(101,'Australia'),(102,'Christmas Island'),(103,'Marshall Islands'),(104,'Federated States of Micronesia'),(105,'Papua New Guinea'),(106,'Solomon Islands'),(107,'Tuvalu'),(108,'Nauru'),(109,'Vanuatu'),(110,'New Caledonia'),(111,'Norfolk Island'),(112,'New Zealand'),(113,'Fiji'),(114,'Libya'),(115,'Cameroon'),(116,'Senegal'),(117,'Republic of the Congo'),(118,'Portugal'),(119,'Liberia'),(120,'Ivory Coast'),(121,'Ghana'),(122,'Equatorial Guinea'),(123,'Nigeria'),(124,'Burkina Faso'),(125,'Togo'),(126,'Guinea-Bissau'),(127,'Mauritania'),(128,'Benin'),(129,'Gabon'),(130,'Sierra Leone'),(131,'São Tomé and Príncipe'),(132,'Gibraltar'),(133,'Gambia'),(134,'Guinea'),(135,'Chad'),(136,'Niger'),(137,'Mali'),(138,'Tunisia'),(139,'Spain'),(140,'Morocco'),(141,'Malta'),(142,'Algeria'),(143,'Faroe Islands'),(144,'Denmark'),(145,'Iceland'),(146,'United Kingdom'),(147,'Switzerland'),(148,'Sweden'),(149,'Netherlands'),(150,'Austria'),(151,'Belgium'),(152,'Germany'),(153,'Luxembourg'),(154,'Ireland'),(155,'Monaco'),(156,'France'),(157,'Andorra'),(158,'Liechtenstein'),(159,'Jersey'),(160,'Isle of Man'),(161,'Guernsey'),(162,'Slovak Republic'),(163,'Czech Republic'),(164,'Norway'),(165,'Vatican City'),(166,'San Marino'),(167,'Italy'),(168,'Slovenia'),(169,'Montenegro'),(170,'Croatia'),(171,'Bosnia and Herzegovina'),(172,'Angola'),(173,'Namibia'),(174,'Saint Helena'),(175,'Barbados'),(176,'Cape Verde'),(177,'Guyana'),(178,'French Guiana'),(179,'Suriname'),(180,'Saint Pierre and Miquelon'),(181,'Greenland'),(182,'Paraguay'),(183,'Uruguay'),(184,'Brazil'),(185,'Falkland Islands'),(186,'South Georgia and the South Sandwich Islands'),(187,'Jamaica'),(188,'Dominican Republic'),(189,'Cuba'),(190,'Martinique'),(191,'Bahamas'),(192,'Bermuda'),(193,'Anguilla'),(194,'Trinidad and Tobago'),(195,'Saint Kitts and Nevis'),(196,'Dominica'),(197,'Antigua and Barbuda'),(198,'Saint Lucia'),(199,'Turks and Caicos Islands'),(200,'Aruba'),(201,'British Virgin Islands'),(202,'Saint Vincent and the Grenadines'),(203,'Montserrat'),(204,'Saint Martin'),(205,'Saint-Barthélemy'),(206,'Guadeloupe'),(207,'Grenada'),(208,'Cayman Islands'),(209,'Belize'),(210,'El Salvador'),(211,'Guatemala'),(212,'Honduras'),(213,'Nicaragua'),(214,'Costa Rica'),(215,'Venezuela'),(216,'Ecuador'),(217,'Colombia'),(218,'Panama'),(219,'Haiti'),(220,'Argentina'),(221,'Chile'),(222,'Bolivia'),(223,'Peru'),(224,'Mexico'),(225,'French Polynesia'),(226,'Pitcairn Islands'),(227,'Kiribati'),(228,'Tokelau'),(229,'Tonga'),(230,'Wallis and Futuna'),(231,'Samoa'),(232,'Niue'),(233,'Northern Mariana Islands'),(234,'Guam'),(235,'Puerto Rico'),(236,'U.S. Virgin Islands'),(237,'U.S. Minor Outlying Islands'),(238,'American Samoa'),(239,'Canada'),(240,'United States'),(241,'Palestine'),(244,'Serbia'),(245,'Antarctica'),(246,'Sint Maarten'),(247,'Curaçao'),(248,'Bonaire, Sint Eustatius, and Saba'),(249,'South Sudan');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-31 10:06:21
