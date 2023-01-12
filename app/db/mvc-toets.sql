-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2023 at 08:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc-toets`
--
CREATE DATABASE IF NOT EXISTS `mvc-toets` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `mvc-toets`;

-- --------------------------------------------------------

--
-- Table structure for table `auto`
--

DROP TABLE IF EXISTS `auto`;
CREATE TABLE IF NOT EXISTS `auto` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Kenteken` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `InstructeurId` int NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `InstructeurId` (`InstructeurId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `auto`
--

INSERT INTO `auto` (`Id`, `Kenteken`, `Type`, `InstructeurId`) VALUES
(1, 'AU-67-IO', 'Golf', 3),
(2, 'TH-78-KL', 'Ferrari', 2),
(3, '90-KL-TR', 'Fiat 500', 4),
(4, 'YY-OP-78', 'Mercedes', 5),
(5, 'ST-FZ-28', 'Citroën', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructeur`
--

DROP TABLE IF EXISTS `instructeur`;
CREATE TABLE IF NOT EXISTS `instructeur` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `instructeur`
--

INSERT INTO `instructeur` (`Id`, `Naam`, `Email`) VALUES
(1, 'Groen', 'groen@gmail.com'),
(2, 'Manhoi', 'manhoi@gmail.com'),
(3, 'Zoyi', 'zoyi@gmail.com'),
(4, 'Berthold', 'berthold@gmail.com'),
(5, 'Denekamp', 'denekamp@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mankement`
--

DROP TABLE IF EXISTS `mankement`;
CREATE TABLE IF NOT EXISTS `mankement` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `AutoId` int NOT NULL,
  `Datum` date NOT NULL,
  `Mankement` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `AutoId` (`AutoId`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mankement`
--

INSERT INTO `mankement` (`Id`, `AutoId`, `Datum`, `Mankement`) VALUES
(1, 4, '2023-01-04', 'Profiel rechterband minder dan 2mm'),
(2, 2, '2023-01-02', 'Rechter achterlicht kapot'),
(3, 1, '2023-01-02', 'Spiegel links afgebroken'),
(4, 2, '2023-01-06', 'Bumper rechtersachter ingedeukt'),
(5, 2, '2023-01-08', 'Radio kapot'),
(6, 2, '2023-01-12', 'Raam kapot');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`InstructeurId`) REFERENCES `instructeur` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mankement`
--
ALTER TABLE `mankement`
  ADD CONSTRAINT `mankement_ibfk_1` FOREIGN KEY (`AutoId`) REFERENCES `auto` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
