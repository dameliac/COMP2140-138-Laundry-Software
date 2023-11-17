-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 05:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `138users`
--
DROP DATABASE IF EXISTS `138users`;
CREATE DATABASE IF NOT EXISTS `138users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `138users`;

-- --------------------------------------------------------

--
-- Table structure for table `dorm`
--

CREATE TABLE `dorm` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `usertype` enum('resident','maintenance','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dorm`
--

INSERT INTO `dorm` (`username`, `password`, `firstname`, `lastname`, `usertype`) VALUES
('123', '$2y$10$1ILtmY.cEKFRAwHR97SYWeLvB2gC70oJTiNDVuhWaS9edo7OgJK6y', 'Josh', 'Johnson', 'resident'),
('789', '$2y$10$2S9Q0e7YrzCNBO2OTcDMHuJf2rJQUsKM3mGT6xJJMR5o/m.CKnqfi', 'Julio', 'Estabon', 'staff'),
('456', '$2y$10$tX39EIdwLzWa5bNNK728mOn14n8adf/YQ891PF.e0yJPCnF27UPg.', 'Senku', 'Ishigami', 'maintenance');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
