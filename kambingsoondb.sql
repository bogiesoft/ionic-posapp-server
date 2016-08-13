-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2016 at 09:29 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kambingsoondb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'food'),
(2, 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `menu_name` varchar(100) NOT NULL,
  `image_name` varchar(55) NOT NULL,
  `qty` int(5) DEFAULT NULL,
  `unit` varchar(3) DEFAULT NULL,
  `price` int(12) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `menu_name`, `image_name`, `qty`, `unit`, `price`, `description`, `category_id`) VALUES
(1, NULL, 'KAMBING', 'kambing.jpeg', 0, '', 0, '', NULL),
(2, NULL, 'SATE', 'satay.jpeg', 0, '', 0, '', NULL),
(3, NULL, 'NASI & MIE GORENG', 'nasi-goreng.jpg', 0, '', 0, '', NULL),
(4, NULL, 'RICE INCLUDED', 'rice.jpeg', 0, '', 0, '', NULL),
(5, 1, 'KAMBING BAKAR ORIGINAL', '', 500, 'gr', 65000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et ligula erat. Pellentesque id mattis mi, sit amet congue metus. Pellentesque sed b', 1),
(6, 1, 'KAMBING BAKAR ORIGINAL', '', 300, 'gr', 38000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et ligula erat. Pellentesque id mattis mi, sit amet congue metus. Pellentesque sed b', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
