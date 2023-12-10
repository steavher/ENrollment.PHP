-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 09:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phs_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_Id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verify` tinyint(2) NOT NULL COMMENT '1=verified, 0=not verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_Id`, `user_type`, `Email`, `Password`, `created_at`, `verify`) VALUES
(44, 'Admin', 'phs_admin', '$2a$12$WWHw0Fc8kCjrOsHIGb7FOO5FpD6n3UtnOsuefz8u6vxkGDVq.oP/S', '2023-11-24 13:22:52', 1),
(45, 'Admin', 'phs_admin1', '$2a$12$fvYTaXp5QPlojNIerePLZ.z7HEfMqskTypsg8Nv3BE47wKjC3KZUq\n', '2023-11-24 13:22:52', 1),
(46, 'Admin', 'phs_admin2', '$2a$12$7GO2juONY5GjYhCRcLaT7e..51sb.ZqfXTTdI8dU91rrLFFZXvpUm', '2023-11-24 13:22:52', 1),
(61, 'Student', 'joshuaracelis619@gmail.com', '$2y$10$vfo/xSavJWPrOitToTewFORSs5g45qqshsg6d1F9Jpdr3dCcSnsBq', '2023-12-03 05:59:57', 1),
(62, 'Student', 'joshyyy025@gmail.com', '$2y$10$SXgzrV5JbgQ0QcIuHMMj2eoHF/bQFSDb2a8mzV8bGpgzuh7ZKRvbS', '2023-12-03 09:57:36', 1),
(63, 'Student', 'csteavher@gmail.com', '$2y$10$Plx4mPwBS6ZFXzZcit3X/.W.XedeBIa6mnUHuBOtiaxoZl1dCFCfi', '2023-12-05 03:45:29', 1),
(64, 'Admin', 'admin', '$2y$10$s0b5AURhlj7iqg3v37wzm.m2u.x4lP.YbEg9vYqDmSX/2XW/Ia72q', '2023-12-10 08:53:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `lrn` varchar(100) NOT NULL,
  `house_street` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `lrn`, `house_street`, `barangay`, `city`, `zip_code`) VALUES
(26, '136696080263', '0298 Bato Bato Street', 'pioioio', 'yuy', '6262');

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `id` int(11) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `year_level` enum('Grade 11','Grade 12') NOT NULL,
  `strand` enum('ABM','STEM','HUMSS') NOT NULL,
  `age` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verify_code` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`ID`, `email`, `verify_code`) VALUES
(6, 'joshuaracelis619@gmail.com', 864201),
(7, 'joshyyy025@gmail.com', 227165),
(8, 'csteavher@gmail.com', 256210);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `age` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `lrn`, `pname`, `birthdate`, `gender`, `age`) VALUES
(32, '136696080263', 'Madelyn D. Concha', '2002-08-08', 'male', 12);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `file_id` int(11) NOT NULL,
  `lrn` varchar(12) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_files`
--

INSERT INTO `uploaded_files` (`file_id`, `lrn`, `file_name`, `file_path`, `upload_date`) VALUES
(11, '136696080263', 'ROOM-1005_SEATING-ARRANGEMENT_III-BINS.pdf', 'PHS FILES\\ROOM-1005_SEATING-ARRANGEMENT_III-BINS.pdf', '2023-12-04 20:49:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_Id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
