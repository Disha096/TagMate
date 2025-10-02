-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2025 at 08:53 PM
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
-- Database: `tagmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `baggage`
--

CREATE TABLE `baggage` (
  `id` int(11) NOT NULL,
  `bag_id` varchar(20) NOT NULL,
  `flight_number` varchar(20) NOT NULL,
  `departure_date` date NOT NULL,
  `from_airport` varchar(50) NOT NULL,
  `to_airport` varchar(50) NOT NULL,
  `baggage_type` varchar(20) NOT NULL,
  `weight` float NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Registered',
  `location` varchar(50) DEFAULT 'CHECK-IN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baggage`
--

INSERT INTO `baggage` (`id`, `bag_id`, `flight_number`, `departure_date`, `from_airport`, `to_airport`, `baggage_type`, `weight`, `description`, `status`, `location`) VALUES
(1, 'BG751', 'AI 101', '2025-10-02', 'Mumbai', 'Delhi', 'Checked Baggage', 27, 'Black suitcase with silver handle', 'Loaded', 'Mumbai'),
(2, 'BG468', 'AI 102', '2025-10-03', 'Mumbai', 'Germany', 'Checked Baggage', 27, 'Black suitcase with yellow handle', 'Checked-in', 'Mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `name`, `email`, `password`) VALUES
(1, 'Disha Mayuresh Naik', 'dishamn22hcompe@student.mes.ac.in', '$2y$10$pJ7SvFZN7uRYVOtWdMa/QO4V1rluZOOP6MPQd6pnS5dThuLR8Ivjq');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@tagmate.com', 'admin123', 'admin', '2025-10-02 16:40:04'),
(2, 'John Staff', 'john@tagmate.com', 'johnpass', 'staff', '2025-10-02 16:40:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baggage`
--
ALTER TABLE `baggage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bag_id` (`bag_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baggage`
--
ALTER TABLE `baggage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
