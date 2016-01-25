-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2016 at 01:51 AM
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
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `board_id` int(12) NOT NULL AUTO_INCREMENT,
  `from` varchar(10) NOT NULL,
  `to` varchar(10) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`board_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`board_id`, `from`, `to`, `message`) VALUES
(1, 'a', 'b', 'hello b'),
(2, 'b', 'a', 'hello back a'),
(3, 'c', 'b', 'Hello b, long time no see'),
(4, 'a', 'b', 'hello'),
(5, 'a', 'b', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `table_a`
--

CREATE TABLE `table_a` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `instruct` varchar(35) NOT NULL,
  `to` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_b`
--

CREATE TABLE `table_b` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `instruct` varchar(35) NOT NULL,
  `to` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `table_b`
--

INSERT INTO `table_b` (`date`, `id`, `instruct`, `to`, `end`) VALUES
('2016-01-24 23:44:38', 1, 'hello', 'a', '1'),
('2016-01-25 00:11:31', 2, 'a', 'hello', '0'),
('2016-01-25 00:12:02', 3, 'hello', 'a', '0'),
('2016-01-25 00:15:34', 4, 'hello', 'a', '0'),
('2016-01-25 00:23:59', 5, 'hello', 'a', '0'),
('2016-01-25 00:24:13', 6, 'hello', 'a', '0'),
('2016-01-25 00:30:00', 7, 'hello', 'a', '0'),
('2016-01-25 00:30:43', 8, 'hello', 'a', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
