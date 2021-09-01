-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2021 at 04:09 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhousedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`) VALUES
(1, 'admin wewel', 'admin', '$2y$10$XFl4JPkf0mCnF1z8n2w5SuTYUO2XmQ.KeIRsqK0Hhv4v4IOpumtLG'),
(2, 'admin neil', 'admin2', '$2y$10$cHYjGGOjfOV1DdlJ05tuFeB6fQ5FesqurUkC40juv6fKYFCF3obt6');

-- --------------------------------------------------------

--
-- Table structure for table `boarder`
--

CREATE TABLE `boarder` (
  `boarder_id` int(11) NOT NULL,
  `boarder_client_id` int(11) NOT NULL,
  `boarder_room_id` int(11) NOT NULL,
  `boarder_owner_id` int(11) NOT NULL,
  `boarder_last_payment` date NOT NULL,
  `boarder_status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boarder`
--

INSERT INTO `boarder` (`boarder_id`, `boarder_client_id`, `boarder_room_id`, `boarder_owner_id`, `boarder_last_payment`, `boarder_status`) VALUES
(1, 38, 28, 8, '2021-03-25', 'inactive'),
(2, 37, 35, 24, '2021-03-25', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_fname` varchar(255) NOT NULL,
  `client_lname` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_gender` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_contact_no` varchar(255) NOT NULL,
  `client_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_fname`, `client_lname`, `client_email`, `client_gender`, `client_address`, `client_contact_no`, `client_status`) VALUES
(30, 'dfdssfds', 'dfgfdgdfds', 'dgffd@gmail.com', 'Male', 'dfghffd', '435434234', 'Student'),
(31, 'sssssssss', 'sssssssss', 'sssssssssss@gmail.com', 'Male', 'asdasdasdasd', 'e213123213', 'Employed'),
(32, 'qqq', 'qqq', 'qqq@gmail.com', 'Male', 'aqqq', '123', 'Student'),
(35, 'asdasd', 'asdasdas', 'asdasdsad@gmail.com', 'Male', 'qwe g', '21423542', 'Student'),
(36, 'sample', 'sample', 'sample@gmail.com', 'Female', 'asd', '213123', 'Employed'),
(37, 'chuychuy', 'chuychuy', 'chuychuy@gmail.com', 'Male', 'sdasda', '1231232', 'Unemployed'),
(38, 'dexter', 'dalaota', 'asdasd@gmail.com', 'Male', 'asdasd', '213123', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `inquire`
--

CREATE TABLE `inquire` (
  `inq_id` int(11) NOT NULL,
  `inq_room_id` int(11) NOT NULL,
  `inq_client_id` int(11) NOT NULL,
  `inq_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquire`
--

INSERT INTO `inquire` (`inq_id`, `inq_room_id`, `inq_client_id`, `inq_status`) VALUES
(1, 28, 30, 'done'),
(2, 28, 31, 'done'),
(3, 33, 32, 'pending'),
(6, 35, 35, 'done'),
(7, 35, 36, 'done'),
(8, 35, 37, 'done'),
(9, 28, 38, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `owner_fname` varchar(255) NOT NULL,
  `owner_lname` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `owner_username` varchar(255) NOT NULL,
  `owner_password` varchar(255) NOT NULL,
  `owner_gender` varchar(255) NOT NULL,
  `owner_contact_no` varchar(255) NOT NULL,
  `owner_address` varchar(255) NOT NULL,
  `owner_status` varchar(255) NOT NULL DEFAULT 'pending',
  `owner_reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `owner_fname`, `owner_lname`, `owner_email`, `owner_username`, `owner_password`, `owner_gender`, `owner_contact_no`, `owner_address`, `owner_status`, `owner_reg_date`) VALUES
(8, 'noel', 'bulan', 'noelbulan@gmail.com', 'wewel', '$2y$10$XFl4JPkf0mCnF1z8n2w5SuTYUO2XmQ.KeIRsqK0Hhv4v4IOpumtLG', 'Male', '96576345', 'gusa', 'approved', '2021-01-13'),
(18, 'aaaaa', 'aaaaaa', 'aaaaa@gmail.com', 'aaaa', '$2y$10$OHNQmif/5bqSv1Bvw7BwIuAQYt3qZG4N4Q0lZzYX0uKepi/uoMiNK', 'Male', '2312412412', 'agusan', 'approved', '2021-02-23'),
(21, 'mawi', 'racines', 'mawfracs@gmail.com', 'mawfracs', '$2y$10$cHYjGGOjfOV1DdlJ05tuFeB6fQ5FesqurUkC40juv6fKYFCF3obt6', 'Male', '55465436uy', 'cdo', 'approved', '2021-03-21'),
(24, 'sample ', 'sample', 'sample@gmail.com', 'sample', '$2y$10$GMyMmjenjKUjCsbd46AJv.lpd5TusmwLcVY96vqfKxX1OuRTnFqUy', 'Male', '34234', 'sample', 'approved', '2021-03-24'),
(25, 'dexter', 'dalaota', 'asdasd@gmail.com', 'dexter', '$2y$10$bd1CZVLzhZCveupwqJU70OWoxf1ttj.X38vONnVFLu9XcXcqK8DYu', 'Male', '213123', 'asdasd', 'pending', '2021-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_owner_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_location` varchar(255) NOT NULL,
  `room_price` int(11) NOT NULL,
  `room_advance` int(11) NOT NULL,
  `room_dimension` varchar(255) NOT NULL,
  `room_bed` varchar(255) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `room_policy` longtext DEFAULT NULL,
  `room_status` varchar(255) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_owner_id`, `room_name`, `room_location`, `room_price`, `room_advance`, `room_dimension`, `room_bed`, `room_capacity`, `room_policy`, `room_status`) VALUES
(28, 8, 'Kotiko Compund', 'corrales', 3000, 2, '10sqm', 'Single Bed', 2, 'bawal magdala ug bisita', 'available'),
(29, 8, 'Dexters bhaus', 'burgos', 2500, 1, '10sqm', 'Single Bed', 2, 'bawal magdala ug ilimnon\r\nbawal mag inom', 'available'),
(30, 8, 'heavens', 'agora', 1500, 2, '10sqm', 'Double Deck', 2, 'bawal magdala ug chix', 'available'),
(33, 18, 'chuy', 'asdasd', 2121, 2, '213', 'Single Size Bed', 2, 'bawal mag inom', 'available'),
(35, 24, 'sample', 'sample', 1500, 1, '10sqm', 'Single Size Bed', 1, 'bawal mag inom diring lugara', 'occupied');

-- --------------------------------------------------------

--
-- Table structure for table `room_image`
--

CREATE TABLE `room_image` (
  `img_id` int(11) NOT NULL,
  `img_room_id` int(11) NOT NULL,
  `img_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_image`
--

INSERT INTO `room_image` (`img_id`, `img_room_id`, `img_filename`) VALUES
(8, 28, '53921_220321_14_48_40.jpg'),
(9, 28, '11162_220321_14_48_40.jpg'),
(10, 28, '90546_220321_14_48_40.jpg'),
(11, 29, '45996_220321_14_24_41.jpg'),
(12, 29, '46275_220321_14_24_41.jpg'),
(13, 30, '21178_220321_14_02_42.jpg'),
(15, 33, '1210_240321_15_27_40.jpg'),
(16, 33, '79083_240321_15_27_40.jpg'),
(23, 35, '35591_240321_16_29_15.jpg'),
(24, 35, '44912_240321_16_29_15.jpg'),
(25, 35, '34476_240321_16_29_15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `t_id` int(11) NOT NULL,
  `t_invoice` varchar(255) NOT NULL,
  `t_boarder_id` int(11) NOT NULL,
  `t_months` int(11) NOT NULL,
  `t_month_start` date DEFAULT NULL,
  `t_month_end` date DEFAULT NULL,
  `t_total` int(11) NOT NULL,
  `t_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`t_id`, `t_invoice`, `t_boarder_id`, `t_months`, `t_month_start`, `t_month_end`, `t_total`, `t_date`) VALUES
(7, 'INV-41524250321080925', 1, 1, '2021-03-25', '2021-04-25', 9000, '2021-03-25'),
(8, 'INV-68990250321115322', 2, 3, '2021-03-25', '2021-06-25', 6000, '2021-03-25'),
(9, 'INV-41524250321080925', 1, 1, '2021-04-25', '2021-05-25', 3000, '2021-03-25'),
(10, 'INV-41524250321080925', 1, 3, '2021-05-25', '2021-08-25', 9000, '2021-03-25'),
(11, 'INV-68990250321115322', 2, 1, '2021-06-25', '2021-07-25', 1500, '2021-03-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `boarder`
--
ALTER TABLE `boarder`
  ADD PRIMARY KEY (`boarder_id`),
  ADD KEY `boarder_client_id` (`boarder_client_id`),
  ADD KEY `boarder_client_id_2` (`boarder_client_id`,`boarder_room_id`,`boarder_owner_id`),
  ADD KEY `boarder_room_id` (`boarder_room_id`),
  ADD KEY `boarder_owner_id` (`boarder_owner_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `inquire`
--
ALTER TABLE `inquire`
  ADD PRIMARY KEY (`inq_id`),
  ADD KEY `inq_room_id` (`inq_room_id`,`inq_client_id`),
  ADD KEY `inq_client_id` (`inq_client_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_owner_id` (`room_owner_id`);

--
-- Indexes for table `room_image`
--
ALTER TABLE `room_image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_room_id` (`img_room_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `t_boarder_id` (`t_boarder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `boarder`
--
ALTER TABLE `boarder`
  MODIFY `boarder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `inquire`
--
ALTER TABLE `inquire`
  MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `room_image`
--
ALTER TABLE `room_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boarder`
--
ALTER TABLE `boarder`
  ADD CONSTRAINT `boarder_ibfk_1` FOREIGN KEY (`boarder_client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boarder_ibfk_2` FOREIGN KEY (`boarder_room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boarder_ibfk_3` FOREIGN KEY (`boarder_owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inquire`
--
ALTER TABLE `inquire`
  ADD CONSTRAINT `inquire_ibfk_1` FOREIGN KEY (`inq_room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inquire_ibfk_2` FOREIGN KEY (`inq_client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_image`
--
ALTER TABLE `room_image`
  ADD CONSTRAINT `room_image_ibfk_1` FOREIGN KEY (`img_room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`t_boarder_id`) REFERENCES `boarder` (`boarder_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
