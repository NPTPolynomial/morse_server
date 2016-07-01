-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2016 at 03:37 AM
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

DROP TABLE IF EXISTS `board`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=312 ;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`datetime`, `board_id`, `from`, `to`, `type`, `dial_id`, `end`, `count`, `network`) VALUES
('2016-06-23 16:59:00', 1, 'a', 'ALL', 'i exists,I,0,0', '0', '', 0, '3'),
('2016-06-23 16:59:00', 2, 'a', 'ALL', 'i exists,I,0,0', '0', '', 0, '3'),
('2016-06-23 16:59:00', 3, 'a', 'ALL', 'i exists,I,0,0', '0', '', 0, '3'),
('2016-06-23 16:59:00', 4, 'a', 'ALL', 'i exists,I,0,0', '0', '', 0, '3'),
('2016-06-23 17:00:00', 5, 'a', 'ALL', 'i exists,I,0,0', '0', '', 0, '3'),
('2016-06-23 17:01:00', 6, 'b', 'ALL', 'we exists,W,0,0', '0', '', 0, '3'),
('2016-06-23 17:01:00', 7, 'b', 'ALL', 'we exists,W,0,0', '0', '', 0, '3'),
('2016-06-23 17:02:00', 8, 'c', 'ALL', 'we all exist,A,1,0', '0', '', 0, '3'),
('2016-06-23 17:02:00', 9, 'c', 'ALL', 'we all exist,A,1,0', '0', '', 0, '3'),
('2016-06-23 17:02:00', 10, 'b', 'ALL', 'we all exist,A,1,0', '0', '', 0, '3'),
('2016-06-23 17:02:00', 11, 'a', 'ALL', 'we all exist,A,1,0', '0', '', 0, '3'),
('2016-06-23 17:02:00', 12, 'b', 'ALL', '????,S,1,0', '0', '', 0, '3'),
('2016-06-23 17:03:00', 13, 'b', 'ALL', '????,T,2,1', '0', '', 0, '3'),
('2016-06-23 17:03:00', 14, 'b', 'ALL', '????,N,3,1', '0', '', 0, '3'),
('2016-06-23 17:03:00', 15, 'b', 'ALL', '????,', '0', '', 0, '3'),
('2016-06-23 17:05:00', 16, 'b', 'ALL', 'i exists,I,0,0', '0', '', 0, '3'),
('2016-06-23 17:05:00', 17, 'a', 'ALL', 'we exists,W,0,0', '0', '', 0, '3'),
('2016-06-23 17:05:00', 18, 'c', 'ALL', 'we all exist,A,1,0', '0', '', 0, '3'),
('2016-06-23 17:05:00', 19, 'c', 'ALL', '????,S,1,0', '0', '', 0, '3'),
('2016-06-23 17:06:00', 20, 'b', 'ALL', '????,T,2,1', '0', '', 0, '3'),
('2016-06-23 17:07:00', 21, 'a', 'ALL', '????,N,3,1', '0', '', 0, '3'),
('2016-06-23 18:03:00', 22, 'a', 'ALL', '????,N,3,1', '0', '', 0, '3'),
('2016-06-23 18:19:00', 23, 'a', 'ALL', 'network,N,3,1,high', '0', '', 0, '3'),
('2016-06-23 18:19:00', 24, 'a', 'ALL', 'network,N,3,1,low', '0', '', 0, '3'),
('2016-06-30 15:34:00', 25, 'a', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '3'),
('2016-06-30 15:34:00', 26, 'a', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '3'),
('2016-06-30 15:39:00', 27, 'a', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '3'),
('2016-06-30 15:41:00', 28, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 29, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 30, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 31, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 32, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 33, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 34, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 35, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 36, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 37, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 38, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 39, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 40, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 41, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 42, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 43, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 44, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:29:00', 45, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:33:00', 46, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:33:00', 47, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:33:00', 48, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:34:00', 49, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:34:00', 50, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:35:00', 51, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:37:00', 52, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:37:00', 53, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:37:00', 54, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:37:00', 55, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:37:00', 56, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:38:00', 57, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 58, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 59, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 60, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 61, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 62, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 63, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 64, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 65, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 66, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 67, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 68, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 69, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 70, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 71, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 72, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 73, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 74, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 75, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 76, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 77, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 78, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 79, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 80, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:41:00', 81, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 82, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 83, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 84, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 85, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 86, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 87, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:42:00', 88, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:30', 89, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:43', 90, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:36', 91, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:13', 92, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:17', 93, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:18', 94, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:18', 95, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:19', 96, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:20', 97, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:26', 98, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:27', 99, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:28', 100, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:38', 101, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:43', 102, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:58', 103, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:14', 104, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:33', 105, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:39', 106, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:46', 107, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:51', 108, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:55', 109, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:07', 110, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:29', 111, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:01', 112, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:59', 113, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:47', 114, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:49', 115, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 16:06:57', 116, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:16', 117, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:19', 118, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:31', 119, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:35', 120, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:36', 121, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:36', 122, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:37', 123, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:38', 124, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:38', 125, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:39', 126, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:40', 127, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:46', 128, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:48', 129, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:49', 130, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:50', 131, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:51', 132, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:52', 133, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:58', 134, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:02', 135, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:02', 136, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:03', 137, 'a', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:51', 138, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:55', 139, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:56', 140, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:57', 141, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:58', 142, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:59', 143, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:59', 144, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:00', 145, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:01', 146, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:02', 147, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:02', 148, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:03', 149, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:04', 150, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:05', 151, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:06', 152, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:06', 153, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:07', 154, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:08', 155, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:09', 156, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:09', 157, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:10', 158, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:11', 159, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:12', 160, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:12', 161, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:13', 162, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:14', 163, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:14', 164, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:15', 165, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:16', 166, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:17', 167, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:17', 168, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:18', 169, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:19', 170, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:20', 171, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:21', 172, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:21', 173, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:22', 174, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:23', 175, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:24', 176, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:24', 177, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:25', 178, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:26', 179, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:27', 180, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:28', 181, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:29', 182, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:30', 183, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:30', 184, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:31', 185, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:32', 186, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:33', 187, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:34', 188, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:34', 189, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:35', 190, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:36', 191, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:37', 192, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:37', 193, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:38', 194, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:39', 195, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:40', 196, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:41', 197, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:41', 198, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:15', 199, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:17', 200, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:19', 201, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:20', 202, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:32', 203, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:34', 204, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:35', 205, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:36', 206, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:36', 207, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:41', 208, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:42', 209, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:43', 210, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:59', 211, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:06', 212, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:07', 213, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:08', 214, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:09', 215, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:09', 216, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:10', 217, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:11', 218, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:12', 219, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:12', 220, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:13', 221, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:14', 222, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:14', 223, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:40', 224, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:20', 225, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:15', 226, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:18', 227, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:19', 228, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:20', 229, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:21', 230, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:21', 231, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:22', 232, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:23', 233, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:23', 234, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:24', 235, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:25', 236, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:46', 237, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:54', 238, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:00', 239, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:01', 240, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:02', 241, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:08', 242, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:09', 243, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:14', 244, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:16', 245, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:16', 246, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:17', 247, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:35', 248, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:26', 249, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:42', 250, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:46', 251, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:47', 252, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:06:50', 253, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:17:19', 254, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:17:22', 255, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:17:23', 256, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:17:23', 257, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:17:31', 258, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:17:32', 259, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:18:02', 260, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:18:11', 261, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:18:32', 262, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:18:36', 263, 'b', 'ALL', 'we exists,W,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:18:44', 264, 'b', 'ALL', 'we exists,W,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:19:03', 265, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:19:45', 266, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:19:48', 267, 'b', 'ALL', 'we exists,W,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:21:10', 268, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:38:25', 269, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:41:21', 270, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:45:35', 271, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:46:57', 272, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:47:50', 273, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:48:07', 274, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:48:14', 275, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:49:44', 276, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:50:52', 277, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:51:45', 278, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:52:28', 279, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '3'),
('2016-06-30 17:55:11', 280, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:55:19', 281, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:55:24', 282, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:55:47', 283, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:55:49', 284, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:55:56', 285, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:56:09', 286, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:56:13', 287, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:56:47', 288, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:56:58', 289, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:58:06', 290, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:58:09', 291, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:58:17', 292, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 17:58:27', 293, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 18:00:23', 294, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 18:01:56', 295, 'a', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 18:02:12', 296, 'b', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 18:02:32', 297, 'c', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 18:02:51', 298, 'c', 'ALL', 'i exists,I,0,0,low', '0', '', 0, '1'),
('2016-06-30 18:05:38', 299, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:06:02', 300, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:21:29', 301, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:21:40', 302, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:21:46', 303, 'c', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '2'),
('2016-06-30 18:22:55', 304, 'c', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '2'),
('2016-06-30 18:23:02', 305, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:25:37', 306, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:26:06', 307, 'c', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '2'),
('2016-06-30 18:26:11', 308, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:29:34', 309, 'c', 'ALL', 'we all exist,A,1,0,low', '0', '', 0, '1'),
('2016-06-30 18:29:50', 310, 'c', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '2'),
('2016-06-30 18:30:19', 311, 'c', 'ALL', 'i exists,I,0,0,high', '0', '', 0, '3');

-- --------------------------------------------------------

--
-- Table structure for table `central_global_vars`
--

DROP TABLE IF EXISTS `central_global_vars`;
CREATE TABLE `central_global_vars` (
  `global_var` varchar(15) NOT NULL,
  `value` varchar(10) NOT NULL,
  `group` int(9) NOT NULL,
  PRIMARY KEY (`global_var`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `central_global_vars`
--

INSERT INTO `central_global_vars` (`global_var`, `value`, `group`) VALUES
('level', '0', 1),
('missing', '0', 1),
('wifi_sig_high', '-101', 1),
('wifi_sig_low', '-55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `central_hub`
--

DROP TABLE IF EXISTS `central_hub`;
CREATE TABLE `central_hub` (
  `node` varchar(8) NOT NULL,
  `group` int(9) NOT NULL,
  `node_timestamp` varchar(50) NOT NULL,
  PRIMARY KEY (`node`,`group`),
  UNIQUE KEY `node` (`node`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `central_hub`
--

INSERT INTO `central_hub` (`node`, `group`, `node_timestamp`) VALUES
('a', 1, '2016-06-30 18:01:56'),
('b', 1, '2016-06-30 18:02:12'),
('c', 1, '2016-06-30 18:30:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
