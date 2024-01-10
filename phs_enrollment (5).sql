-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 05:52 PM
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
(75, 'Student', 'csteavher@gmail.com', '$2y$10$qpoovPDRtiQKcn/ZJ073vePPH/uhBsP0YqeOsFSjoZ3QV8HRHL5U6', '2023-12-13 05:36:59', 1),
(76, 'Student', 'mastercuervo452@gmail.com', '$2y$10$FUI//H45cg7WLuR38owJnO7GQ0i2RIVHE.iFOfv5gk8B3qDTQkfdK', '2023-12-13 07:11:33', 1),
(78, 'Student', 'mit703843@gmail.com', '$2y$10$a6iiLXfOui5FE1QBB/WECOV1NOGJackU7UG5l9dKLPWSFRKDC.5cO', '2023-12-29 00:59:38', 1),
(79, 'Student', 'jdio92375@gmail.com', '$2y$10$VADDNEs.IqFoCFC0MDDXieDX26BRxLBlPOBuBkyQww8bvY6OleVWW', '2024-01-02 06:01:16', 1),
(80, 'Student', 'steavhermagdeilconcha@gmail.com', '$2y$10$ciNjjuSKEicI3wacSfDzpuAk6EHqd9up6MxRaPLzAK.kMTZEtYRGy', '2024-01-03 08:15:58', 1),
(81, 'Student', 'romeolucente9870@gmail.com', '$2y$10$AzdtJCz1THWShs0Izg8vCu9uJkOl6X7RnROIs/QBm8b9mbjjoKJAa', '2024-01-03 11:01:42', 1),
(87, 'Student', 'marynielmaapni693@gmail.com', '$2y$10$yWLNBJAgt8osXzxiRxFwpuZlKNryWIpMfraONxiA6SvAA5FeeaNMu', '2024-01-04 09:43:10', 1),
(88, 'Student', 'sachiecalee@gmail.com', '$2y$10$hA2Gwbj10beSPlS8MHKdJefcZGu77iAtdVT0Ni0rn65f8SnvNwpnS', '2024-01-04 09:57:41', 1),
(90, 'Student', 'angeloninoalvarado@gmail.com', '$2y$10$awflj9vmSCiudH9u4H8iBejB3i6tjNg85kYLb3loh2qqXPZBfWUIi', '2024-01-10 13:36:40', 1);

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
(26, '136696080263', '0298 Bato Bato Street', 'pioioio', 'yuy', '6262'),
(27, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(28, '123456789123', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(29, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(30, '123456789123', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(31, '123456789111', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(32, '123123123123', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(33, '156156156156', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(34, '785234987654', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(35, '753951258743', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(36, '951357456259', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(37, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(38, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(39, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(40, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(41, '123456789111', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(42, '136696380263', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(43, '123456789111', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(44, '505080801234', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(45, '505080801234', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(46, '098765432101', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(47, '123456789112', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(49, '456789456456', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(50, '136688080088', '24 acacia ', 'san roque', 'antipolo ', '1870'),
(51, '564578943574', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(52, '123456789112', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208'),
(53, '759159259699', '0298 Bato Bato Street', 'Rizal', 'Makati', '1208');

-- --------------------------------------------------------

--
-- Table structure for table `form_submissions`
--

CREATE TABLE `form_submissions` (
  `lrn` varchar(12) NOT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_submissions`
--

INSERT INTO `form_submissions` (`lrn`, `submitted`) VALUES
('136696380263', 1);

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
  `email` varchar(255) NOT NULL,
  `year_level` enum('Grade 11','Grade 12') NOT NULL,
  `strand` enum('ABM','STEM','HUMSS') NOT NULL,
  `age` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`id`, `lrn`, `fname`, `mname`, `lname`, `email`, `year_level`, `strand`, `age`, `status`, `Message`) VALUES
(56, '136696380263', 'Steavher Magdeil', 'Dula', 'Concha', 'csteavher@gmail.com', 'Grade 11', 'ABM', 17, 'Approved', 'Please wait for an email to send requirements via f2f'),
(57, '123456789111', 'Master', 'Pambid', 'Cuervo', 'mastercuervo452@gmail.com', 'Grade 11', 'ABM', 18, 'Pending', ''),
(59, '505080801234', 'Romeo', 'Nigga', 'LucenteNigga', 'mit703843@gmail.com', 'Grade 12', 'STEM', 18, 'Pending', ''),
(60, '098765432101', 'Jotaro', 'Dio', 'Concha', 'jdio92375@gmail.com', 'Grade 12', 'STEM', 19, 'Pending', ''),
(63, '456789456456', 'Romeo', 'NIGGA NIGGA', 'NIGGA', 'romeolucente9870@gmail.com', 'Grade 11', 'ABM', 0, 'Approved', 'Please wait forn an Email to be sent to you'),
(64, '136688080088', 'Monique', 'Laquindanum', 'Burilla', '', 'Grade 12', 'STEM', 0, 'Pending', ''),
(65, '564578943574', 'Angelo Niño ', 'I', 'Alvarado', 'angeloninoalvarado@gmail.com', 'Grade 11', 'STEM', 0, 'Approved', 'PLEASE WAIT FOR AN EMAIL FOR ENROLLMENT REQUIREMENT PASSING'),
(66, '123456789112', 'Bruce', 'Kelia', 'Nigga', 'steavhermagdeilconcha@gmail.com', 'Grade 11', 'HUMSS', 17, 'Approved', 'PLEASE WAIT FOR AN EMAIL TO BE SENT.'),
(67, '759159259699', 'Joshua Louis', 'Dula', 'Racelis', 'joshuaracelis619@gmail.com', 'Grade 11', 'STEM', 17, 'Approved', 'waitings ka');

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
(19, 'csteavher@gmail.com', 681938),
(20, 'mastercuervo452@gmail.com', 516634),
(21, 'mit703843@gmail.com', 233883),
(22, 'jdio92375@gmail.com', 746426),
(23, 'steavhermagdeilconcha@gmail.com', 520225),
(24, 'romeolucente9870@gmail.com', 451458),
(25, 'marynielmaapni693@gmail.com', 802190),
(26, 'sachiecalee@gmail.com', 766138),
(27, 'angeloninoalvarado@gmail.com', 677430);

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
(48, '136696380263', 'Madelyn D. Concha', '2005-09-29', 'male', 17),
(49, '123456789111', 'Madelyn D. Concha', '2005-09-29', 'female', 18),
(51, '505080801234', 'Ako to', '2005-09-29', 'male', 18),
(52, '098765432101', 'Ako to', '2004-09-29', 'male', 19),
(55, '456789456456', 'Tite Nigga', '2006-09-29', 'male', 17),
(56, '136688080088', 'Mylene L.Burilla', '1981-05-27', 'female', 43),
(57, '564578943574', 'Tite Nigga', '2007-01-13', 'male', 17),
(58, '123456789112', 'Madelyn D. Concha', '2007-09-29', 'female', 17),
(59, '759159259699', 'Steavher Concha', '2007-09-29', 'male', 17);

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
(11, '136696080263', 'ROOM-1005_SEATING-ARRANGEMENT_III-BINS.pdf', 'PHS FILES\\ROOM-1005_SEATING-ARRANGEMENT_III-BINS.pdf', '2023-12-04 20:49:48'),
(12, '136696380263', 'new.png', 'PHS FILES\\new.png', '2023-12-12 02:22:04'),
(13, '123456789123', 'index.txt', 'PHS FILES\\index.txt', '2023-12-12 02:35:56'),
(14, '136696380263', 'new.png', 'PHS FILES\\new.png', '2023-12-12 03:02:40'),
(15, '123456789123', 'new.png', 'PHS FILES\\new.png', '2023-12-12 03:04:33'),
(16, '123456789111', 'new.png', 'PHS FILES\\new.png', '2023-12-12 09:01:26'),
(17, '123123123123', 'new.png', 'PHS FILES\\new.png', '2023-12-12 09:10:22'),
(18, '156156156156', 'new.png', 'PHS FILES\\new.png', '2023-12-12 09:14:07'),
(19, '785234987654', 'new.png', 'PHS FILES\\new.png', '2023-12-12 09:29:38'),
(20, '753951258743', 'new.png', 'PHS FILES\\new.png', '2023-12-12 09:55:42'),
(21, '951357456259', 'new.png', 'PHS FILES\\new.png', '2023-12-12 10:23:03'),
(22, '136696380263', 'new.png', 'PHS FILES\\new.png', '2023-12-12 22:22:03'),
(23, '136696380263', 'new.png', 'PHS FILES\\new.png', '2023-12-12 22:55:14'),
(24, '136696380263', 'new.png', 'PHS FILES\\new.png', '2023-12-12 23:03:38'),
(26, '505080801234', 'LEVEL 1 DFD.png', 'PHS FILES\\LEVEL 1 DFD.png', '2023-12-28 18:01:32'),
(27, '098765432101', '403405998_329643339841487_8344492871783733233_n.jpg', 'PHS FILES\\403405998_329643339841487_8344492871783733233_n.jpg', '2024-01-01 23:11:23'),
(29, '456789456456', 'L4-Problem-Statement.pptx.pdf', 'PHS FILES\\L4-Problem-Statement.pptx.pdf', '2024-01-03 04:03:49'),
(30, '564578943574', 'LABACT2-CONCHA-STAVHER-MAGDEIL.pdf', 'PHS FILES\\LABACT2-CONCHA-STAVHER-MAGDEIL.pdf', '2024-01-10 06:38:54'),
(31, '123456789112', 'LABACT4_CONCHA_STEAVHER_MAGDEIL.PDF', 'PHS FILES\\LABACT4_CONCHA_STEAVHER_MAGDEIL.PDF', '2024-01-10 06:47:44'),
(32, '759159259699', 'GROUP-4-PBL-DOCUMENTATION.pdf', 'PHS FILES\\GROUP-4-PBL-DOCUMENTATION.pdf', '2024-01-10 09:29:53');

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
-- Indexes for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`lrn`);

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
  MODIFY `account_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
