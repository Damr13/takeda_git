-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 06:05 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `do_oee`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_book`
--

CREATE TABLE IF NOT EXISTS `log_book` (
`id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `operator` varchar(255) DEFAULT NULL,
  `leader` varchar(255) DEFAULT NULL,
  `log` text,
  `state` varchar(255) DEFAULT NULL,
  `machine` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `product_batch` varchar(20) DEFAULT NULL,
  `product_good` int(10) DEFAULT NULL,
  `product_reject` int(10) DEFAULT NULL,
  `user_locked` int(11) DEFAULT NULL,
  `time_locked` datetime DEFAULT NULL,
  `oee_target` int(11) DEFAULT NULL,
  `freq_bd` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `log_book`
--

INSERT INTO `log_book` (`id`, `date`, `shift`, `operator`, `leader`, `log`, `state`, `machine`, `product`, `product_batch`, `product_good`, `product_reject`, `user_locked`, `time_locked`, `oee_target`, `freq_bd`) VALUES
(1, '2020-06-21', '1', NULL, '1', NULL, 'lock', 1, 1, '01234', 1000, 150, 5, '2020-06-21 15:53:00', NULL, NULL),
(2, '2020-06-21', '2', NULL, '6', NULL, 'lock', 1, 1, '01235', 1000, 10, 5, '2020-06-22 14:31:00', NULL, NULL),
(3, '2020-06-21', '3', NULL, NULL, NULL, 'open', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2020-06-22', '1', NULL, NULL, NULL, 'open', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2020-06-22', '2', NULL, NULL, NULL, 'open', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2020-06-22', '3', NULL, NULL, NULL, 'open', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2020-06-22', '1', NULL, '1', NULL, 'open', 2, 1, '02345', 0, 0, NULL, NULL, 0, 0),
(8, '2020-06-22', '2', NULL, '6', NULL, 'open', 2, 1, '02346gg', 1200, 0, 5, '2020-06-23 15:02:00', 65, 0),
(9, '2020-06-22', '3', NULL, NULL, NULL, 'open', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_book`
--
ALTER TABLE `log_book`
 ADD PRIMARY KEY (`id`) USING BTREE, ADD KEY `log1` (`date`,`shift`,`machine`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_book`
--
ALTER TABLE `log_book`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
