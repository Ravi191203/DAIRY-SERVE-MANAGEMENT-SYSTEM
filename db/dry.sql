-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 07, 2024 at 07:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dry`
--
CREATE DATABASE IF NOT EXISTS `dry` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dry`;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `bill_id` int(3) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `farmer_id` int(3) DEFAULT NULL,
  `farmer_name` varchar(20) DEFAULT NULL,
  `center_id` int(3) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `customer_id`, `farmer_id`, `farmer_name`, `center_id`, `quantity`, `amount`) VALUES
(31, NULL, 1, 'Ravi kumar', 1, 17, 969),
(32, NULL, 1, 'Ravi kumar', 1, 17, 969),
(33, NULL, 1, 'Ravi kumar', 1, 17, 969),
(34, NULL, 1, 'Ravi kumar', 1, 17, 969),
(35, NULL, 1, 'Ravi kumar', 1, 17, 969),
(36, NULL, 1, 'Ravi kumar', 1, 17, 969),
(37, NULL, 1, 'Ravi kumar', 1, 17, 969),
(38, NULL, 1, 'Ravi kumar', 1, 17, 969),
(39, NULL, 1, 'Ravi kumar', 1, 17, 969),
(40, NULL, 1, 'Ravi kumar', 1, 17, 969),
(41, NULL, 1, 'Ravi kumar', 1, 17, 969),
(42, NULL, 1, 'Ravi kumar', 1, 17, 969),
(43, NULL, 1, 'Ravi kumar', 1, 17, 969),
(44, NULL, 1, 'Ravi kumar', 1, 17, 969),
(45, NULL, 1, 'Ravi kumar', 1, 17, 969),
(46, NULL, 1, 'Ravi kumar', 1, 17, 969),
(47, NULL, 1, 'Ravi kumar', 1, 17, 969),
(48, NULL, 1, 'Ravi kumar', 1, 17, 969),
(49, NULL, 1, 'Ravi kumar', 1, 17, 969),
(50, NULL, 1, 'Ravi kumar', 1, 17, 969),
(51, NULL, 1, 'Ravi kumar', 1, 17, 969),
(52, NULL, 1, 'Ravi kumar', 1, 17, 969),
(53, NULL, 1, 'Ravi kumar', 1, 17, 969),
(54, NULL, 16, 'Ravi', NULL, 20, 800),
(55, NULL, 16, 'Ravi', NULL, 20, 800),
(56, NULL, 16, 'Ravi', NULL, 20, 800),
(57, NULL, 16, 'Ravi', NULL, 20, 800),
(58, NULL, 16, 'Ravi', NULL, 20, 800),
(59, NULL, 16, 'Ravi', NULL, 20, 800),
(60, NULL, 16, 'Ravi', NULL, 20, 800),
(61, NULL, 16, 'Ravi', NULL, 20, 800),
(62, NULL, 16, 'Ravi', NULL, 20, 800),
(63, NULL, 16, 'Ravi', NULL, 20, 800),
(64, NULL, 16, 'Ravi', NULL, 20, 800),
(65, NULL, 16, 'Ravi', NULL, 20, 800),
(66, NULL, 16, 'Ravi', NULL, 20, 800),
(67, NULL, 16, 'Ravi', NULL, 30, 1200),
(68, NULL, 16, 'Ravi', NULL, 30, 1200),
(69, NULL, 16, 'Ravi', NULL, 30, 1200),
(70, NULL, 16, 'Ravi', NULL, 30, 0),
(71, NULL, 18, 'Rahul', NULL, 20, 800);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `customer_id`, `amount`, `date`) VALUES
(1, 1, '100.00', '2024-06-13'),
(2, 4, '200.00', '2024-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_email` (`customer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_mobile`, `customer_email`, `customer_address`) VALUES
(40, 'Ravi Raghavendra G S', '8088590270', NULL, ''),
(41, 'Ravi Raghavendra G S', '8088590270', NULL, ''),
(42, 'Ravi Raghavendra G S', '8088590270', NULL, ''),
(43, 'Ravi Raghavendra G S', '8088590270', NULL, ''),
(44, 'Ravi ', '8088590270', NULL, ''),
(45, 'Ravi Raghavendra G Raghavendra', '8088590270', NULL, ''),
(46, 'Ravi Raghavendra G Raghavendra', '8088590270', NULL, ''),
(47, 'dsad', 'dddddddd', NULL, ''),
(48, 'd', '123', NULL, ''),
(49, 'd', '123', NULL, ''),
(50, 'd', '123', NULL, ''),
(51, 'd', '123', NULL, ''),
(52, 'd', '123', NULL, ''),
(53, 'd', '123', NULL, ''),
(54, 'asdf', 'asdf', NULL, ''),
(55, 'xza', 'sad', NULL, ''),
(56, 'xza', 'sad', NULL, ''),
(57, 'd', '123', NULL, ''),
(58, 'Rahul V', '9845893388', NULL, ''),
(59, 'Rahul V', '9845893388', NULL, ''),
(60, 'Rahul V', '9845893388', NULL, ''),
(61, 'Tejaswi', '4639854935', 'trr@gamil.com', ''),
(62, 'Ravi Raghavendra G Raghavendra', '8088590270', 'df@gmail.com', ''),
(63, 'Ravi Raghavendra G S', '8088590270', 'r@gmail.com', 'Vanitha printers 1084 Manasara Road Ittige Gudu');

-- --------------------------------------------------------

--
-- Table structure for table `daily_data`
--

CREATE TABLE IF NOT EXISTS `daily_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `farmer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `milk_qty` decimal(10,2) NOT NULL,
  `fat` decimal(5,2) NOT NULL,
  `snf` decimal(5,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_id` (`farmer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `daily_data`
--

INSERT INTO `daily_data` (`id`, `farmer_id`, `date`, `milk_qty`, `fat`, `snf`, `rate`) VALUES
(2, 18, '2024-06-11', '20.00', '23.00', '22.00', '30.00'),
(3, 18, '2024-07-09', '10.00', '2.00', '11.00', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `dairy_customers`
--

CREATE TABLE IF NOT EXISTS `dairy_customers` (
  `invoice_id` int(200) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(200) NOT NULL,
  `customer_mobile` int(100) NOT NULL,
  `Total_cost` int(200) NOT NULL,
  `PR1` varchar(100) NOT NULL,
  `PR2` varchar(100) NOT NULL,
  `PR3` varchar(100) NOT NULL,
  `PR4` varchar(100) NOT NULL,
  `PR5` varchar(100) NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `eid` int(5) NOT NULL AUTO_INCREMENT,
  `ename` varchar(30) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `salary` int(5) NOT NULL,
  `designation` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12369 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `ename`, `phno`, `salary`, `designation`, `address`) VALUES
(12336, 'govind', '9441733995', 300, 'staff', 'kurnool'),
(12337, 'gpoal', '9441733996', 3000, 'staff', 'kurnool'),
(12338, 'ramya', '9441733998', 3000, 'staff', 'kurnool'),
(12339, 'rashi', '9441733999', 3000, 'staff', 'kurnool'),
(12340, 'priya', '9441733910', 3000, 'staff', 'kurnool'),
(12341, 'sudheeer', '9441733912', 3000, 'staff', 'kurnool'),
(12342, 'girish', '9441733913', 3000, 'staff', 'kurnool'),
(12344, 'rehman', '9441733914', 3000, 'staff', 'kurnool'),
(12345, 'ravi', '9908407185', 20000, 'staff', 'kurnool'),
(12346, 'Rahul V', '8688764855', 30000, 'Manager', 'Halle Kesare'),
(12347, 'rasi', '9908407285', 3000, 'manager', 'kudapa'),
(12348, 'nani', '9666613357', 3000, 'manager', 'kurnool'),
(12349, 'Ravi', '9909090909', 1000, 'staff', 'mys'),
(12354, 'Ravi Raghavendra G S', '0808859027', 1111, 'Worker', '#1084 Manasara Road Ittigegudu'),
(12356, 'V Rahul', '9103052003', 30000, 'worker', 'hallekesare'),
(12357, 'PRATHAP B', '9103052003', 9000, 'Manager', 'MUGURU'),
(12359, 'Ravi Raghavendra G S', '0808859027', 20000, 'manager', '#1084 Manasara Road Ittigegudu'),
(12360, 'Ravi Raghavendra G S', '0808859027', 11111, 'God', '#1084 Manasara Road Ittigegudu'),
(12361, 'Ravi Raghavendra G S', '0808859027', 11111, 'Worker', '#1084 Manasara Road Ittigegudu'),
(12363, 'Ravi Raghavendra G S', '0808859027', 11111, 'Worker', '#1084 Manasara Road Ittigegudu'),
(12368, 'Rahul', '3453', 2000, 'ww', 'ITTIGEGUD, MANASARA ROAD');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE IF NOT EXISTS `farmer` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `ph` varchar(10) NOT NULL,
  `f_vid` int(3) NOT NULL,
  `milk_type` text NOT NULL,
  `min_litre` int(2) NOT NULL,
  `reg_date` date NOT NULL,
  `animalID` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`id`, `fname`, `ph`, `f_vid`, `milk_type`, `min_litre`, `reg_date`, `animalID`) VALUES
(1, 'Ravi kumar', '9441733999', 1, 'Buffelow', 20, '2021-07-23', 1),
(2, 'Suresh', '9441733912', 2, 'Cow', 15, '2021-07-21', 2),
(3, 'Mani', '9441733913', 3, 'Buffelow', 5, '2021-07-25', 3),
(4, 'Lokesh ', '9441733998', 3, 'Cow', 2, '2021-07-26', 4),
(5, 'Ramu', '9441733914', 1, 'Buffelow', 6, '2021-07-26', 1),
(6, 'Pavan', '9441733910', 2, 'Cow', 5, '2021-07-26', 2),
(18, 'Rahul', '9090888000', 18, 'cow', 21, '2024-06-11', 111);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Rahul', 'raviraghavendrags@gmail.com', '3453', 'sda', '2024-06-23 16:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `milkdaily`
--

CREATE TABLE IF NOT EXISTS `milkdaily` (
  `d_id` int(5) NOT NULL AUTO_INCREMENT,
  `d_date` date NOT NULL,
  `f_id` int(3) NOT NULL,
  `morning` float NOT NULL,
  `evening` float NOT NULL,
  `total` float NOT NULL,
  `accepted` float NOT NULL,
  `rejected` float NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `milkdaily`
--

INSERT INTO `milkdaily` (`d_id`, `d_date`, `f_id`, `morning`, `evening`, `total`, `accepted`, `rejected`) VALUES
(1, '2021-07-01', 1, 10, 10, 20, 20, 0),
(2, '2021-07-02', 1, 10, 10, 20, 20, 0),
(3, '2021-07-03', 1, 10, 10, 20, 20, 0),
(4, '2021-07-04', 1, 10, 10, 20, 20, 0),
(5, '2021-07-05', 1, 10, 10, 20, 20, 0),
(6, '2021-07-06', 1, 10, 10, 20, 20, 0),
(7, '2021-07-07', 1, 10, 10, 20, 20, 0),
(8, '2021-07-08', 1, 10, 10, 20, 20, 0),
(9, '2021-07-09', 1, 10, 10, 20, 20, 0),
(10, '2021-07-10', 1, 10, 10, 20, 20, 0),
(11, '2021-07-11', 1, 10, 10, 20, 20, 0),
(12, '2021-07-12', 1, 10, 10, 20, 20, 0),
(13, '2021-07-13', 1, 10, 10, 20, 20, 0),
(14, '2021-07-14', 1, 10, 10, 20, 20, 0),
(15, '2021-07-15', 1, 10, 10, 20, 20, 0),
(16, '2021-07-16', 1, 10, 10, 20, 20, 0),
(17, '2021-07-17', 1, 10, 10, 20, 20, 0),
(18, '2021-07-18', 1, 10, 10, 20, 20, 0),
(19, '2021-07-19', 1, 10, 10, 20, 20, 0),
(20, '2021-07-20', 1, 10, 10, 20, 20, 0),
(21, '2021-07-21', 1, 10, 10, 20, 20, 0),
(22, '2021-07-22', 1, 10, 10, 20, 20, 0),
(23, '2021-07-23', 1, 10, 10, 20, 20, 0),
(24, '2021-07-24', 1, 10, 10, 20, 20, 0),
(25, '2021-07-25', 1, 10, 10, 20, 20, 0),
(26, '2021-07-26', 1, 10, 10, 20, 20, 0),
(27, '2021-07-27', 1, 10, 10, 20, 20, 0),
(28, '2021-07-28', 1, 10, 10, 20, 20, 0),
(29, '2021-07-29', 1, 10, 10, 20, 20, 0),
(30, '2021-07-30', 1, 10, 10, 20, 20, 0),
(31, '2021-07-31', 1, 10, 10, 20, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`, `is_read`) VALUES
(1, 1, 'New product added: Ice Cream', '2024-06-13 07:18:46', 0),
(2, 1, 'New product added: xx', '2024-06-17 19:56:10', 0),
(3, 1, 'New product added: xx', '2024-06-17 19:58:41', 0),
(4, 1, 'New product added: Cone', '2024-06-17 20:09:24', 0),
(5, 1, 'New product added: BOX ICE', '2024-06-17 20:10:31', 0),
(6, 1, 'New product added: Box Ice', '2024-06-17 20:11:53', 0),
(7, 1, 'New product added: b', '2024-06-23 23:10:54', 0),
(8, 1, 'New product added: Curd', '2024-06-23 23:17:31', 0),
(9, 1, 'New product added: Cheese', '2024-06-23 23:18:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `payment_mode` enum('offline','online') NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `total_cost`, `payment_mode`, `transaction_id`, `status`, `order_date`, `username`) VALUES
(60, 58, '401.00', 'online', '176547213', 'pending', '2024-06-22 11:45:38', 'Test@123'),
(62, 60, '411.00', 'online', '564654654', 'pending', '2024-06-23 13:04:32', 'Test@123'),
(63, 61, '26.00', 'offline', '', 'approved', '2024-06-30 14:33:02', 'Test@123'),
(64, 62, '441.00', 'online', '', 'approved', '2024-07-07 07:04:21', 'Test@123456'),
(65, 63, '401.00', 'offline', '', 'approved', '2024-07-07 07:26:13', 'Test@123');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(78, 60, 206, 1),
(80, 62, 207, 1),
(81, 63, 219, 1),
(82, 64, 206, 1),
(83, 64, 215, 2),
(84, 65, 206, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `stock_status` enum('in_stock','out_of_stock') DEFAULT 'in_stock',
  `stock_quantity` int(11) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=221 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `image_path`, `stock_status`, `stock_quantity`) VALUES
(206, 'Ghee 1 L', '401.00', '../images/g.png', 'in_stock', 91),
(207, 'Sweet 1 KG', '411.00', '../images/product27.jpg', 'in_stock', 198),
(208, 'Butter 1 KG', '510.00', '../images/b.png', 'out_of_stock', 0),
(211, 'Panner', '120.00', '../images/p.png', 'in_stock', 100),
(215, 'Cone', '20.00', '../images/cone.png', 'in_stock', 58),
(217, 'Box Ice', '200.00', '../images/boxice.png', 'out_of_stock', 0),
(218, 'Milk 1L', '52.00', '../images/product1.png', 'in_stock', 100),
(219, 'Curd', '26.00', '../images/product2.jpg', 'in_stock', 299),
(220, 'Cheese', '150.00', '../images/product6.jpg', 'in_stock', 50);

-- --------------------------------------------------------

--
-- Table structure for table `products1`
--

CREATE TABLE IF NOT EXISTS `products1` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products1`
--

INSERT INTO `products1` (`product_id`, `product_name`, `product_cost`) VALUES
(209, 'Buffalo Milk', '50.00'),
(210, 'Cow Milk', '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `r_id` int(3) NOT NULL AUTO_INCREMENT,
  `f_id` int(3) DEFAULT NULL,
  `rate` int(3) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`r_id`, `f_id`, `rate`) VALUES
(1, 1, 57),
(2, 2, 45),
(3, 3, 50),
(4, 4, 60);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `date` date NOT NULL,
  `fid` int(100) NOT NULL,
  `quan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`date`, `fid`, `quan`) VALUES
('2024-05-30', 16, 20),
('2024-05-31', 16, 10),
('2024-06-03', 16, 22),
('2024-06-05', 16, 20),
('2024-06-05', 16, 20),
('1970-01-01', 0, 0),
('1970-01-01', 0, 0),
('2024-06-05', 16, 20),
('2024-06-05', 16, 20),
('2024-06-05', 16, 10),
('2024-06-05', 16, 10),
('2024-06-07', 16, 10),
('2024-06-05', 16, 10),
('2024-06-05', 16, 10),
('2024-06-05', 16, 10),
('2024-06-05', 17, 10),
('2024-06-05', 17, 10),
('2024-06-04', 17, 10),
('2024-06-05', 18, 10),
('2024-06-13', 16, 10),
('2024-06-06', 18, 10),
('2024-06-07', 18, 20),
('2024-06-17', 18, 20),
('2024-07-03', 18, 21);

-- --------------------------------------------------------

--
-- Table structure for table `sscustomers`
--

CREATE TABLE IF NOT EXISTS `sscustomers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sscustomers`
--

INSERT INTO `sscustomers` (`customer_id`, `customer_name`, `email`, `phone`, `address`) VALUES
(1, 'John Doe', 'johndoe@example.com', '123-456-7890', '123 Main St, City, Country'),
(2, 'Jane Smith', 'janesmith@example.com', '987-654-3210', '456 Oak Ave, Town, Country'),
(3, 'Michael Johnson', 'michaeljohnson@example.com', '567-890-1234', '789 Elm Rd, Village, Country');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`) VALUES
(1, 'raviraghavendrags@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','farmer','buyer') NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`) VALUES
(1, 'Test@123', 'c4ca4238a0b923820dcc509a6f75849b', 'buyer', 'raviraghavendrags@gmail.com'),
(37, 'admin', 'e3274be5c857fb42ab72d786e281b4b8', 'admin', 'tejaswirrao@gmail.com'),
(49, 'Test@1234', '8fa14cdd754f91cc6554c9e71929cce7', 'farmer', 'niranjans5812@gmail.com'),
(51, 'Test@12345', '03c7c0ace395d80182db07ae2c30f034', 'staff', 'htmlbyrrgs@gmail.com'),
(52, 'Test@123456', '202cb962ac59075b964b07152d234b70', 'buyer', 'rsachinsachi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `fid` int(5) NOT NULL,
  `center_id` int(3) NOT NULL,
  PRIMARY KEY (`fid`,`center_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`fid`, `center_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_data`
--
ALTER TABLE `daily_data`
  ADD CONSTRAINT `fk_daily_data_farmer_id` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
