-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2026 at 10:50 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instructor_id` int NOT NULL,
  `department_id` int NOT NULL,
  `year_section` varchar(50) DEFAULT NULL,
  `coursecode_title` varchar(255) NOT NULL,
  `modality_type` varchar(100) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `sy` varchar(50) DEFAULT NULL,
  `unit` int DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `day` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instructor_id` (`instructor_id`),
  KEY `department_id` (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `instructor_id`, `department_id`, `year_section`, `coursecode_title`, `modality_type`, `semester`, `sy`, `unit`, `room`, `day`, `time`) VALUES
(1, 1, 1, 'IS-2A', 'GE107 - Communication', 'Face-to-Face', '1st', '2026-2027', 3, 'Room 101', 'Monday', '08:00-09:00');

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
CREATE TABLE IF NOT EXISTS `communication` (
  `id` int NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `activity` text COLLATE utf8mb4_general_ci,
  `requested_by` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comm_dept`
--

DROP TABLE IF EXISTS `comm_dept`;
CREATE TABLE IF NOT EXISTS `comm_dept` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `requested_by` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `hr_status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `program` varchar(100) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dept_201`
--

DROP TABLE IF EXISTS `dept_201`;
CREATE TABLE IF NOT EXISTS `dept_201` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(150) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `address` text,
  `date_hired` date DEFAULT NULL,
  `emergency_contact` varchar(150) DEFAULT NULL,
  `emergency_contact_no` int DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `employee_type` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `adv_class` varchar(100) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dept_201`
--

INSERT INTO `dept_201` (`id`, `name`, `dob`, `pob`, `sex`, `age`, `email`, `civil_status`, `address`, `date_hired`, `emergency_contact`, `emergency_contact_no`, `position`, `department`, `employee_type`, `password`, `adv_class`, `program`, `status`) VALUES
(0, 'Abba Perez', '2003-05-14', 'San Pablo City', 'Female', 21, 'abbaperez@gmail.com', 'Single', 'Brgy. San Jose, San Pablo City', '2024-08-01', 'Maria Perez', 2147483647, 'Instructor I', 'CCS', 'part time', 'password123', 'BSIT 2A', 'BS Information Technology', NULL),
(1, 'Abba Perez', '2003-05-14', 'San Pablo City', 'Female', 21, 'abbaperez@gmail.com', 'Single', 'Brgy. San Jose, San Pablo City', '2024-08-01', 'Maria Perez', 2147483647, 'Instructor I', 'CCS', 'fulltime', 'password123', 'BSIT 2A', 'BS Information Technology', 'non teaching');

-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

DROP TABLE IF EXISTS `draft`;
CREATE TABLE IF NOT EXISTS `draft` (
  `id` int NOT NULL,
  `viewer_from` int DEFAULT NULL,
  `viewer_date` date DEFAULT NULL,
  `viewer_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_201`
--

DROP TABLE IF EXISTS `file_201`;
CREATE TABLE IF NOT EXISTS `file_201` (
  `id` int NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `civil_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `date_hired` date DEFAULT NULL,
  `emergency_contact` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emergency_contact_no` int DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employee_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity` text COLLATE utf8mb4_general_ci,
  `user_role` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
CREATE TABLE IF NOT EXISTS `inbox` (
  `id` int NOT NULL,
  `viewer_from` int DEFAULT NULL,
  `viewer_date` date DEFAULT NULL,
  `viewer_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posting`
--

DROP TABLE IF EXISTS `posting`;
CREATE TABLE IF NOT EXISTS `posting` (
  `id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `select_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `audience` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
