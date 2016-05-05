-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2016 at 08:38 AM
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
-- Table structure for table `central_hub`
--

CREATE TABLE `central_hub` (
  `node` varchar(8) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  PRIMARY KEY (`node`),
  UNIQUE KEY `node` (`node`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `central_hub`
--

INSERT INTO `central_hub` (`node`, `timestamp`) VALUES
('a', '2016-05-05 08:15'),
('b', '2016-05-05 08:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
