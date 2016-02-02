-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2016 at 04:28 AM
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
CREATE DATABASE `morse` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `morse`;

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

DROP TABLE IF EXISTS `board`;
CREATE TABLE `board` (
  `board_id` int(12) NOT NULL AUTO_INCREMENT,
  `from` varchar(10) NOT NULL,
  `to` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `dial_id` varchar(30) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`board_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`board_id`, `from`, `to`, `message`, `dial_id`, `count`) VALUES
(1, 'a', 'b', 'hello b', '0', 0),
(2, 'b', 'a', 'hello back a', '0', 0),
(3, 'c', 'b', 'Hello b, long time no see', '0', 0),
(4, 'a', 'b', 'hello', '0', 0),
(5, 'a', 'b', 'hello', '0', 0),
(6, 'b', 'a', 'helolololol', '0', 0),
(7, 'c', 'd', 'kugvkjhbljhbl', '2200', 0),
(8, 'a', 'b', 'message', '0', 0),
(9, 'a', 'b', 'hello', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dialog`
--

DROP TABLE IF EXISTS `dialog`;
CREATE TABLE `dialog` (
  `dial_id` varchar(12) NOT NULL,
  `dial_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dialog`
--

INSERT INTO `dialog` (`dial_id`, `dial_message`) VALUES
('0', 'Hello!'),
('1', 'HOW YOU DOING?'),
('2200', 'Leo is in the way!');

-- --------------------------------------------------------

--
-- Table structure for table `ran`
--

DROP TABLE IF EXISTS `ran`;
CREATE TABLE `ran` (
  `ran_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(30) NOT NULL,
  PRIMARY KEY (`ran_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ran`
--

INSERT INTO `ran` (`ran_id`, `message`) VALUES
(1, 'henry');

-- --------------------------------------------------------

--
-- Table structure for table `table_a`
--

DROP TABLE IF EXISTS `table_a`;
CREATE TABLE `table_a` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `instruct` varchar(35) NOT NULL,
  `to` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  `dial_id` varchar(20) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_b`
--

DROP TABLE IF EXISTS `table_b`;
CREATE TABLE `table_b` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `instruct` varchar(35) NOT NULL,
  `to` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  `dial_id` varchar(20) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
