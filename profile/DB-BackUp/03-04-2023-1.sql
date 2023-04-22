CREATE DATABASE  IF NOT EXISTS `helijzcs_wasty` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `helijzcs_wasty`;
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
  `password` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
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
INSERT INTO `bidding_wastage` VALUES ('B2303270001','U2302270001','W2302270003',250000,'message text','2023-03-27 02:03:50','2023-03-27 02:03:50',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,5,'Colombo 08');
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
  `address` varchar(45) DEFAULT NULL,
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
INSERT INTO `company_reg` VALUES ('CM2302270001',1,'OMG Community','10A Braddell Hill, #08-02,Singapore 579720','Dinuk Ranaweera','0777234242','prof/CM2302270001/br1.jpeg','2023-02-27 07:02:20','2023-02-27 07:02:20');
/*!40000 ALTER TABLE `company_reg` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_tracker`
--

LOCK TABLES `delivery_tracker` WRITE;
/*!40000 ALTER TABLE `delivery_tracker` DISABLE KEYS */;
INSERT INTO `delivery_tracker` VALUES (1,'IN2303270001','2023-03-27 07:03:06','Order Request Send To Seller'),(2,'IN2303270002','2023-03-27 07:03:30','Order Request Send To Seller');
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
INSERT INTO `discount` VALUES ('2302230001','W2302270003',10,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Ampara'),(2,'Anuradhapura'),(3,'Badulla'),(4,'Batticaloa'),(5,'Colombo'),(6,'Galle'),(7,'Gampaha');
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
INSERT INTO `invoice` VALUES ('IN2303270001','2023-03-27 07:03:06','buy_partially','W2302270003','U2302270001','Dinuk','Ranaweera','dinuk.ranaweera@gmail.com','10A Braddell Hill, #08-02,Singapore 579720','note','10A Braddell Hill, #08-02,Singapore 579720','250','20','5000','2500','10','500','7000',2),('IN2303270002','2023-03-27 07:03:30','buy_partially','W2302270003','U2302270001','Dinuk','Heshan','dinuk.ranaweera@gmail.com','B4 Elivitigala Flats,Elvitigala Mawatha','Note 2222','B4 Elivitigala Flats,Elvitigala Mawatha','250','20','5000','2500','10','500','7000',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferred_user_type`
--

LOCK TABLES `preferred_user_type` WRITE;
/*!40000 ALTER TABLE `preferred_user_type` DISABLE KEYS */;
INSERT INTO `preferred_user_type` VALUES (48,2,'W2302270002','18',80),(53,1,'W2302270001','10',100),(54,1,'W2302270003','18',100),(55,2,'W2302270003','48',80),(56,3,'W2302270003','48',60);
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
  CONSTRAINT `fk_user_company_reg1` FOREIGN KEY (`idcompany_reg`) REFERENCES `company_reg` (`idcompany_reg`),
  CONSTRAINT `fk_user_user_type` FOREIGN KEY (`iduser_type`) REFERENCES `user_type` (`iduser_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('U2302270001',1,'CM2302270001','Dinuk Ranaweera','dinuk.ranaweera@gmail.com','ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6','0777234242','2023-02-27 07:02:20','2023-02-27 07:02:20',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
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
  `log` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser_log`),
  KEY `fk_user_log_user1_idx` (`iduser`),
  CONSTRAINT `fk_user_log_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_log`
--

LOCK TABLES `user_log` WRITE;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;
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
INSERT INTO `user_type` VALUES (1,'Community Kitchen','1',1,1,'100','Organization','img/usertype/community-kitchen.png',1),(2,'Pig Farm','2',1,1,'80','Farm','img/usertype/pig-fram.png',1),(3,'Bio Gas','3',1,1,'60','Organization','img/usertype/bio-gas.png',1);
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
INSERT INTO `wastage` VALUES ('W2302270001',1,'U2302270001','post/CM2302270001/Wastey_27022023085211785127.jpeg','2023-03-25 08:02:22','I have cooked Koththu','I have 200 chicken koththu. we made for birthday event ',200,200,'packs',200000,1,1,'0777883494','','Cooked',1,00000000100,800,'156/18 Kaluwala Road, Ganemulla',1,450,2),('W2302270002',1,'U2302270001','post/CM2302270001/assortment-different-trashed-objects.jpg','2023-03-22 11:02:53','I have waste foods','i have waste food only vegetables ',20,20,'kg',12000,1,1,'0777882342','','Waste',0,00000000000,0,'156 Pothuarawa Road, Malabe',1,3000,2),('W2302270003',1,'U2302270001','post/CM2302270001/Wastey_27022023085733661135.webp','2023-03-21 12:02:59','I have row foodss','i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. ',40,0,'kg',200000,1,1,'0777342342','U2302270001','Raw',1,00000000020,250,'No. 07, Meepe, Ingiriya Road, Padukka 10500, Sri Lanka',1,2500,4);
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

-- Dump completed on 2023-04-03 13:46:58
