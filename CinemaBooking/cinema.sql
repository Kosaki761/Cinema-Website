-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2022 at 10:51 AM
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
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `hallid` int(10) NOT NULL AUTO_INCREMENT,
  `hallname` varchar(50) DEFAULT NULL,
  `seatid` int(10) DEFAULT NULL,
  PRIMARY KEY (`hallid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `movieid` int(10) NOT NULL AUTO_INCREMENT,
  `moviename` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`movieid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_show`
--

DROP TABLE IF EXISTS `movie_show`;
CREATE TABLE IF NOT EXISTS `movie_show` (
  `msid` int(10) NOT NULL AUTO_INCREMENT,
  `showdate` date DEFAULT NULL,
  `showtime` time DEFAULT NULL,
  `movieid` int(10) DEFAULT NULL,
  `hallid` int(10) DEFAULT NULL,
  PRIMARY KEY (`msid`),
  KEY `movieid` (`movieid`),
  KEY `hallid` (`hallid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
CREATE TABLE IF NOT EXISTS `seat` (
  `seatid` int(10) NOT NULL AUTO_INCREMENT,
  `seatname` varchar(50) DEFAULT NULL,
  `seatprice` double DEFAULT NULL,
  `hallid` int(10) DEFAULT NULL,
  PRIMARY KEY (`seatid`),
  KEY `hallid` (`hallid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketid` int(10) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `price` double DEFAULT NULL,
  `msid` int(10) DEFAULT NULL,
  `id` int(10) DEFAULT NULL,
  PRIMARY KEY (`ticketid`),
  KEY `msid` (`msid`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
