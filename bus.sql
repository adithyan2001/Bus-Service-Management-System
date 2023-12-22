-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 09:32 PM
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
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE `bus_routes` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`route_id`, `route_name`) VALUES
(1, 'Aluva-Munnar'),
(2, 'Munnar-Aluva'),
(3, 'Kottayam-Rajakkad'),
(4, 'Aluva-Thrissur'),
(5, 'Thrissur-Aluva');

-- --------------------------------------------------------

--
-- Table structure for table `bus_services`
--

CREATE TABLE `bus_services` (
  `serv_id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `route_id` int(11) NOT NULL,
  `s_time` time NOT NULL,
  `e_time` time NOT NULL,
  `status` varchar(30) NOT NULL,
  `delay` int(10) NOT NULL DEFAULT 0,
  `cs_nm` varchar(15) NOT NULL DEFAULT 'Ready To Start'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_services`
--

INSERT INTO `bus_services` (`serv_id`, `type`, `route_id`, `s_time`, `e_time`, `status`, `delay`, `cs_nm`) VALUES
(101, 'SF', 1, '08:00:00', '12:00:00', 'Active', 10, 'Kothamangalam'),
(102, 'SWIFT', 3, '09:00:00', '01:00:00', '', 0, 'Ready To Start'),
(103, 'SF', 4, '07:00:00', '09:00:00', 'Active', 0, 'Aluva'),
(104, 'SWIFT', 4, '10:00:00', '12:00:00', 'Active', 0, 'Aluva'),
(105, 'SWIFT', 1, '05:00:00', '09:00:00', 'Active', 0, 'Aluva'),
(106, 'FS', 5, '11:00:00', '01:50:00', '', 0, 'Ready To Start'),
(107, 'FSLS', 5, '11:00:00', '01:50:00', '', 0, 'Ready To Start'),
(108, 'SF', 2, '08:30:00', '12:30:00', 'Active', 0, 'Aluva');

-- --------------------------------------------------------

--
-- Table structure for table `bus_stops`
--

CREATE TABLE `bus_stops` (
  `stop_id` int(11) NOT NULL,
  `stop_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_stops`
--

INSERT INTO `bus_stops` (`stop_id`, `stop_name`) VALUES
(1, 'Aluva'),
(2, 'Perumbavoor'),
(3, 'Kothamangalam'),
(4, 'Adimali'),
(5, 'Munnar'),
(6, 'Kottayam'),
(7, 'Ettumanoor'),
(8, 'Muvattupuzha'),
(9, 'Rajakkad'),
(10, 'Chalakkudy'),
(11, 'Angamaly'),
(12, 'Irinjalakkuda'),
(13, 'Thrissur'),
(14, 'Edappal'),
(15, 'Kunnamkulam'),
(16, 'Kuttippuram'),
(17, 'Kozhikode');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(20) NOT NULL,
  `pswd` varchar(15) NOT NULL,
  `role` varchar(15) NOT NULL,
  `stop_id` int(15) DEFAULT NULL,
  `sname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `pswd`, `role`, `stop_id`, `sname`) VALUES
('admin', 'admin', 'admin', 0, 'Admin'),
('aluva', 'aluva', 'StationMaster', 1, 'Aluva'),
('kothamangalam', 'kothamangalam', 'StationMaster', 3, 'Kothamangalam'),
('kottayam', 'ktm', 'StationMaster', 6, 'Kottayam'),
('Rajakkad', 'rjk', 'StationMaster', 9, 'rajakkad');

-- --------------------------------------------------------

--
-- Table structure for table `route_stops`
--

CREATE TABLE `route_stops` (
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  `stop_order` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_stops`
--

INSERT INTO `route_stops` (`route_id`, `stop_id`, `stop_order`, `priority`, `time`) VALUES
(1, 1, 1, 1, 0),
(1, 2, 2, 2, 20),
(1, 3, 3, 3, 30),
(1, 4, 4, 4, 90),
(1, 5, 5, 5, 60),
(2, 1, 5, 1, 20),
(2, 2, 4, 2, 30),
(2, 3, 3, 3, 90),
(2, 4, 2, 4, 60),
(2, 5, 1, 5, 0),
(3, 3, 4, 0, 30),
(3, 4, 5, 0, 90),
(3, 6, 1, 0, 0),
(3, 7, 2, 0, 30),
(3, 8, 3, 0, 90),
(3, 9, 6, 0, 60),
(4, 1, 1, 0, 0),
(4, 10, 3, 0, 30),
(4, 11, 2, 0, 30),
(4, 12, 4, 0, 20),
(4, 13, 5, 0, 30),
(5, 1, 5, 0, 30),
(5, 10, 3, 0, 20),
(5, 11, 4, 0, 30),
(5, 12, 2, 0, 30),
(5, 13, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_routes`
--
ALTER TABLE `bus_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `bus_services`
--
ALTER TABLE `bus_services`
  ADD PRIMARY KEY (`serv_id`),
  ADD KEY `fk` (`route_id`);

--
-- Indexes for table `bus_stops`
--
ALTER TABLE `bus_stops`
  ADD PRIMARY KEY (`stop_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `route_stops`
--
ALTER TABLE `route_stops`
  ADD PRIMARY KEY (`route_id`,`stop_id`),
  ADD KEY `stop_id` (`stop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_routes`
--
ALTER TABLE `bus_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `bus_services`
--
ALTER TABLE `bus_services`
  MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `bus_stops`
--
ALTER TABLE `bus_stops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_services`
--
ALTER TABLE `bus_services`
  ADD CONSTRAINT `fk` FOREIGN KEY (`route_id`) REFERENCES `bus_routes` (`route_id`);

--
-- Constraints for table `route_stops`
--
ALTER TABLE `route_stops`
  ADD CONSTRAINT `route_stops_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `bus_routes` (`route_id`),
  ADD CONSTRAINT `route_stops_ibfk_2` FOREIGN KEY (`stop_id`) REFERENCES `bus_stops` (`stop_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
