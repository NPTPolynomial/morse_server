-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2016 at 03:23 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `morse`
--

-- --------------------------------------------------------

--
-- Table structure for table `central_global_vars`
--

CREATE TABLE `central_global_vars` (
  `global_var` varchar(15) NOT NULL,
  `value` varchar(10) NOT NULL,
  PRIMARY KEY (`global_var`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `central_global_vars`
--

INSERT INTO `central_global_vars` (`global_var`, `value`) VALUES
('level', '3'),
('missing', '1'),
('wifi_sig_high', '30'),
('wifi_sig_low', '-55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
