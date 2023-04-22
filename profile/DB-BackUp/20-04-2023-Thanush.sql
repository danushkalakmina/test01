-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220604.11e8242d04
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 07:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wastey`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_info` (IN `user_id` VARCHAR(20))   BEGIN
    SELECT userD.name AS cusNam, userD.email AS cusEmail, userD.contact_no AS cusContact,userD.iduser_type as userType ,userT.type, companyD.name AS compName, companyD.address AS compAddress, district.iddistrict as districtID ,district.name AS districtName,city.idcity as cityId, city.name AS cityName 
    FROM `user` AS userD 
    INNER JOIN `company_reg` AS companyD ON companyD.idcompany_reg = userD.idcompany_reg 
    INNER JOIN `user_type` AS userT ON userT.iduser_type = userD.iduser_type 
    INNER JOIN `city` AS city ON city.idcity = companyD.idcity 
    INNER JOIN `district` AS district ON district.iddistrict = city.iddistrict 
    WHERE userD.iduser = user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `name`, `email`, `password`, `status`) VALUES
(1, 'Dinuk Ranaweer', 'dinuk.ranaweera@gmail.com', 'ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6', '1'),
(2, 'Thanush Wijesinghe', 'thanushwijesinghe@gmail.com', 'ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6', '2');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `iduser_log` int(11) NOT NULL DEFAULT 0,
  `iduser` varchar(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `log` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`iduser_log`, `iduser`, `datetime`, `log`) VALUES
(0, '1', '2023-04-14 04:04:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 04:04:02', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '5', '2023-04-14 08:04:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 08:04:36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:02', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-14 10:04:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-15 12:04:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(0, '1', '2023-04-15 05:04:11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-15 08:04:22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.46'),
(0, '1', '2023-04-15 10:04:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.46'),
(0, '1', '2023-04-16 11:04:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-16 11:04:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-16 11:04:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-16 11:04:07', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(0, '1', '2023-04-16 11:04:14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(0, '1', '2023-04-16 11:04:47', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1'),
(0, '1', '2023-04-16 11:04:22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-18 05:04:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-19 01:04:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(0, '1', '2023-04-19 01:04:33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0');

-- --------------------------------------------------------

--
-- Table structure for table `bidding_wastage`
--

CREATE TABLE `bidding_wastage` (
  `id_bidding` varchar(11) NOT NULL DEFAULT 'B2302230001',
  `iduser` varchar(11) NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `price` double DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - Default\n1 - Selected\n2 - Not Selected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bidding_wastage`
--

INSERT INTO `bidding_wastage` (`id_bidding`, `iduser`, `idwastage`, `price`, `remark`, `created_by`, `updated_by`, `status`) VALUES
('B2303270001', 'U2302270001', 'W2302270003', 250000, 'message text', '2023-03-27 02:03:50', '2023-03-27 02:03:50', 0),
('B2304050002', 'U2302270001', 'W2302270002', 13000, 'I like to offer 13000 but I need extra packing ', '2023-04-05 06:04:23', '2023-04-05 06:04:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `idcity` int(11) NOT NULL,
  `iddistrict` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`idcity`, `iddistrict`, `name`) VALUES
(1, 5, 'Colombo 08'),
(2, 5, 'Colombo 10');

-- --------------------------------------------------------

--
-- Table structure for table `company_reg`
--

CREATE TABLE `company_reg` (
  `idcompany_reg` varchar(12) NOT NULL DEFAULT 'CM2302230001',
  `idcity` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `contact_pname` varchar(45) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `proof_url` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_reg`
--

INSERT INTO `company_reg` (`idcompany_reg`, `idcity`, `name`, `address`, `contact_pname`, `contact_no`, `proof_url`, `created_at`, `updated_at`) VALUES
('CM2302270001', 1, 'OMG Community', '10A Braddell Hill, #08-02,Singapore 579720', 'Dinuk Ranaweera', '0777234242', 'prof/CM2302270001/br1.jpeg', '2023-02-27 07:02:20', '2023-02-27 07:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_tracker`
--

CREATE TABLE `delivery_tracker` (
  `iddelivery_tracker` int(11) NOT NULL,
  `idinvoice` varchar(12) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_tracker`
--

INSERT INTO `delivery_tracker` (`iddelivery_tracker`, `idinvoice`, `date`, `status_name`) VALUES
(1, 'IN2303270001', '2023-03-27 07:03:06', 'Order Request Send To Seller'),
(2, 'IN2303270002', '2023-03-27 07:03:30', 'Order Request Send To Seller'),
(3, 'IN2303270001', '2023-04-03 07:04:05', 'Request Processing'),
(4, 'IN2303270001', '2023-04-03 07:04:07', 'Packaging'),
(5, 'IN2303270001', '2023-04-03 07:04:08', 'Ready to Delivery'),
(6, 'IN2303270001', '2023-04-03 07:04:10', 'Delivery On-The-Way'),
(7, 'IN2303270001', '2023-04-03 07:04:12', 'Delivered'),
(8, 'IN2303270002', '2023-04-03 07:04:19', 'Request Processing'),
(9, 'IN2303270002', '2023-04-03 07:04:20', 'Packaging'),
(10, 'IN2303270002', '2023-04-03 07:04:21', 'Ready to Delivery'),
(11, 'IN2303270002', '2023-04-03 07:04:21', 'Delivery On-The-Way'),
(12, 'IN2303270002', '2023-04-03 07:04:22', 'Delivered'),
(16, 'IN2304050003', '2023-04-05 06:04:56', 'Order Request Send To Seller');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_code` varchar(45) NOT NULL DEFAULT 'D2302230001',
  `idwastage` varchar(11) NOT NULL,
  `percentage` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - inactive\n1 - active\n2 - disabled '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_code`, `idwastage`, `percentage`, `status`) VALUES
('2302230001', 'W2302270003', 10, 1),
('D2304040002', 'W2302270001', 10, 1),
('D2304040003', 'W2302270001', 20, 1),
('D2304040004', 'W2302270003', 20, 1),
('D2304040005', 'W2302270003', 20, 1),
('D2304040006', 'W2302270002', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `iddistrict` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`iddistrict`, `name`) VALUES
(1, 'Ampara'),
(2, 'Anuradhapura'),
(3, 'Badulla'),
(4, 'Batticaloa'),
(5, 'Colombo'),
(6, 'Galle'),
(7, 'Gampaha');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `idinvoice` varchar(12) NOT NULL DEFAULT 'IN2302230001',
  `date` datetime DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL COMMENT 'buy_partially\nbuy_online',
  `idwastage` varchar(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `billing_note` text DEFAULT NULL,
  `delivery_address` varchar(45) DEFAULT NULL,
  `unit_price` varchar(45) DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `sub_total` varchar(45) DEFAULT NULL,
  `delivery_amount` varchar(45) DEFAULT NULL,
  `discount_percentage` varchar(45) DEFAULT NULL,
  `discount_amount` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - Rejected\n1 - Completed\n2 - Delivery Process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`idinvoice`, `date`, `type`, `idwastage`, `iduser`, `fname`, `lname`, `email`, `billing_address`, `billing_note`, `delivery_address`, `unit_price`, `qty`, `sub_total`, `delivery_amount`, `discount_percentage`, `discount_amount`, `total`, `status`) VALUES
('IN2303270001', '2023-03-27 07:03:06', 'buy_partially', 'W2302270003', 'U2302270001', 'Dinuk', 'Ranaweera', 'dinuk.ranaweera@gmail.com', '10A Braddell Hill, #08-02,Singapore 579720', 'note', '10A Braddell Hill, #08-02,Singapore 579720', '250', '20', '5000', '2500', '10', '500', '7000', 2),
('IN2303270002', '2023-03-27 07:03:30', 'buy_partially', 'W2302270003', 'U2302270001', 'Dinuk', 'Heshan', 'dinuk.ranaweera@gmail.com', 'B4 Elivitigala Flats,Elvitigala Mawatha', 'Note 2222', 'B4 Elivitigala Flats,Elvitigala Mawatha', '250', '20', '5000', '2500', '10', '500', '7000', 2),
('IN2304050003', '2023-04-05 06:04:56', 'select_bid', 'W2302270002', 'U2302270001', 'Dinuk', 'Ranaweera', 'dinuk.ranaweera@gmail.com', '10A Braddell Hill, #08-02,Singapore 579720', 'Note 123', '10A Braddell Hill, #08-02,Singapore 579720', '0', '20', '13000', '3000', '0', '0', '16000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `idorder` varchar(11) NOT NULL DEFAULT 'O2302230001',
  `iddiscount` int(11) NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preferred_user_type`
--

CREATE TABLE `preferred_user_type` (
  `id_preferred_user_type` int(11) NOT NULL,
  `iduser_type` int(11) NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `preferred_time` varchar(45) DEFAULT NULL,
  `preferred_discount_leverage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `preferred_user_type`
--

INSERT INTO `preferred_user_type` (`id_preferred_user_type`, `iduser_type`, `idwastage`, `preferred_time`, `preferred_discount_leverage`) VALUES
(53, 1, 'W2302270001', '10', 100),
(54, 1, 'W2302270003', '18', 100),
(55, 2, 'W2302270003', '48', 80),
(56, 3, 'W2302270003', '48', 60),
(57, 2, 'W2302270002', '18', 80);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` varchar(11) NOT NULL DEFAULT 'U2302230001',
  `iduser_type` int(11) NOT NULL,
  `idcompany_reg` varchar(12) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 2 COMMENT '0= Inactive 1 = Active 2 = In Review 3 = Disable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `iduser_type`, `idcompany_reg`, `name`, `email`, `password`, `contact_no`, `created_at`, `updated_at`, `status`) VALUES
('U2302270001', 1, 'CM2302270001', 'Dinuk Ranaweera', 'dinuk.ranaweera@gmail.com', 'ac1964eb089654e01f7bfb4871e0cd31ea4d2aa6e6e48774b6b9917b1341dbf6', '0777234242', '2023-02-27 07:02:20', '2023-02-27 07:02:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `iduser_log` int(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `log` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`iduser_log`, `iduser`, `datetime`, `log`) VALUES
(1, 'U2302270001', '2023-04-08 10:04:41', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'),
(2, 'U2302270001', '2023-04-08 10:04:42', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(3, 'U2302270001', '2023-04-08 01:04:37', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(4, 'U2302270001', '2023-04-08 06:04:35', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(5, 'U2302270001', '2023-04-08 06:04:00', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(6, 'U2302270001', '2023-04-09 08:04:32', 'okhttp/3.14.9'),
(7, 'U2302270001', '2023-04-09 08:04:26', 'okhttp/3.14.9'),
(8, 'U2302270001', '2023-04-09 08:04:33', 'okhttp/3.14.9'),
(9, 'U2302270001', '2023-04-14 01:04:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(10, 'U2302270001', '2023-04-14 01:04:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(11, 'U2302270001', '2023-04-14 02:04:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.39'),
(12, 'U2302270001', '2023-04-15 10:04:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.46'),
(13, 'U2302270001', '2023-04-20 02:04:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.48'),
(14, 'U2302270001', '2023-04-20 02:04:16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(15, 'U2302270001', '2023-04-20 02:04:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0'),
(16, 'U2302270001', '2023-04-20 09:04:09', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(17, 'U2302270001', '2023-04-20 09:04:56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(18, 'U2302270001', '2023-04-20 09:04:27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(19, 'U2302270001', '2023-04-20 10:04:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `iduser_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `priority` varchar(45) DEFAULT NULL,
  `is_proof_needed` tinyint(4) DEFAULT NULL,
  `is_selling_allowed` tinyint(4) DEFAULT NULL,
  `discount_leverage` varchar(45) DEFAULT NULL,
  `preferred_name` varchar(45) DEFAULT NULL,
  `user_type_image` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`iduser_type`, `type`, `priority`, `is_proof_needed`, `is_selling_allowed`, `discount_leverage`, `preferred_name`, `user_type_image`, `status`) VALUES
(1, 'Community Kitchen', '1', 1, 1, '100', 'Organization', 'img/usertype/community-kitchen.png', 1),
(2, 'Pig Farm', '2', 1, 1, '80', 'Farm', 'img/usertype/pig-fram.png', 1),
(3, 'Bio Gas', '3', 1, 1, '60', 'Organization', 'img/usertype/bio-gas.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wastage`
--

CREATE TABLE `wastage` (
  `idwastage` varchar(11) NOT NULL DEFAULT 'W2302230001',
  `idcity` int(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `image` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `balance_qty` int(11) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `isnegotiable` tinyint(4) DEFAULT 0,
  `isbidding` tinyint(4) DEFAULT 0,
  `contact_no` varchar(10) DEFAULT NULL,
  `booked_by` varchar(45) DEFAULT NULL,
  `waste_type` varchar(45) DEFAULT NULL,
  `isseperate` tinyint(4) DEFAULT 0,
  `seperate_min_qty` int(11) UNSIGNED ZEROFILL DEFAULT 00000000000,
  `unit_price` double DEFAULT 0,
  `pick_up_address` text DEFAULT NULL,
  `is_delivery` tinyint(4) DEFAULT 0,
  `delivery_price` double DEFAULT 0,
  `status` int(11) DEFAULT 3 COMMENT '0 - Inactive 1 - Active  2 - In Review  3 - Disable 4-Sold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wastage`
--

INSERT INTO `wastage` (`idwastage`, `idcity`, `iduser`, `image`, `date`, `title`, `description`, `qty`, `balance_qty`, `unit`, `total_price`, `isnegotiable`, `isbidding`, `contact_no`, `booked_by`, `waste_type`, `isseperate`, `seperate_min_qty`, `unit_price`, `pick_up_address`, `is_delivery`, `delivery_price`, `status`) VALUES
('W2302270001', 1, 'U2302270001', 'post/CM2302270001/Wastey_27022023085211785127.jpeg', '2023-03-25 08:02:22', 'I have cooked Koththu', 'I have 200 chicken koththu. we made for birthday event ', 200, 200, 'packs', 200000, 1, 1, '0777883494', '', 'Cooked', 1, 00000000100, 800, '156/18 Kaluwala Road, Ganemulla', 1, 450, 0),
('W2302270002', 1, 'U2302270001', 'post/CM2302270001/assortment-different-trashed-objects.jpg', '2023-04-22 11:02:53', 'I have waste foods', 'i have waste food only vegetables ', 20, 20, 'kg', 12000, 1, 1, '0777882342', 'U2302270001', 'Waste', 0, 00000000000, 0, '156 Pothuarawa Road, Malabe', 1, 3000, 1),
('W2302270003', 1, 'U2302270001', 'post/CM2302270001/Wastey_27022023085733661135.webp', '2023-04-21 12:02:59', 'I have row foodss', 'i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. ', 400, 40, 'kg', 200000, 1, 1, '0777342342', 'U2302270001', 'Raw', 1, 00000000020, 250, 'No. 07, Meepe, Ingiriya Road, Padukka 10500, Sri Lanka', 1, 2500, 0),
('W2302270004', 1, 'U2302270001', 'post/CM2302270001/Wastey_27022023085733661135.webp', '2023-04-21 12:02:59', 'I have row foodss', 'i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. i have row foods. want to sell immediately. ', 400, 40, 'kg', 200000, 1, 1, '0777342342', 'U2302270001', 'Raw', 1, 00000000020, 250, 'No. 07, Meepe, Ingiriya Road, Padukka 10500, Sri Lanka', 1, 2500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wastage_review`
--

CREATE TABLE `wastage_review` (
  `idwastage_review` int(11) NOT NULL,
  `idwastage` varchar(11) NOT NULL,
  `iduser` varchar(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `image_url` varchar(45) DEFAULT NULL,
  `suggested_user_type` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `bidding_wastage`
--
ALTER TABLE `bidding_wastage`
  ADD PRIMARY KEY (`id_bidding`),
  ADD KEY `fk_bidding_wastage_user1_idx` (`iduser`),
  ADD KEY `fk_bidding_wastage_wastage1_idx` (`idwastage`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`idcity`),
  ADD KEY `fk_city_district1_idx` (`iddistrict`);

--
-- Indexes for table `company_reg`
--
ALTER TABLE `company_reg`
  ADD PRIMARY KEY (`idcompany_reg`),
  ADD KEY `fk_company_reg_city1_idx` (`idcity`);

--
-- Indexes for table `delivery_tracker`
--
ALTER TABLE `delivery_tracker`
  ADD PRIMARY KEY (`iddelivery_tracker`),
  ADD KEY `fk_delivery_tracker_invoice1_idx` (`idinvoice`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_code`),
  ADD UNIQUE KEY `discount_code_UNIQUE` (`discount_code`),
  ADD KEY `fk_discount_wastage1_idx` (`idwastage`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`iddistrict`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`idinvoice`),
  ADD KEY `fk_invoice_wastage1_idx` (`idwastage`),
  ADD KEY `fk_invoice_user1_idx` (`iduser`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `fk_order_wastage1_idx` (`idwastage`),
  ADD KEY `fk_order_user1_idx` (`iduser`);

--
-- Indexes for table `preferred_user_type`
--
ALTER TABLE `preferred_user_type`
  ADD PRIMARY KEY (`id_preferred_user_type`),
  ADD KEY `fk_user_type_has_wastage_user_type1_idx` (`iduser_type`),
  ADD KEY `fk_preferred_user_type_wastage1_idx` (`idwastage`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `fk_user_user_type_idx` (`iduser_type`),
  ADD KEY `fk_user_company_reg1_idx` (`idcompany_reg`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`iduser_log`),
  ADD KEY `fk_user_log_user1_idx` (`iduser`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`iduser_type`);

--
-- Indexes for table `wastage`
--
ALTER TABLE `wastage`
  ADD PRIMARY KEY (`idwastage`),
  ADD KEY `fk_wastage_city1_idx` (`idcity`),
  ADD KEY `fk_wastage_user1_idx` (`iduser`);

--
-- Indexes for table `wastage_review`
--
ALTER TABLE `wastage_review`
  ADD PRIMARY KEY (`idwastage_review`),
  ADD KEY `fk_wastage_review_wastage1_idx` (`idwastage`),
  ADD KEY `fk_wastage_review_user1_idx` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `idcity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_tracker`
--
ALTER TABLE `delivery_tracker`
  MODIFY `iddelivery_tracker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `iddistrict` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `preferred_user_type`
--
ALTER TABLE `preferred_user_type`
  MODIFY `id_preferred_user_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `iduser_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wastage_review`
--
ALTER TABLE `wastage_review`
  MODIFY `idwastage_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidding_wastage`
--
ALTER TABLE `bidding_wastage`
  ADD CONSTRAINT `fk_bidding_wastage_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `fk_bidding_wastage_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_district1` FOREIGN KEY (`iddistrict`) REFERENCES `district` (`iddistrict`);

--
-- Constraints for table `company_reg`
--
ALTER TABLE `company_reg`
  ADD CONSTRAINT `fk_company_reg_city1` FOREIGN KEY (`idcity`) REFERENCES `city` (`idcity`);

--
-- Constraints for table `delivery_tracker`
--
ALTER TABLE `delivery_tracker`
  ADD CONSTRAINT `fk_delivery_tracker_invoice1` FOREIGN KEY (`idinvoice`) REFERENCES `invoice` (`idinvoice`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `fk_discount_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `fk_invoice_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `fk_order_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`);

--
-- Constraints for table `preferred_user_type`
--
ALTER TABLE `preferred_user_type`
  ADD CONSTRAINT `fk_preferred_user_type_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`),
  ADD CONSTRAINT `fk_user_type_has_wastage_user_type1` FOREIGN KEY (`iduser_type`) REFERENCES `user_type` (`iduser_type`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_company_reg1` FOREIGN KEY (`idcompany_reg`) REFERENCES `company_reg` (`idcompany_reg`),
  ADD CONSTRAINT `fk_user_user_type` FOREIGN KEY (`iduser_type`) REFERENCES `user_type` (`iduser_type`);

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `fk_user_log_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Constraints for table `wastage`
--
ALTER TABLE `wastage`
  ADD CONSTRAINT `fk_wastage_city1` FOREIGN KEY (`idcity`) REFERENCES `city` (`idcity`),
  ADD CONSTRAINT `fk_wastage_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Constraints for table `wastage_review`
--
ALTER TABLE `wastage_review`
  ADD CONSTRAINT `fk_wastage_review_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `fk_wastage_review_wastage1` FOREIGN KEY (`idwastage`) REFERENCES `wastage` (`idwastage`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



