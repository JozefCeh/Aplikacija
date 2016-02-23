-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2014 at 04:21 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biznis`
--
CREATE DATABASE IF NOT EXISTS `biznis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biznis`;

-- --------------------------------------------------------

--
-- Table structure for table `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
  `ID_Firme` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(50) NOT NULL,
  `Mesto` varchar(50) NOT NULL,
  `Telefon` int(11) NOT NULL,
  `ID_Prodavac` int(11) NOT NULL,
  PRIMARY KEY (`ID_Firme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `firma`
--

INSERT INTO `firma` (`ID_Firme`, `Naziv`, `Mesto`, `Telefon`, `ID_Prodavac`) VALUES
(1, 'Gradjevinska firma', 'Beograd', 63123456, 1),
(2, 'Tehnika', 'Novi Sad', 69456789, 2),
(3, 'Termoplast', 'Loznica', 69789456, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kupac`
--

CREATE TABLE IF NOT EXISTS `kupac` (
  `ID_kupca` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(15) NOT NULL,
  `Prezime` varchar(15) NOT NULL,
  `Telefon` int(11) NOT NULL,
  PRIMARY KEY (`ID_kupca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kupac`
--

INSERT INTO `kupac` (`ID_kupca`, `Ime`, `Prezime`, `Telefon`) VALUES
(1, 'Danijel', 'Simeonovic', 123888),
(2, 'Dalibor', 'Jankov', 4455679),
(3, 'Bogdan', 'Knezev', 256987),
(4, 'Jozef', 'Ceh', 213457);

-- --------------------------------------------------------

--
-- Table structure for table `naručivanje`
--

CREATE TABLE IF NOT EXISTS `naručivanje` (
  `ID_Naručivanja` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Kupac` int(11) NOT NULL,
  `ID_Proizvod` int(11) NOT NULL,
  `Količina` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_Naručivanja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `naručivanje`
--

INSERT INTO `naručivanje` (`ID_Naručivanja`, `ID_Kupac`, `ID_Proizvod`, `Količina`, `Datum`) VALUES
(1, 3, 2, 5, '2014-07-30 18:23:10'),
(2, 1, 2, 10, '2014-07-30 18:23:10'),
(3, 2, 1, 8, '2014-07-30 18:27:23'),
(4, 1, 3, 25, '2014-07-30 18:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `prodavac`
--

CREATE TABLE IF NOT EXISTS `prodavac` (
  `ID_Prodavac` int(11) NOT NULL,
  `Ime` varchar(15) NOT NULL,
  `Prezime` varchar(15) NOT NULL,
  `ID_Firma` int(11) NOT NULL,
  PRIMARY KEY (`ID_Prodavac`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodavac`
--

INSERT INTO `prodavac` (`ID_Prodavac`, `Ime`, `Prezime`, `ID_Firma`) VALUES
(1, 'Stevan', 'Mihajlo', 3),
(2, 'Jovan', 'Josimovic', 1),
(3, 'Predrag', 'Milenkovic', 2);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE IF NOT EXISTS `proizvod` (
  `ID_Proizvoda` int(11) NOT NULL,
  `Asortiman proizvoda` varchar(15) NOT NULL,
  `Naziv proizvoda` varchar(50) NOT NULL,
  `Cena` decimal(10,0) NOT NULL,
  `ID_Firma` int(11) NOT NULL,
  PRIMARY KEY (`ID_Proizvoda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`ID_Proizvoda`, `Asortiman proizvoda`, `Naziv proizvoda`, `Cena`, `ID_Firma`) VALUES
(1, 'Plastika', 'PVC', '200', 3),
(2, 'Alat', 'Burgija za beton', '300', 1),
(3, 'Kompjuter', 'Tastatura i miš', '1200', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Hija', '123'),
(2, 'root', 'piroska1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
