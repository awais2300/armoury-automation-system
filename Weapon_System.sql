-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 03:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_system`
--
CREATE DATABASE IF NOT EXISTS `weapon_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `weapon_system`;

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Table structure for table `security_info`
--

CREATE TABLE `security_info` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `acct_type` enum('admin','user') NOT NULL,
  `status` enum('offline','online') NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_no` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `branch` varchar(255) NULL,
  `reg_date` timestamp NULL DEFAULT current_timestamp(),
  `email` varchar(200) NULL,
  `phone` varchar(200) NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `weapons`
--
CREATE TABLE `weapons` (
  `id` bigint(20) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `weapon_type` varchar(255) NOT NULL,
  `barcode` varchar(255) NULL,
  `maintenance_on` date NULL, 
  `availability` enum('Y','N') NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `weapon_allocation_records`
--
CREATE TABLE `weapon_allocation_records` (
  `id` bigint(20) NOT NULL,
  `officer_id` varchar(255) NOT NULL,
  `p_no` varchar(255) NULL,
  `name` varchar(255) NULL,
  `rank` varchar(255) NULL,
  `weapon_name` varchar(255) NULL,
  `weapon_id` varchar(255) NOT NULL,
  `weapon_barcode` varchar(255) NULL,
  `issued_by` varchar(255) NULL,
  `maintain_on` date NULL,
  `start_time` timestamp NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL,
  `magazine_provided` int NULL,
  `status` enum('Open','Closed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
 `id` int(11) NOT NULL,
 `activity_module` enum('Admin','user'),
 `activity_action` enum('add','update','delete') ,
 `activity_detail` text NULL,
 `activity_by` varchar(250) NULL,
 `activity_date` datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log_seen` (
 `activity_id` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 `seen` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `security_info`
--

INSERT INTO `security_info` (`id`, `username`, `password`, `reg_date`, `acct_type`, `status`, `email`, `phone`, `address`, `full_name`) VALUES
(1, 'awais', '$2y$10$/6ZG1xPTs92CYRNV3CjjnuG8MWZ1NwfWzrzK8GCC14BETqHCpWsGi', '2021-07-13 15:14:39', 'user', 'offline', '', '', '', 'Awais Ahmad'),
(2, 'admin', '$2y$10$uVajLuVrXeV2S4TWWuH4a.CLTS4LW92nmGiitB94akkA6pAWMJyI2', '2021-05-21 14:00:00', 'admin', 'offline','', '', '', '');


--
-- Indexes for table `security_info`
--
ALTER TABLE `security_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weapon_allocation_records`
--
ALTER TABLE `weapon_allocation_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--  
ALTER TABLE `activity_log`
 ADD PRIMARY KEY (`id`);
 

--
-- AUTO_INCREMENT for table `security_info`
--
ALTER TABLE `security_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weapon_allocation_records`
--
ALTER TABLE `weapon_allocation_records`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
 MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
