-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2024 at 01:06 PM
-- Server version: 5.7.34
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marked`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `s_lat` float(10,6) NOT NULL,
  `s_long` float(10,6) NOT NULL,
  `clg_lat` float(10,6) NOT NULL,
  `clg_long` float(10,6) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `s_id`, `s_lat`, `s_long`, `clg_lat`, `clg_long`, `date`, `ip`) VALUES
(5, 10, 25.627819, 85.102150, 25.630571, 85.103386, '2024-05-23 13:53:30', '127.0.0.1'),
(4, 7, 25.626589, 85.102409, 25.630571, 85.103386, '2024-05-23 06:43:55', '127.0.0.1'),
(6, 11, 25.629370, 85.103577, 25.630571, 85.103386, '2024-05-23 13:54:12', '127.0.0.1'),
(7, 12, 25.627804, 85.101997, 25.630571, 85.103386, '2024-05-23 13:54:42', '127.0.0.1'),
(8, 7, 25.627972, 85.102318, 25.630571, 85.103386, '2024-05-24 05:07:25', '127.0.0.1'),
(9, 14, 25.630449, 85.103630, 25.630571, 85.103386, '2024-05-24 05:51:58', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `marks` int(5) DEFAULT NULL,
  `subject_id` varchar(255) NOT NULL,
  `resultType_id` varchar(50) NOT NULL,
  `f_id` int(10) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `s_id`, `marks`, `subject_id`, `resultType_id`, `f_id`, `ip`, `created`) VALUES
(1, 7, 0, '1', '1', 9, '127.0.0.1', '2024-05-23 09:40:19'),
(2, 7, NULL, '2', '1', 9, '127.0.0.1', '2024-05-23 09:40:19'),
(6, 10, 58, '3', '1', 9, '127.0.0.1', '2024-05-23 13:56:05'),
(7, 11, 58, '3', '1', 9, '127.0.0.1', '2024-05-23 13:56:05'),
(8, 12, 58, '3', '1', 9, '127.0.0.1', '2024-05-23 13:56:05'),
(9, 7, 56, '7', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(10, 10, 58, '2', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(11, 10, 58, '7', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(12, 11, 58, '2', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(13, 11, 58, '7', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(14, 12, 58, '2', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(15, 12, 58, '7', '1', 9, '127.0.0.1', '2024-05-23 13:56:28'),
(16, 7, 88, '8', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(17, 7, 19, '9', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(18, 10, 45, '8', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(19, 10, 45, '9', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(20, 11, 45, '8', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(21, 11, 45, '9', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(22, 12, 45, '8', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(23, 12, 45, '9', '1', 9, '127.0.0.1', '2024-05-23 13:56:48'),
(24, 7, 89, '3', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(26, 7, 0, '8', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(27, 7, 17, '7', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(28, 7, 17, '9', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(29, 10, 17, '3', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(30, 10, 46, '2', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(31, 10, 17, '8', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(32, 10, 17, '7', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(33, 10, 17, '9', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(34, 11, 17, '3', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(35, 11, 17, '2', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(36, 11, 17, '8', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(37, 11, 17, '7', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(38, 11, 17, '9', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(39, 12, 17, '3', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(40, 12, 17, '2', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(41, 12, 17, '8', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(42, 12, 37, '7', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(43, 12, 17, '9', '9', 9, '127.0.0.1', '2024-05-23 13:56:58'),
(44, 7, 26, '3', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(45, 7, 26, '7', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(46, 10, 26, '3', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(47, 10, 26, '7', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(48, 11, 26, '3', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(49, 11, 26, '7', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(50, 12, 26, '3', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(51, 12, NULL, '7', '10', 9, '127.0.0.1', '2024-05-23 13:57:17'),
(52, 7, 22, '2', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(53, 7, 22, '8', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(54, 7, 22, '9', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(55, 10, 22, '2', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(56, 10, 22, '8', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(57, 10, 22, '9', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(58, 11, 22, '2', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(59, 11, 22, '8', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(60, 11, 22, '9', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(61, 12, 22, '2', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(62, 12, 22, '8', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(63, 12, 22, '9', '10', 9, '127.0.0.1', '2024-05-23 13:57:29'),
(64, 14, 58, '3', '1', 9, '127.0.0.1', '2024-05-24 05:53:32'),
(65, 14, 58, '2', '1', 9, '127.0.0.1', '2024-05-24 05:53:32'),
(66, 14, 45, '8', '1', 9, '127.0.0.1', '2024-05-24 05:53:32'),
(67, 14, 58, '7', '1', 9, '127.0.0.1', '2024-05-24 05:53:32'),
(68, 14, 45, '9', '1', 9, '127.0.0.1', '2024-05-24 05:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `result_types`
--

CREATE TABLE `result_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `result_types`
--

INSERT INTO `result_types` (`id`, `type`, `created`) VALUES
(1, 'End-Term', '2024-05-23 08:11:33'),
(9, 'Mid-Term', '2024-05-23 13:44:02'),
(10, 'Internal', '2024-05-23 13:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `created`) VALUES
(3, 'DBMS', '2024-05-23 10:19:26'),
(2, 'Python', '2024-05-23 08:11:04'),
(8, 'Operating System', '2024-05-23 13:46:06'),
(7, 'Computer Graphics', '2024-05-23 13:45:57'),
(9, 'DSA Using C', '2024-05-23 13:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'student',
  `branch` varchar(255) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  `roll` int(5) DEFAULT NULL,
  `pass` varchar(100) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `branch`, `semester`, `roll`, `pass`, `ip`, `created`, `updated`) VALUES
(12, 'Omprakash Kumar 4', 'a@g.cab', 'student', 'CE', 4, 25, '$2y$10$NZ20Jy2K6w2rJIG6Dmw4KOIsGWTQ6bEAvamiid0bK.emAhaaWx6EW', NULL, '2024-05-23 13:52:55', '2024-05-23 14:04:19'),
(11, 'Omprakash Kumar 3', 'a@g.ca', 'student', 'EE', 6, 56, '$2y$10$7379lRT5sJcmPPgNLatmk.XT7WX/mUKTosLucnexXztzgX3IKtDJi', NULL, '2024-05-23 13:52:37', '2024-05-23 14:04:15'),
(10, 'Omprakash Kumar 2', 'a@g.c', 'student', 'ECE', 3, 2, '$2y$10$s9FETIuDxmTET1D573Jcc.o5nvt1fJ403uIateHQ0cq6CxdV.I1N2', NULL, '2024-05-23 13:51:36', '2024-05-23 14:04:11'),
(9, 'Omprakash Kumar', 'om@a.b', 'faculty', NULL, NULL, NULL, '$2y$10$0sRUZzF7DguvBkNk.NRO4e6IXcKzXfED9of8fME4UOS4Q17PpxpE.', NULL, '2024-05-23 06:45:54', '2024-05-23 06:45:54'),
(7, 'Omprakash', 'omprxz@gmail.com', 'student', 'CSE', 4, 2, '$2y$10$irpOw7YMUNXSstBBS/I1E.IxPx/suzC9ekAWBsbg3ZlGgIdMzCf06', NULL, '2024-05-22 17:50:53', '2024-05-22 21:14:16'),
(13, 'Aditya', 'a@d.i', 'student', 'AUTOM', 5, 45, '$2y$10$dFW.uExb5QkLRvoKnmoTsOzyqGvPB.xb1AAWXYQY7a9OmWQdEKhjm', NULL, '2024-05-23 21:27:26', '2024-05-23 21:27:26'),
(14, 'Ankit Kumari', 'ankit@gmail.com', 'student', 'CSE', 4, 25, '$2y$10$5YOMRpnkTB90S2tg6vviUux0DkrMcvKxJveG6OUygPw9R7TKRPU7G', NULL, '2024-05-24 05:50:56', '2024-05-24 05:51:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_types`
--
ALTER TABLE `result_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `result_types`
--
ALTER TABLE `result_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
