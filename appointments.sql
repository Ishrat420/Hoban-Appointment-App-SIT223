-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 04:44 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointments`
--

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_fill` tinyint(4) NOT NULL DEFAULT 0,
  `student_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `date`, `start_time`, `end_time`, `is_fill`, `student_id`) VALUES
(1, '2021-05-18', '01:00:00', '01:05:00', 1, 1),
(2, '2021-05-18', '01:05:00', '01:10:00', 0, 0),
(4, '2021-05-17', '11:30:00', '12:00:00', 1, 52),
(5, '2021-05-17', '12:00:00', '12:30:00', 1, 55),
(6, '2021-05-17', '12:30:00', '13:00:00', 1, 54),
(7, '2021-05-14', '11:30:00', '12:00:00', 0, 0),
(8, '2021-05-14', '12:00:00', '12:30:00', 0, 0),
(9, '2021-05-14', '12:30:00', '13:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `no` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `no`, `name`, `phone`, `email`) VALUES
(1, NULL, 'tharindu madushanka', '+94774938046', 'bmtmadushanka@gmail.com'),
(2, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(3, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(4, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(5, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(6, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(7, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(8, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(9, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(10, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(11, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(12, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(13, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(14, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(15, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(16, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(17, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(18, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(19, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(20, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(21, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(22, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(23, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(24, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(25, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(26, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(27, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(28, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(29, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(30, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(31, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(32, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(33, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(34, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(35, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(36, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(37, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(38, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(39, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(40, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(41, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(42, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(43, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(44, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(45, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(46, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(47, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(48, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(49, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(50, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(51, NULL, 'ad', '+94774938046', 'bmtmadushanka@gmail.com'),
(52, NULL, 'tharindu madushanka', '+94774938046', 'bmtmadushanka@gmail.com'),
(53, NULL, 'asdd', '+94774938046', 'bmtmadushanka@gmail.com'),
(54, '4525', 'asdd', '+94774938046', 'bmtmadushanka@gmail.com'),
(55, '4526', 'tharindu madushanka', '+94774938046', 'bmtmadushanka@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
