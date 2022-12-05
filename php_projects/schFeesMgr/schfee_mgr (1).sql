-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2022 at 05:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schfee_mgr`
--

-- --------------------------------------------------------

--
-- Table structure for table `feetypes`
--

CREATE TABLE `feetypes` (
  `id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` varchar(2555) NOT NULL,
  `status` int(50) NOT NULL COMMENT '0=deleted,1=active,2=suspended.',
  `created_by` varchar(255) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feetypes`
--

INSERT INTO `feetypes` (`id`, `title`, `amount`, `status`, `created_by`, `date_created`) VALUES
(1, 'Sch Fees', '500000', 1, '1', '2022-09-20'),
(2, 'Transcript', '2900', 1, '1', '2022-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(50) NOT NULL,
  `student_id` int(255) DEFAULT NULL,
  `fee_type` varchar(255) DEFAULT NULL,
  `amount` varchar(2555) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `approved_by` varchar(100) DEFAULT NULL,
  `payment_pin` varchar(1000) DEFAULT NULL,
  `status` int(100) DEFAULT NULL COMMENT '0=not yet paid, 1=paid but not approved, 2= approved.',
  `reg_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `fee_type`, `amount`, `session`, `date_paid`, `date_approved`, `approved_by`, `payment_pin`, `status`, `reg_date`) VALUES
(1, 1, '1', '', '2019 / 2020', '2022-09-27', '2022-11-11', '1', '8029-7962-6559', 2, '2022-09-21'),
(2, 1, '1', '', '2019 / 2020', '0000-00-00', '2022-10-07', '1', '8937-5963-8100', 2, '2022-09-21'),
(3, 1, '1', '', '2019 / 2020', '0000-00-00', '2022-11-04', NULL, '8022-3954-7156', 2, '2022-09-21'),
(4, 1, '1', '', '2017 / 2018', '0000-00-00', NULL, NULL, '6796-9128-3933', 0, '2022-09-21'),
(5, 1, '1', '', '2021 / 2022', '0000-00-00', NULL, NULL, '8625-6741-6489', 0, '2022-09-21'),
(6, 1, '1', '', '2021 / 2022', '0000-00-00', NULL, NULL, '3792-5447-6547', 0, '2022-09-21'),
(7, 1, '1', '', '2016 / 2017', '0000-00-00', NULL, NULL, '4412-6832-5473', 0, '2022-09-22'),
(8, 1, '1', '43555', '2019 / 2020', '0000-00-00', NULL, NULL, '6364-5873-3723', 0, '2022-09-22'),
(9, 1, '1', '43555', '2018 / 2019', '0000-00-00', NULL, NULL, '5600-3846-9955', 1, '2022-09-27'),
(10, 1, '1', '43555', '2018 / 2019', NULL, NULL, NULL, '5345-8917-7931', 0, '2022-09-28'),
(11, 1, '1', '43555', '2018 / 2019', NULL, NULL, NULL, '4059-4424-7012', 0, '2022-09-28'),
(12, 1, '1', '43555', '2020 / 2021', NULL, NULL, NULL, '5424-6211-5498', 0, '2022-09-28'),
(13, 1, '1', '50000', '2017 / 2018', NULL, NULL, NULL, '9381-4849-6461', 0, '2022-11-04'),
(14, 1, '1', '50000', '2022 / 2023', '2022-11-11', '2022-11-11', '1', '6951-4790-5404', 2, '2022-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `entry_level` varchar(255) DEFAULT NULL,
  `img_url` varchar(100) DEFAULT NULL,
  `session` varchar(100) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `reg_no` varchar(100) DEFAULT NULL,
  `date_deleted_on` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT '1=active, 0=deleted, 2=suspended.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `email`, `phone`, `dob`, `entry_level`, `img_url`, `session`, `reg_date`, `reg_no`, `date_deleted_on`, `status`) VALUES
(1, 'Ogbonna', 'CHIDIEBERE', 'drakelegend@ddddd.dd', '+2347026661376', '2022-10-17', '2', 'uploads/ddd.jpg', '', '2022-10-02', '99292jj9h', '2022-10-02', '1'),
(2, 'student', 'Name', 'student@example.com', '+2348099829898', '2002-11-11', '300', 'uploads/ddd.jpg', NULL, '2022-11-11', 'GTRE-92929', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `ulevel` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=deleted, 1=active,2=not yet active',
  `reg_date` date DEFAULT NULL,
  `deleted_on` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `ulevel`, `status`, `reg_date`, `deleted_on`, `student_id`) VALUES
(1, 'Sch Admin Manager', '+2347068767407', 'admin@example.com', '7488e331b8b64e5794da3fa4eb10ad5d', 1, 1, '2022-09-16', NULL, 1),
(2, 'student', '+2348099829898', 'student@example.com', 'cd73502828457d15655bbd7a63fb0bc8', 2, 1, '2022-11-11', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feetypes`
--
ALTER TABLE `feetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `feetypes`
--
ALTER TABLE `feetypes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
