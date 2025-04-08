-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 18, 2024 at 11:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` varchar(530) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Birthday` varchar(324) NOT NULL,
  `Roles` varchar(255) NOT NULL,
  `Images` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Name`, `password`, `Email`, `Phone`, `Birthday`, `Roles`, `Images`) VALUES
(11, 'admin123', 'Shin Ryujin', '$2y$10$90NGI/02wGuF1BSUqY6jQOe0sSuKwqvhCZ8PcCVEyTMOw3Z.0Ty3C', 'shinlia@gmail.com', '09758108432', '2024-11-18', 'Admin', 'pci.png'),
(12, 'doctor', 'john balacy', '$2y$10$nHi.Sw9dLX4jUdI9PJCpxOB9X/xfPrQfPN0pTauIp8LNksNYtkFOS', 'mark@gmail.com', '09758108432', '2024-12-07', 'Doctor', ''),
(14, 'Nurse123', 'Minju Kim', '$2y$10$Ooq7XGRbg4Q4Cm2zQIQRXOJnGyvOW.i3qHXPU6Ppv/dAw7cZpD6rS', 'john@gmail.com', '09758108432', '2024-11-08', 'Nurse', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
