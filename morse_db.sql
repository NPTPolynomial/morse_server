-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2016 at 12:03 AM
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
  `datetime` datetime NOT NULL,
  `board_id` int(12) NOT NULL AUTO_INCREMENT,
  `from` varchar(10) NOT NULL,
  `to` varchar(10) NOT NULL,
  `type` text NOT NULL,
  `dial_id` varchar(30) NOT NULL DEFAULT '0',
  `end` varchar(2) NOT NULL,
  `count` int(8) NOT NULL DEFAULT '0',
  `network` varchar(3) NOT NULL,
  PRIMARY KEY (`board_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dialog`
--

CREATE TABLE `dialog` (
  `dial_id` int(8) NOT NULL AUTO_INCREMENT,
  `dial_message` varchar(26) DEFAULT NULL,
  PRIMARY KEY (`dial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `dialog`
--

INSERT INTO `dialog` (`dial_id`, `dial_message`) VALUES
(1, 'Good morning'),
(2, 'Good evening'),
(3, 'Good afternoon'),
(4, 'Hello'),
(5, 'Hi'),
(6, 'Hey'),
(7, 'Long time no see'),
(8, 'It has been a while'),
(9, 'I come from Canada'),
(10, 'It is going to rain'),
(11, 'I like poutine'),
(12, 'I like hiking'),
(13, 'I don''t like the weather'),
(14, 'I don''t speak French'),
(15, 'I was born in Vancouver'),
(16, 'My name is Bob'),
(17, 'I studied design'),
(18, 'It smells funny in here'),
(19, 'I feel good today'),
(20, 'I am sleepy'),
(21, 'It is nice'),
(22, 'You are funny'),
(23, 'It is hot'),
(24, 'I''m thirsty'),
(25, 'I like being carried'),
(26, 'I want to be 1 inch taller'),
(27, 'I don''t feel well'),
(28, 'I am turning 2 soon'),
(29, 'I don''t understand a word'),
(30, 'I feel like dancing'),
(31, 'I want a shower'),
(32, 'I am relaxed'),
(33, 'We should talk more'),
(34, 'Interesting'),
(35, 'I don''t care'),
(36, 'I was custom made'),
(37, 'I miss home'),
(38, 'I miss my family'),
(39, 'I feel naked'),
(40, 'I like you'),
(41, 'Farewell'),
(42, 'Goodbye'),
(43, 'Good night'),
(44, 'Bye'),
(45, 'Take care'),
(46, 'Good talking to you'),
(47, 'See you'),
(48, 'Cheers'),
(49, 'See ya');

-- --------------------------------------------------------

--
-- Table structure for table `table_a1`
--

CREATE TABLE `table_a1` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL,
  `from` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  `dial_id` varchar(20) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_a2`
--

CREATE TABLE `table_a2` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL,
  `from` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  `dial_id` varchar(20) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_b1`
--

CREATE TABLE `table_b1` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL,
  `from` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  `dial_id` varchar(20) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_b2`
--

CREATE TABLE `table_b2` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL,
  `from` varchar(10) NOT NULL,
  `end` varchar(2) NOT NULL,
  `dial_id` varchar(20) NOT NULL DEFAULT '0',
  `count` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
