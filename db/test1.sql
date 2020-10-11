-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 10, 2020 at 10:32 AM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.2.33-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `name`) VALUES
(1, 'class8'),
(2, 'class9'),
(3, 'class10');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `studentid` int NOT NULL,
  `subid` int NOT NULL,
  `marks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`studentid`, `subid`, `marks`) VALUES
(1, 1, 30),
(1, 2, 15),
(1, 3, 90),
(2, 1, 90),
(2, 2, 75),
(2, 3, 62),
(3, 4, 70),
(3, 5, 68),
(3, 6, 67),
(4, 7, 45),
(4, 8, 39),
(4, 9, 69),
(5, 7, 15),
(5, 8, 77),
(5, 9, 90);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `classid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `name`, `classid`) VALUES
(1, 'john', 1),
(2, 'Alex', 1),
(3, 'jane', 2),
(4, 'mac', 3),
(5, 'kena', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `classid` int NOT NULL,
  `maxmarks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectid`, `name`, `classid`, `maxmarks`) VALUES
(1, 'CSI', 1, 100),
(2, 'MATHS', 1, 80),
(3, 'ICS', 1, 100),
(4, 'NAT', 2, 100),
(5, 'STATS', 2, 80),
(6, 'PDS', 2, 100),
(7, 'GEO', 3, 100),
(8, 'BIO', 3, 80),
(9, 'FIR', 3, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
