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
-- Table structure for table `patient_tbl`
--

CREATE TABLE `patient_tbl` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Bday` date NOT NULL,
  `Address` varchar(1555) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Purpose` varchar(2333) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_tbl`
--

INSERT INTO `patient_tbl` (`ID`, `Name`, `Age`, `Gender`, `Status`, `Phone`, `Bday`, `Address`, `Date`, `Purpose`) VALUES
(1, 'John Dark', 12, 'Male', 'Single', '1234567890', '1994-01-15', 'Tokyo', '2024-01-01', 'Check-Up'),
(2, 'Jane Smith', 34, 'Female', 'Married', '0987654321', '1996-02-20', 'Osaka', '2024-02-01', 'Check-Up'),
(3, 'Emily Davis', 35, 'Female', 'Single', '1122334455', '1989-03-25', 'Kyoto', '2024-03-01', 'Consultation'),
(4, 'Michael Brown', 40, 'Male', 'Married', '2233445566', '1984-04-30', 'Nagoya', '2024-04-01', 'Physical Exam'),
(5, 'Sarah Wilson', 32, 'Female', 'Single', '3344556677', '1992-05-10', 'Fukuoka', '2024-05-01', 'Follow-Up'),
(6, 'David Taylor', 23, 'Male', 'Married', '4455667788', '1979-06-15', 'Sapporo', '2024-06-01', 'X-ray'),
(7, 'Laura Anderson', 27, 'Female', 'Single', '5566778899', '1997-07-20', 'Kobe', '2024-07-01', 'Blood Test'),
(8, 'James Thomas', 67, 'Male', 'Married', '6677889900', '1974-08-25', 'Hiroshima', '2024-08-01', 'CT-Scan'),
(9, 'Linda Martinez', 19, 'Female', 'Single', '7788990011', '1986-09-30', 'Sendai', '2024-09-01', 'MRI'),
(10, 'Robert Garcia', 33, 'Male', 'Married', '8899001122', '1991-10-05', 'Yokohama', '2024-11-07', 'Ultrasound');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_tbl`
--
ALTER TABLE `patient_tbl`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
