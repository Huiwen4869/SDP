-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2020 at 04:29 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `act_date` varchar(255) NOT NULL,
  `stk_id` int(11) NOT NULL,
  PRIMARY KEY (`act_id`),
  KEY `emp_id` (`emp_id`),
  KEY `ord_id` (`stk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `stk_name` varchar(255) NOT NULL,
  `ord_quantity` varchar(255) NOT NULL,
  `stk_price` varchar(255) NOT NULL,
  `car_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`car_id`),
  KEY `stk_id` (`stk_id`,`cus_id`),
  KEY `cus_id` (`cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'table'),
(5, 'Leathers');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_email` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_password` varchar(255) NOT NULL,
  `cus_address` varchar(255) DEFAULT NULL,
  `cus_phone` varchar(255) DEFAULT NULL,
  `cus_gender` varchar(255) DEFAULT NULL,
  `cus_img` varchar(255) DEFAULT NULL,
  `cus_date` date DEFAULT NULL,
  PRIMARY KEY (`cus_id`),
  KEY `cus_name` (`cus_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_email`, `cus_name`, `cus_password`, `cus_address`, `cus_phone`, `cus_gender`, `cus_img`, `cus_date`) VALUES
(1, 'hhh@gmail.com', 'hhh', '$2y$10$.WDKc5cpM/Cggnomc3K6nulsePYvu/qNjAO2N01cRUil615YwSyCu', '19, jalan testing, taman testing,85000, johor', '01152566331', 'Female', 'img/5e777b7049f4a.jpg', '2020-02-13'),
(2, 'test1@gmail.com', 'test1', '$2y$10$wd/loPsXPOVl07NBdCHM2uQix.VLBrRuay4GpruPXrGlEuzDN285m', NULL, NULL, NULL, NULL, '2020-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(255) DEFAULT NULL,
  `emp_email` varchar(255) DEFAULT NULL,
  `emp_phone` int(255) DEFAULT NULL,
  `emp_address` varchar(255) DEFAULT NULL,
  `emp_gender` varchar(255) DEFAULT NULL,
  `emp_password` varchar(255) DEFAULT NULL,
  `emp_img` text,
  `emp_position` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_email`, `emp_phone`, `emp_address`, `emp_gender`, `emp_password`, `emp_img`, `emp_position`, `manager_id`) VALUES
(18, 'admin', 'admin@gmail.com', 123456789, 'admin,jalan admin', 'male', '$2y$10$HiQ.k2y85SAZA/QIGTSFtegdOU6m.3Nu8LUYDePI1f7XiQwvRZz3m', '5e78c143bc4b0.jpg', 'manager', 1),
(20, 'test2', 'test2@gmail.com', 1121255221, '19,jalangorila,tamangorila', 'male', '123456', '5e8496f7b2618.jpg', 'employee', 0),
(23, 'test3', 'test3@gmail.com', 1236548452, '19,jalangorila,tamangorila', 'female', '$2y$10$2.Y0q/0DE4zgvRUJ4oh9heEprl7mhuyJRHATrCgIF65tULeLOC3m.', '5e849f0697871.jpg', 'employee', 0),
(24, 'test', 'test@gmail.com', 1236548452, '19,jalangorila,tamangorila', 'female', '$2y$10$tN4cfhlsxVQGpFha1UuUyOUSVvs00LgQ7PA61pVcsR4zF7AeK2Y42', '5e8731a324efd.jpeg', 'employee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `fee_comment` varchar(255) NOT NULL,
  PRIMARY KEY (`fee_id`),
  KEY `cus_id` (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fee_id`, `cus_id`, `cus_name`, `fee_comment`) VALUES
(1, 1, 'hhh', 'testing'),
(2, 1, 'hhh', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `man_id` int(11) NOT NULL AUTO_INCREMENT,
  `man_name` varchar(255) NOT NULL,
  `man_phone` varchar(255) NOT NULL,
  `man_email` varchar(255) NOT NULL,
  PRIMARY KEY (`man_id`),
  KEY `man_name` (`man_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`man_id`, `man_name`, `man_phone`, `man_email`) VALUES
(1, 'IKEA', '01234567', 'ikea@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ord_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `cus_address` varchar(255) DEFAULT NULL,
  `cus_phone` varchar(255) DEFAULT NULL,
  `ord_quantity` int(11) NOT NULL,
  `ord_price` varchar(255) DEFAULT NULL,
  `ord_status` varchar(255) DEFAULT NULL,
  `ord_time` datetime DEFAULT NULL,
  PRIMARY KEY (`ord_id`),
  KEY `cus_id` (`cus_id`,`cus_address`,`cus_phone`),
  KEY `stk_id` (`stk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `stk_id`, `cus_id`, `cus_address`, `cus_phone`, `ord_quantity`, `ord_price`, `ord_status`, `ord_time`) VALUES
(4, 2, 1, '19, jalan testing, taman testing,85000, johor', '01152566331', 3, '1400', 'Payed', '2020-04-02 04:04:25'),
(5, 3, 1, '19, jalan testing, taman testing,85000, johor', '01152566331', 2, '1050', 'Payed', '2020-04-02 04:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stk_id` int(11) NOT NULL AUTO_INCREMENT,
  `stk_img` varchar(255) NOT NULL,
  `stk_name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `man_id` int(11) NOT NULL,
  `man_name` varchar(255) NOT NULL,
  `stk_productiondate` longtext NOT NULL,
  `stk_cost` varchar(255) NOT NULL,
  `stk_price` varchar(255) NOT NULL,
  `stk_width` int(11) NOT NULL,
  `stk_height` int(11) NOT NULL,
  `stk_description` varchar(255) NOT NULL,
  `stk_quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`stk_id`),
  KEY `cat_id` (`cat_id`,`cat_name`),
  KEY `man_id` (`man_id`,`man_name`),
  KEY `man_name` (`man_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stk_id`, `stk_img`, `stk_name`, `cat_id`, `cat_name`, `man_id`, `man_name`, `stk_productiondate`, `stk_cost`, `stk_price`, `stk_width`, `stk_height`, `stk_description`, `stk_quantity`) VALUES
(2, 'upload/5e7080f86a97a.jpg', 'LINNMON / ALEX', 1, 'table', 1, 'IKEA', '2020-03-17', '698', '700', 80, 60, 'testing2', 97),
(3, 'upload/5e7082a5aaf2d.jpg', 'NORDKISA', 1, 'table', 1, 'IKEA', '2020-03-17', '299', '350', 40, 67, 'NORDKISA series in bamboo coordinates beautifully with both our NORDLI and ELVARLI storage series.', 97),
(6, 'upload/5e835ae15771c.png', 'EKTORP', 5, 'Leather Sofa', 1, 'IKEA', '2020-03-31', '1,095', '2000', 218, 88, 'Seat cushions filled with high resilience foam and polyester fibre wadding give comfortable support for your body, and easily regain their shape when you get up', 20);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `action_ibfk_2` FOREIGN KEY (`stk_id`) REFERENCES `stock` (`stk_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`stk_id`) REFERENCES `stock` (`stk_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`man_id`) REFERENCES `manufacturer` (`man_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
