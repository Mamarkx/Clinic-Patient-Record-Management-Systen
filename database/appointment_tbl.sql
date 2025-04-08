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
-- Table structure for table `appointment_tbl`
--

CREATE TABLE `appointment_tbl` (
  `ID` int(11) NOT NULL,
  `Patient_name` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Doctor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_tbl`
--

INSERT INTO `appointment_tbl` (`ID`, `Patient_name`, `Date`, `Time`, `Doctor`) VALUES
(1, 'John Doe', '2024-11-07', '09:00:00', 'Dr. Smith'),
(2, 'Jane Smith', '2024-12-19', '10:00:00', 'Dr. Brown'),
(3, 'Emily Davis', '2024-01-10', '11:00:00', 'Dr. Johnson'),
(4, 'Michael Brown', '2024-01-20', '12:00:00', 'Dr. Lee'),
(5, 'Sarah Wilson', '2024-11-19', '13:00:00', 'Dr. Taylor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
