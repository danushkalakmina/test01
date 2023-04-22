CREATE DATABASE  IF NOT EXISTS `wastey` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `wastey`;
-- MySQL dump 10.13  Distrib 8.0.28, for macos11 (x86_64)
--
-- Host: localhost    Database: wastey
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Dinuk','dinuk.ranaweera@gmail.com','ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6','1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_log` (
  `idadmin_log` int NOT NULL AUTO_INCREMENT,
  `idAdmin` int NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `log` text,
  PRIMARY KEY (`idadmin_log`),
  KEY `fk_admin_log_admin1_idx` (`idAdmin`),
  CONSTRAINT `fk_admin_log_admin1` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_log`
--

LOCK TABLES `admin_log` WRITE;
/*!40000 ALTER TABLE `admin_log` DISABLE KEYS */;
INSERT INTO `admin_log` VALUES (1,1,'2023-04-21 10:04:58','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(2,1,'2023-04-21 10:04:41','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(3,1,'2023-04-21 10:04:45','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(4,1,'2023-04-21 10:04:43','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(5,1,'2023-04-21 10:04:04','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),(6,1,'2023-04-21 10:04:47','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),(7,1,'2023-04-21 10:04:22','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),(8,1,'2023-04-21 10:04:33','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),(9,1,'2023-04-21 10:04:45','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),(10,1,'2023-04-21 10:04:27','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),(11,1,'2023-04-21 12:04:48','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(12,1,'2023-04-21 01:04:53','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36');
/*!40000 ALTER TABLE `admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bidding_wastage`
--

DROP TABLE IF EXISTS `bidding_wastage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bidding_wastage` (
  `id_bidding` varchar(11) NOT NULL DEFAULT 'B2302230001',
  `iduser` varchar(11) NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `price` double DEFAULT NULL,
  `remark` text,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '0 - Default\n1 - Selected\n2 - Not Selected',
  PRIMARY KEY (`id_bidding`),
  KEY `fk_bidding_wastage_user1_idx` (`iduser`),
  KEY `fk_bidding_wastage_wastage1_idx` (`idwastage`),
  CONSTRAINT `fk_bidding_wastage_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  CONSTRAINT `fk_bidding_wastage_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bidding_wastage`
--

LOCK TABLES `bidding_wastage` WRITE;
/*!40000 ALTER TABLE `bidding_wastage` DISABLE KEYS */;
/*!40000 ALTER TABLE `bidding_wastage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `idcity` int NOT NULL AUTO_INCREMENT,
  `iddistrict` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcity`),
  KEY `fk_city_district1_idx` (`iddistrict`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`iddistrict`) REFERENCES `district` (`iddistrict`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (2,16,'Addalaichchenai'),(3,16,'Akkaraipattu'),(4,16,'Alayadivembu'),(5,16,'Ampara'),(6,16,'Damana'),(7,16,'Dehiattakandiya'),(8,16,'Irakkamam'),(9,16,'Kalmunai'),(10,16,'Kalmunai'),(11,16,'Karaitivu'),(12,16,'Lahugala'),(13,16,'Maha Oya'),(14,16,'Navithanveli'),(15,16,'Nintavur'),(16,16,'Padiyathalawa'),(17,16,'Pottuvil'),(18,16,'Sainthamaruthu'),(19,16,'Sammanthurai'),(20,16,'Thirukkovil'),(21,16,'Uhana'),(22,20,'Anuradhapura'),(23,20,'Tissawewa'),(24,20,'Mihintale'),(25,20,'Kekirawa'),(26,20,'Medawachchiya'),(27,20,'Horowpothana'),(28,20,'Kahatagasdigiliya'),(29,20,'Talawa'),(30,20,'Galenbindunuwewa'),(31,20,'Thalawa'),(32,1,'Colombo 1 (Fort)'),(33,1,'Colombo 2 (Slave Island)'),(34,1,'Colombo 3 (Kollupitiya)'),(35,1,'Colombo 4 (Bambalapitiya'),(36,1,'Colombo 5 (Havelock Town'),(37,1,'Colombo 6 (Wellawatte)'),(38,1,'Colombo 7 (Cinnamon Gardens)'),(39,1,'Colombo 8 (Borella)'),(40,1,'Colombo 9 (Dematagoda)'),(41,1,'Colombo 10 (Maradana)'),(42,1,'Dehiwala-Mount Lavinia'),(43,1,'Moratuwa'),(44,1,'Sri Jayawardenepura Kotte'),(45,1,'Piliyandala'),(46,1,'Maharagama'),(47,1,'Nugegoda'),(48,1,'Battaramulla'),(49,1,'Kotte'),(50,1,'Kaduwela'),(51,2,'Gampaha'),(52,2,'Ja-Ela'),(53,2,'Negombo'),(54,2,'Wattala'),(55,2,'Kelaniya'),(56,2,'Kadawatha'),(57,2,'Divulapitiya'),(58,2,'Minuwangoda'),(59,2,'Veyangoda'),(60,2,'Mirigama'),(61,3,'Kalutara'),(62,3,'Panadura'),(63,3,'Horana'),(64,3,'Matugama'),(65,3,'Beruwala'),(66,3,'Aluthgama'),(67,3,'Ingiriya'),(68,3,'Bulathsinhala'),(69,3,'Agalawatta'),(70,3,'Baduraliya'),(71,4,'Kandy'),(72,4,'Peradeniya'),(73,4,'Katugastota'),(74,4,'Gampola'),(75,4,'Akurana'),(76,4,'Pallekele'),(77,4,'Kundasale'),(78,4,'Galaha'),(79,4,'Pilimatalawa'),(80,4,'Digana'),(81,5,'Matale'),(82,5,'Aluvihara'),(83,5,'Ambanganga Korale'),(84,5,'Bowatta'),(85,5,'Dambulla'),(86,5,'Galewela'),(87,5,'Palapathwela'),(88,5,'Pallepola'),(89,5,'Rattota'),(90,5,'Ukuwela'),(91,6,'Matale'),(92,6,'Nuwara Eliya'),(93,6,'Hatton'),(94,6,'Ambewela'),(95,6,'Kotagala'),(96,6,'Nanu Oya'),(97,6,'Haputale'),(98,6,'Bandarawela'),(99,6,'Ella'),(100,7,'Galle'),(101,7,'Unawatuna'),(102,7,'Hikkaduwa'),(103,7,'Ahangama'),(104,7,'Weligama'),(105,7,'Mirissa'),(106,7,'Ambalangoda'),(107,7,'Balapitiya'),(108,8,'Matara'),(109,8,'Weligama'),(110,8,'Mirissa'),(111,8,'Kamburugamuwa'),(112,8,'Akuressa'),(113,8,'Devinuwara'),(114,8,'Dikwella'),(115,8,'Kamburupitiya'),(116,8,'Hakmana'),(117,9,'Hambantota'),(118,9,'Tissamaharama'),(119,9,'Ambalantota'),(120,9,'Tangalle'),(121,9,'Weeraketiya'),(122,9,'Beliatta'),(123,9,'Kirinda'),(124,9,'Sooriyawewa'),(125,9,'Walasmulla'),(126,10,'Jaffna'),(127,10,'Chavakachcheri'),(128,10,'Point Pedro'),(129,10,'Nallur'),(130,10,'Vavuniya'),(131,10,'Kilinochchi'),(132,10,'Mannar'),(133,10,'Mullaitivu'),(134,10,'Poonakari'),(135,11,'Kilinochchi'),(136,11,'Pooneryn'),(137,11,'Karachchi'),(138,11,'Paranthan'),(139,11,'Mankulam'),(140,11,'Akkarayankulam'),(141,12,'Mannar'),(142,12,'Adampan'),(143,12,'Madhu'),(144,12,'Nanattan'),(145,12,'Musali'),(146,12,'Talaimannar'),(147,13,'Vavuniya'),(148,13,'Nedunkerny'),(149,13,'Omanthai'),(150,13,'Nallur'),(151,13,'Poovarasankulam'),(152,13,'Thandikulam'),(153,14,'Mullaitivu'),(154,14,'Puthukkudiyiruppu'),(155,14,'Maritimepattu'),(156,14,'Oddusuddan'),(157,14,'Thunukkai'),(158,14,'Mulankavil'),(159,15,'Kilinochchi'),(160,15,'Batticaloa'),(161,15,'Kattankudy'),(162,15,'Eravur'),(163,15,'Chenkalady'),(164,15,'Valaichchenai'),(165,17,'Trincomalee'),(166,17,'Nilaveli'),(167,17,'Kinniya'),(168,17,'Kantale'),(169,17,'Gomarankadawala'),(170,18,'Kurunegala'),(171,18,'Polgahawela'),(172,18,'Kuliyapitiya'),(173,18,'Narammala'),(174,18,'Bingiriya'),(175,19,'Puttalam'),(176,19,'Chilaw'),(177,19,'Anamaduwa'),(178,19,'Wennappuwa'),(179,19,'Mundalama'),(180,21,'Polonnaruwa'),(181,21,'Kaduruwela'),(182,21,'Hingurakgoda'),(183,21,'Medirigiriya'),(184,21,'Elahera'),(185,22,'Badulla'),(186,22,'Hali Ela'),(187,22,'Ella'),(188,22,'Bandarawela'),(189,22,'Welimada'),(190,22,'Haputale'),(191,23,'Moneragala'),(192,23,'Buttala'),(193,23,'Wellawaya'),(194,23,'Kataragama'),(195,24,'Ratnapura'),(196,24,'Embilipitiya'),(197,24,'Pelmadulla'),(198,24,'Kuruwita'),(199,25,'Kegalle'),(200,25,'Mawanella'),(201,25,'Warakapola'),(202,25,'Dehiowita');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_reg`
--

DROP TABLE IF EXISTS `company_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_reg` (
  `idcompany_reg` varchar(12) NOT NULL DEFAULT 'CM2302230001',
  `idcity` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` text,
  `contact_pname` varchar(45) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `proof_url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idcompany_reg`),
  KEY `fk_company_reg_city1_idx` (`idcity`),
  CONSTRAINT `fk_company_reg_city1` FOREIGN KEY (`idcity`) REFERENCES `city` (`idcity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_reg`
--

LOCK TABLES `company_reg` WRITE;
/*!40000 ALTER TABLE `company_reg` DISABLE KEYS */;
INSERT INTO `company_reg` VALUES ('CM2304210001',39,'Mathara Bathkade','10A Braddell Hill, #08-02,Singapore 579720','Dinuk Ranaweera','0777234242','prof/CM2304210001/br.webp','2023-04-21 09:04:44','2023-04-21 09:04:44'),('CM2304210002',38,'Ranaweera Heshan','B4 Elivitigala Flats\r\nElvitigala Mawatha','Ranaweera Heshan','0777234242','','2023-04-21 12:04:41','2023-04-21 12:04:41');
/*!40000 ALTER TABLE `company_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_job`
--

DROP TABLE IF EXISTS `cron_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cron_job` (
  `idcron_job` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idcron_job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_job`
--

LOCK TABLES `cron_job` WRITE;
/*!40000 ALTER TABLE `cron_job` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_tracker`
--

DROP TABLE IF EXISTS `delivery_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_tracker` (
  `iddelivery_tracker` int NOT NULL AUTO_INCREMENT,
  `idinvoice` varchar(12) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddelivery_tracker`),
  KEY `fk_delivery_tracker_invoice1_idx` (`idinvoice`),
  CONSTRAINT `fk_delivery_tracker_invoice1` FOREIGN KEY (`idinvoice`) REFERENCES `invoice` (`idinvoice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_tracker`
--

LOCK TABLES `delivery_tracker` WRITE;
/*!40000 ALTER TABLE `delivery_tracker` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discount` (
  `discount_code` varchar(45) NOT NULL DEFAULT 'D2302230001',
  `idwastage` varchar(11) NOT NULL,
  `percentage` int DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '0 - inactive\n1 - active\n2 - disabled ',
  PRIMARY KEY (`discount_code`),
  UNIQUE KEY `discount_code_UNIQUE` (`discount_code`),
  KEY `fk_discount_wastage1_idx` (`idwastage`),
  CONSTRAINT `fk_discount_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount`
--

LOCK TABLES `discount` WRITE;
/*!40000 ALTER TABLE `discount` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `district` (
  `iddistrict` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddistrict`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Colombo'),(2,'Gampaha'),(3,'Kalutara'),(4,'Kandy'),(5,'Matale'),(6,'Nuwara Eliya'),(7,'Galle'),(8,'Matara'),(9,'Hambantota'),(10,'Jaffna'),(11,'Kilinochchi'),(12,'Mannar'),(13,'Vavuniya'),(14,'Mullaitivu'),(15,'Batticaloa'),(16,'Ampara'),(17,'Trincomalee'),(18,'Kurunegala'),(19,'Puttalam'),(20,'Anuradhapura'),(21,'Polonnaruwa'),(22,'Badulla'),(23,'Moneragala'),(24,'Ratnapura'),(25,'Kegalle');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `idinvoice` varchar(12) NOT NULL DEFAULT 'IN2302230001',
  `date` datetime DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL COMMENT 'buy_partially\nbuy_online',
  `idwastage` varchar(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` text,
  `billing_address` text,
  `billing_note` text,
  `delivery_address` varchar(45) DEFAULT NULL,
  `unit_price` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `sub_total` varchar(45) DEFAULT NULL,
  `delivery_amount` varchar(45) DEFAULT NULL,
  `discount_percentage` varchar(45) DEFAULT NULL,
  `discount_amount` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '0 - Rejected\n1 - Completed\n2 - Delivery Process',
  PRIMARY KEY (`idinvoice`),
  KEY `fk_invoice_wastage1_idx` (`idwastage`),
  KEY `fk_invoice_user1_idx` (`iduser`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  CONSTRAINT `fk_invoice_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `idorder` varchar(11) NOT NULL DEFAULT 'O2302230001',
  `iddiscount` int NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `qty` int DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  PRIMARY KEY (`idorder`),
  KEY `fk_order_wastage1_idx` (`idwastage`),
  KEY `fk_order_user1_idx` (`iduser`),
  CONSTRAINT `fk_order_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  CONSTRAINT `fk_order_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferred_user_type`
--

DROP TABLE IF EXISTS `preferred_user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `preferred_user_type` (
  `id_preferred_user_type` int NOT NULL AUTO_INCREMENT,
  `iduser_type` int NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `preferred_time` varchar(45) DEFAULT NULL,
  `preferred_discount_leverage` int DEFAULT NULL,
  PRIMARY KEY (`id_preferred_user_type`),
  KEY `fk_user_type_has_wastage_user_type1_idx` (`iduser_type`),
  KEY `fk_preferred_user_type_wastage1_idx` (`idwastage`),
  CONSTRAINT `fk_preferred_user_type_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`),
  CONSTRAINT `fk_user_type_has_wastage_user_type1` FOREIGN KEY (`iduser_type`) REFERENCES `user_type` (`iduser_type`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferred_user_type`
--

LOCK TABLES `preferred_user_type` WRITE;
/*!40000 ALTER TABLE `preferred_user_type` DISABLE KEYS */;
INSERT INTO `preferred_user_type` VALUES (16,2,'W2304210001','10',80),(17,3,'W2304210001','16',60),(18,4,'W2304210001','38',40),(19,5,'W2304210001','162',20),(20,1,'W2304210002','5',100),(21,2,'W2304210002','18',80),(22,3,'W2304210002','30',60),(23,4,'W2304210002','92',40),(24,5,'W2304210002','162',20);
/*!40000 ALTER TABLE `preferred_user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `iduser` varchar(11) NOT NULL DEFAULT 'U2302230001',
  `iduser_type` int NOT NULL,
  `idcompany_reg` varchar(12) NOT NULL,
  `iduser_account_type` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` text,
  `contact_no` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int DEFAULT '2' COMMENT '0= Inactive 1 = Active 2 = In Review 3 = Disable',
  PRIMARY KEY (`iduser`),
  KEY `fk_user_user_type_idx` (`iduser_type`),
  KEY `fk_user_company_reg1_idx` (`idcompany_reg`),
  KEY `fk_user_user_account_type1_idx` (`iduser_account_type`),
  CONSTRAINT `fk_user_company_reg1` FOREIGN KEY (`idcompany_reg`) REFERENCES `company_reg` (`idcompany_reg`),
  CONSTRAINT `fk_user_user_account_type1` FOREIGN KEY (`iduser_account_type`) REFERENCES `user_account_type` (`iduser_account_type`),
  CONSTRAINT `fk_user_user_type` FOREIGN KEY (`iduser_type`) REFERENCES `user_type` (`iduser_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('U2304210001',1,'CM2304210001',1,'Dinuk Ranaweera','dinuk.ranaweera@gmail.com','ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6','0777234242','2023-04-21 09:04:44','2023-04-21 09:04:44',1),('U2304210002',1,'CM2304210002',2,'Ranaweera Heshan','ranaweeradinuk@gmail.com','ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6','0777234242','2023-04-21 12:04:41','2023-04-21 12:04:41',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account_type`
--

DROP TABLE IF EXISTS `user_account_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_account_type` (
  `iduser_account_type` int NOT NULL AUTO_INCREMENT,
  `account_type` varchar(45) DEFAULT NULL,
  `suggested_name` varchar(45) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  PRIMARY KEY (`iduser_account_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account_type`
--

LOCK TABLES `user_account_type` WRITE;
/*!40000 ALTER TABLE `user_account_type` DISABLE KEYS */;
INSERT INTO `user_account_type` VALUES (1,'Business','Business Name',1),(2,'Individual','Name',1);
/*!40000 ALTER TABLE `user_account_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_log` (
  `iduser_log` int NOT NULL AUTO_INCREMENT,
  `iduser` varchar(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `log` text,
  PRIMARY KEY (`iduser_log`),
  KEY `fk_user_log_user1_idx` (`iduser`),
  CONSTRAINT `fk_user_log_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_log`
--

LOCK TABLES `user_log` WRITE;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
INSERT INTO `user_log` VALUES (1,'U2304210001','2023-04-21 10:04:30','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(2,'U2304210002','2023-04-21 12:04:00','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),(3,'U2304210001','2023-04-21 01:04:30','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36');
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifier`
--

DROP TABLE IF EXISTS `user_notifier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifier` (
  `id_user_notifier` int NOT NULL AUTO_INCREMENT,
  `idcron_job` int NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  PRIMARY KEY (`id_user_notifier`),
  KEY `fk_user_has_cron_job_cron_job1_idx` (`idcron_job`),
  KEY `fk_user_has_cron_job_user1_idx` (`iduser`),
  KEY `fk_user_has_cron_job_wastage1_idx` (`idwastage`),
  CONSTRAINT `fk_user_has_cron_job_cron_job1` FOREIGN KEY (`idcron_job`) REFERENCES `cron_job` (`idcron_job`),
  CONSTRAINT `fk_user_has_cron_job_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  CONSTRAINT `fk_user_has_cron_job_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notifier`
--

LOCK TABLES `user_notifier` WRITE;
/*!40000 ALTER TABLE `user_notifier` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notifier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `iduser_type` int NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `priority` varchar(45) DEFAULT NULL,
  `is_proof_needed` tinyint DEFAULT NULL,
  `is_selling_allowed` tinyint DEFAULT NULL,
  `discount_leverage` varchar(45) DEFAULT NULL,
  `preferred_name` varchar(45) DEFAULT NULL,
  `user_type_image` varchar(45) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  PRIMARY KEY (`iduser_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Human Usage','1',1,1,'100','Organization','img/usertype/community-kitchen.png',1),(2,'Animal Usage','2',1,1,'80','Farm','img/usertype/pig-fram.png',1),(3,'Industrial Usage','3',1,1,'60','Organization','img/usertype/bio-gas.png',1),(4,'Composting','4',0,1,'40','Business','img/usertype/composting.png',1),(5,'For Landfill','5',0,1,'20','Business','img/usertype/landfill.png',1);
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wastage`
--

DROP TABLE IF EXISTS `wastage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wastage` (
  `idwastage` varchar(11) NOT NULL DEFAULT 'W2302230001',
  `idcity` int NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `image` text,
  `date` datetime DEFAULT NULL,
  `title` text,
  `description` text,
  `qty` int DEFAULT NULL,
  `balance_qty` int DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `isnegotiable` tinyint DEFAULT '0',
  `isbidding` tinyint DEFAULT '0',
  `contact_no` varchar(10) DEFAULT NULL,
  `booked_by` varchar(45) DEFAULT NULL,
  `waste_type` varchar(45) DEFAULT NULL,
  `isseperate` tinyint DEFAULT '0',
  `seperate_min_qty` int(11) unsigned zerofill DEFAULT '00000000000',
  `unit_price` double DEFAULT '0',
  `pick_up_address` text,
  `is_delivery` tinyint DEFAULT '0',
  `delivery_price` double DEFAULT '0',
  `status` int DEFAULT '3' COMMENT '0 - Inactive 1 - Active  2 - In Review  3 - Disable 4-Sold',
  PRIMARY KEY (`idwastage`),
  KEY `fk_wastage_city1_idx` (`idcity`),
  KEY `fk_wastage_user1_idx` (`iduser`),
  CONSTRAINT `fk_wastage_city1` FOREIGN KEY (`idcity`) REFERENCES `city` (`idcity`),
  CONSTRAINT `fk_wastage_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wastage`
--

LOCK TABLES `wastage` WRITE;
/*!40000 ALTER TABLE `wastage` DISABLE KEYS */;
INSERT INTO `wastage` VALUES ('W2304210001',41,'U2304210001','post/CM2304210001/Wastey_21042023105010310478.jpg','2023-04-21 10:04:10','I have food wastage','I have food wastage. and i want to sell it immediately ',30,30,'kg',20000,1,1,'0723423423','','Waste',1,00000000010,9500,'156/17 Kaluwala Handiya, Kadawataha Road, Koswaththa',1,2500,1),('W2304210002',49,'U2304210002','post/CM2304210002/Wastey_21042023120727387633.jpeg','2023-04-21 12:04:27','I have cooked very tasty cheese koththu','I have cooked very tasty cheese koththu. I cooked for a birthday party. i want to sell immediately.',50,50,'packs',13000,1,1,'0734534534','','Cooked',0,00000000000,0,'345/343 Raffels palce, Colombo 05',1,1500,2);
/*!40000 ALTER TABLE `wastage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wastage_review`
--

DROP TABLE IF EXISTS `wastage_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wastage_review` (
  `idwastage_review` int NOT NULL AUTO_INCREMENT,
  `idwastage` varchar(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text,
  `image_url` varchar(45) DEFAULT NULL,
  `suggested_user_type` varchar(45) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  PRIMARY KEY (`idwastage_review`),
  KEY `fk_wastage_review_wastage1_idx` (`idwastage`),
  KEY `fk_wastage_review_user1_idx` (`iduser`),
  CONSTRAINT `fk_wastage_review_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  CONSTRAINT `fk_wastage_review_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wastage_review`
--

LOCK TABLES `wastage_review` WRITE;
/*!40000 ALTER TABLE `wastage_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `wastage_review` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-21 17:38:27
