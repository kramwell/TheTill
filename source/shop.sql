-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2022 at 08:18 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `code` varchar(4) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `cost_price` varchar(5) NOT NULL,
  `retail_price` varchar(5) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  `promo_price` varchar(5) NOT NULL,
  `promo_amount` varchar(5) NOT NULL,
  `serial_number` varchar(10) NOT NULL,
  `supplier` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `reorder_level` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`code`, `item_name`, `cost_price`, `retail_price`, `quantity`, `promo_price`, `promo_amount`, `serial_number`, `supplier`, `location`, `reorder_level`, `category`, `description`) VALUES
('0001', 'tennis ball', '0.25', '0.40', '10', '', '', '', '', '', '', '', ''),
('0002', 'shoes', '1', '2', '5', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `code` varchar(30) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `retail_price` varchar(30) NOT NULL,
  `quantity` varchar(30) NOT NULL,
  `trans_id` varchar(20) NOT NULL,
  `ucode` varchar(20) NOT NULL,
  PRIMARY KEY (`ucode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
