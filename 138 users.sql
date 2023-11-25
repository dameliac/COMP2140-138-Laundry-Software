-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 07:42 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `machine` varchar(50) NOT NULL,
  `timeslot` time NOT NULL,
  `user_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `machine`, `timeslot`, `user_name`) VALUES
(1, 'Machine 1', '08:00:00', NULL),
(2, 'Machine 1', '09:00:00', NULL),
(3, 'Machine 1', '10:00:00', NULL),
(4, 'Machine 1', '11:00:00', NULL),
(5, 'Machine 1', '12:00:00', NULL),
(6, 'Machine 1', '13:00:00', NULL),
(7, 'Machine 1', '14:00:00', '123'),
(8, 'Machine 1', '15:00:00', NULL),
(9, 'Machine 1', '16:00:00', NULL),
(10, 'Machine 1', '17:00:00', NULL),
(11, 'Machine 1', '18:00:00', NULL),
(12, 'Machine 1', '19:00:00', NULL),
(13, 'Machine 1', '20:00:00', NULL),
(16, 'Machine 2', '08:00:00', NULL),
(17, 'Machine 2', '09:00:00', NULL),
(18, 'Machine 2', '10:00:00', NULL),
(19, 'Machine 2', '11:00:00', '123'),
(20, 'Machine 2', '12:00:00', NULL),
(21, 'Machine 2', '13:00:00', NULL),
(22, 'Machine 2', '14:00:00', '123'),
(23, 'Machine 2', '15:00:00', NULL),
(24, 'Machine 2', '16:00:00', '123'),
(25, 'Machine 2', '17:00:00', NULL),
(26, 'Machine 2', '18:00:00', NULL),
(27, 'Machine 2', '19:00:00', NULL),
(28, 'Machine 2', '20:00:00', NULL),
(31, 'Machine 3', '08:00:00', NULL),
(32, 'Machine 3', '09:00:00', NULL),
(33, 'Machine 3', '10:00:00', NULL),
(34, 'Machine 3', '11:00:00', NULL),
(35, 'Machine 3', '12:00:00', '123'),
(36, 'Machine 3', '13:00:00', NULL),
(37, 'Machine 3', '14:00:00', NULL),
(38, 'Machine 3', '15:00:00', NULL),
(39, 'Machine 3', '16:00:00', NULL),
(40, 'Machine 3', '17:00:00', NULL),
(41, 'Machine 3', '18:00:00', NULL),
(42, 'Machine 3', '19:00:00', NULL),
(43, 'Machine 3', '20:00:00', NULL),
(46, 'Machine 4', '08:00:00', NULL),
(47, 'Machine 4', '09:00:00', NULL),
(48, 'Machine 4', '10:00:00', NULL),
(49, 'Machine 4', '11:00:00', NULL),
(50, 'Machine 4', '12:00:00', NULL),
(51, 'Machine 4', '13:00:00', NULL),
(52, 'Machine 4', '14:00:00', NULL),
(53, 'Machine 4', '15:00:00', NULL),
(54, 'Machine 4', '16:00:00', NULL),
(55, 'Machine 4', '17:00:00', NULL),
(56, 'Machine 4', '18:00:00', NULL),
(57, 'Machine 4', '19:00:00', NULL),
(58, 'Machine 4', '20:00:00', NULL),
(61, 'Machine 5', '08:00:00', NULL),
(62, 'Machine 5', '09:00:00', NULL),
(63, 'Machine 5', '10:00:00', NULL),
(64, 'Machine 5', '11:00:00', NULL),
(65, 'Machine 5', '12:00:00', NULL),
(66, 'Machine 5', '13:00:00', NULL),
(67, 'Machine 5', '14:00:00', NULL),
(68, 'Machine 5', '15:00:00', NULL),
(69, 'Machine 5', '16:00:00', NULL),
(70, 'Machine 5', '17:00:00', NULL),
(71, 'Machine 5', '18:00:00', NULL),
(72, 'Machine 5', '19:00:00', NULL),
(73, 'Machine 5', '20:00:00', NULL),
(76, 'Machine 6', '08:00:00', NULL),
(77, 'Machine 6', '09:00:00', NULL),
(78, 'Machine 6', '10:00:00', NULL),
(79, 'Machine 6', '11:00:00', NULL),
(80, 'Machine 6', '12:00:00', NULL),
(81, 'Machine 6', '13:00:00', NULL),
(82, 'Machine 6', '14:00:00', NULL),
(83, 'Machine 6', '15:00:00', NULL),
(84, 'Machine 6', '16:00:00', NULL),
(85, 'Machine 6', '17:00:00', NULL),
(86, 'Machine 6', '18:00:00', NULL),
(87, 'Machine 6', '19:00:00', NULL),
(88, 'Machine 6', '20:00:00', NULL),
(91, 'Machine 7', '08:00:00', NULL),
(92, 'Machine 7', '09:00:00', NULL),
(93, 'Machine 7', '10:00:00', NULL),
(94, 'Machine 7', '11:00:00', NULL),
(95, 'Machine 7', '12:00:00', NULL),
(96, 'Machine 7', '13:00:00', NULL),
(97, 'Machine 7', '14:00:00', NULL),
(98, 'Machine 7', '15:00:00', NULL),
(99, 'Machine 7', '16:00:00', NULL),
(100, 'Machine 7', '17:00:00', NULL),
(101, 'Machine 7', '18:00:00', NULL),
(102, 'Machine 7', '19:00:00', NULL),
(103, 'Machine 7', '20:00:00', NULL),
(106, 'Machine 8', '08:00:00', NULL),
(107, 'Machine 8', '09:00:00', NULL),
(108, 'Machine 8', '10:00:00', NULL),
(109, 'Machine 8', '11:00:00', NULL),
(110, 'Machine 8', '12:00:00', NULL),
(111, 'Machine 8', '13:00:00', NULL),
(112, 'Machine 8', '14:00:00', NULL),
(113, 'Machine 8', '15:00:00', NULL),
(114, 'Machine 8', '16:00:00', NULL),
(115, 'Machine 8', '17:00:00', NULL),
(116, 'Machine 8', '18:00:00', NULL),
(117, 'Machine 8', '19:00:00', NULL),
(118, 'Machine 8', '20:00:00', NULL),
(121, 'Machine 9', '08:00:00', NULL),
(122, 'Machine 9', '09:00:00', NULL),
(123, 'Machine 9', '10:00:00', NULL),
(124, 'Machine 9', '11:00:00', NULL),
(125, 'Machine 9', '12:00:00', NULL),
(126, 'Machine 9', '13:00:00', NULL),
(127, 'Machine 9', '14:00:00', NULL),
(128, 'Machine 9', '15:00:00', NULL),
(129, 'Machine 9', '16:00:00', NULL),
(130, 'Machine 9', '17:00:00', NULL),
(131, 'Machine 9', '18:00:00', NULL),
(132, 'Machine 9', '19:00:00', NULL),
(133, 'Machine 9', '20:00:00', NULL),
(136, 'Machine 10', '08:00:00', NULL),
(137, 'Machine 10', '09:00:00', NULL),
(138, 'Machine 10', '10:00:00', NULL),
(139, 'Machine 10', '11:00:00', NULL),
(140, 'Machine 10', '12:00:00', NULL),
(141, 'Machine 10', '13:00:00', NULL),
(142, 'Machine 10', '14:00:00', NULL),
(143, 'Machine 10', '15:00:00', NULL),
(144, 'Machine 10', '16:00:00', NULL),
(145, 'Machine 10', '17:00:00', NULL),
(146, 'Machine 10', '18:00:00', NULL),
(147, 'Machine 10', '19:00:00', NULL),
(148, 'Machine 10', '20:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
