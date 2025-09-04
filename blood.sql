-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 12:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `login_id` int(5) UNSIGNED NOT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`login_id`, `email`, `pwd`, `verify_token`, `img`) VALUES
(1, 'bansarisorathiya74@gmail.com', '1234', '5510328600681a7039de34f50259e524', 'Screenshot 2024-01-19 134139.png'),
(24, 'bansarisorathiya25@gmail.com', '123', '1e83bafc317cbe75220e7db1560acc3e', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `blood_id` mediumint(3) UNSIGNED NOT NULL,
  `blood_grp` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`blood_id`, `blood_grp`) VALUES
(27, 'O+'),
(36, 'O-'),
(39, 'B-'),
(40, 'B+'),
(41, 'A-'),
(42, 'A+'),
(43, 'AB-'),
(45, 'AB+');

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

CREATE TABLE `camp` (
  `camp_id` int(30) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED NOT NULL,
  `camp_name` varchar(50) NOT NULL,
  `conducted_by` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `state_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(5) UNSIGNED NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0=camp is on the way  1=expired 2=deleted by admin',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`camp_id`, `member_id`, `camp_name`, `conducted_by`, `address`, `state_id`, `city_id`, `email`, `contact_no`, `date`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(14, 43, 'Arya Blood Camp', 'Dr. Mahesh Bedi', '4, Puna Gam Rd, Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Surat, Gujarat 395010, India', 6, 26, 'maheshbedi@gmail.com', '9374881397', '2024-03-28', '09:11', '22:11', '0', '2024-03-26 04:11:56'),
(15, 43, 'Ruhan Blood Camp', 'Dr. Bhatiya Yadi', 'Hotel Sharayu One, Near, Sharayu One, Faria Alta, Mapusa - Bicholim Rd, Junction, Mapusa, Goa 403507', 4, 16, 'bhatiyayadi@gmail.com', '6335787644', '2024-04-18', '09:00', '18:00', '1', '2024-03-26 04:11:56'),
(17, 49, 'Mahrshi Blood Camp', 'Dr. Kiran Bhuta', 'Hotel Sharayu One, Near, Sharayu One, Faria Alta, Mapusa - Bicholim Rd, Junction, Mapusa, Goa 403507', 4, 16, 'kiran@gmail.com', '6335787644', '2024-06-18', '09:00', '18:00', '2', '2024-03-26 04:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(5) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED NOT NULL,
  `city_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `state_id`, `city_name`) VALUES
(1, 1, 'Jaipur'),
(2, 1, 'Ajmer'),
(3, 1, 'Udaipur'),
(4, 1, 'Kota'),
(5, 1, 'Bikaner'),
(6, 2, 'Bhopal'),
(7, 2, 'Indore'),
(8, 2, 'Rewa'),
(9, 2, 'Ujjain'),
(10, 2, 'Sagar'),
(11, 3, 'Mumbai'),
(12, 3, 'Nagpur'),
(13, 3, 'Satara'),
(14, 3, 'Achalpur'),
(15, 3, 'Beed'),
(16, 4, 'Mapusa'),
(17, 4, 'Panaji'),
(18, 4, 'Bardez'),
(19, 4, 'Benaulim'),
(20, 4, 'Vagator'),
(21, 5, 'Amritsar'),
(22, 5, 'Jalanghar'),
(23, 5, 'Kapurthala'),
(24, 5, 'Ludhiana'),
(25, 5, 'Patiala'),
(26, 6, 'Surat'),
(27, 6, 'Rajkot'),
(28, 6, 'Ahmedabad'),
(29, 6, 'Navsari'),
(30, 6, 'Vadodara');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contactus_id` int(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '0=Active\r\n1=Deleted By Admin',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contactus_id`, `name`, `phone_no`, `email`, `reason`, `status`, `created_at`) VALUES
(15, 'Aarush Shah', '1234554321', 'aarush@gmail.com', 'I wanted to ask about camp details.', '1', '2024-03-05 06:26:08'),
(22, 'Bansari Sorathiya', '9374881397', 'bansarisorathiya74@gmail.com', 'I don\'t know if I am eligible to give blood or not.', '1', '2024-03-07 04:06:52'),
(23, 'Bansari Sorathiya', '9374881397', 'bansarisorathiya74@gmail.com', 'My blood group is O+ and its rare one. will i able to get when I needed?', '1', '2024-03-07 04:07:34'),
(24, 'Aarush Shah', '1234554321', 'aarush@gmail.com', 'My blood group is AB+. So I can get blood only from AB+ blood group People right?', '1', '2024-03-05 06:26:08'),
(25, 'Arya Shah', '1234554321', 'arya@gmail.com', 'Hello. I don\'t know blood donation procedure.', '1', '2024-03-14 08:14:17'),
(26, 'Maca', '1234554321', 'macamark@gmail.com', 'Hello Good Morning. What if there are no any donor of my blood group?', '1', '2024-03-14 08:15:36'),
(27, 'Tom', '1234554321', 'tom@yahoo.com', 'Hello. I just wanted to check if its working or what?', '0', '2024-03-14 08:17:59'),
(29, 'Tom', '1234567890', 'tom@gmail.com', 'Hello. I want to ask what should I do if I don\'t know my blood group.', '1', '2024-03-14 06:16:24'),
(30, 'Aroha', '1234554321', 'arohaastro@gmail.com', 'How Can I register camp?', '1', '2024-03-20 12:28:20'),
(31, 'Bansari', '6378281123', 'bansarisorathiya74@gmail.com', 'Hello....How Can I register my own camp?', '1', '2024-03-28 02:35:49'),
(32, 'Aarush Shah', '9028932426', 'aarush@gmail.com', 'I am an O+. Is is okey to donate blood to everyone?', '1', '2024-03-28 02:37:02'),
(33, 'Ishika', '9727041535', 'ishikabutani@gmail.com', 'Hello', '0', '2024-03-29 05:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_request`
--

CREATE TABLE `deleted_request` (
  `delete_id` int(30) UNSIGNED NOT NULL,
  `request_id` int(30) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED NOT NULL COMMENT 'The One who has deleted the request.',
  `reason` enum('completed','NoNeed','by_admin','deactivate') NOT NULL,
  `method` enum('relatives','ourSite','hospital','bloodBank') DEFAULT NULL,
  `donor_member_id` int(30) UNSIGNED DEFAULT NULL COMMENT 'The One who have donated Blood...That user''s member_id',
  `certifide` enum('Yes','No') DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_request`
--

INSERT INTO `deleted_request` (`delete_id`, `request_id`, `member_id`, `reason`, `method`, `donor_member_id`, `certifide`, `created_at`) VALUES
(52, 71, 49, 'by_admin', NULL, NULL, NULL, '2024-03-27 01:00:41'),
(53, 72, 43, 'deactivate', NULL, NULL, NULL, '2024-03-29 11:46:18'),
(54, 68, 47, 'deactivate', NULL, NULL, NULL, '2024-03-29 11:50:14'),
(55, 77, 43, 'deactivate', NULL, NULL, NULL, '2024-03-29 12:19:09'),
(56, 78, 43, 'completed', 'ourSite', 49, 'Yes', '2024-04-01 02:55:52'),
(57, 75, 47, 'deactivate', NULL, NULL, NULL, '2024-04-03 10:55:36'),
(58, 74, 47, 'completed', 'ourSite', 43, NULL, '2024-04-03 12:36:10'),
(59, 79, 47, 'completed', 'ourSite', 43, NULL, '2024-04-03 12:37:03'),
(60, 81, 49, 'deactivate', NULL, NULL, NULL, '2024-04-03 12:52:19'),
(61, 82, 49, 'deactivate', NULL, NULL, NULL, '2024-04-03 12:52:24'),
(62, 83, 49, 'deactivate', NULL, NULL, NULL, '2024-04-03 12:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(30) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED DEFAULT NULL,
  `donation_status` enum('0','1','2') DEFAULT NULL COMMENT '0=pending eligibility 1=eligible 2=deleted by Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `member_id`, `donation_status`) VALUES
(8, 43, '1'),
(9, 47, '1'),
(10, 49, '1'),
(11, 48, '0'),
(12, 54, '0');

-- --------------------------------------------------------

--
-- Table structure for table `eligibility`
--

CREATE TABLE `eligibility` (
  `eligible_id` int(30) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED DEFAULT NULL,
  `age` mediumint(10) UNSIGNED DEFAULT NULL,
  `weight` int(10) UNSIGNED DEFAULT NULL,
  `tattoo_test` enum('Yes','No') DEFAULT NULL,
  `hiv_test` enum('Yes','No') DEFAULT NULL,
  `blood_id` mediumint(3) UNSIGNED DEFAULT NULL,
  `medical_condition` varchar(50) DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eligibility`
--

INSERT INTO `eligibility` (`eligible_id`, `member_id`, `age`, `weight`, `tattoo_test`, `hiv_test`, `blood_id`, `medical_condition`, `created_at`) VALUES
(8, 49, 18, 48, 'No', 'No', 27, '', '2024-04-01'),
(9, 43, 25, 47, 'No', 'No', 27, 'None', '2024-04-01'),
(10, 47, 18, 53, 'No', 'No', 42, 'None', '2024-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(30) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED NOT NULL,
  `feedback` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED NOT NULL,
  `lat` varchar(10) NOT NULL,
  `longe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `member_id`, `lat`, `longe`) VALUES
(1, 47, '21.2403471', '72.8869815'),
(2, 43, '21.23650', '72.85207'),
(3, 49, '21.2403471', '72.8869815'),
(4, 48, '21.2403471', '72.8869815');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `history_id` int(10) UNSIGNED NOT NULL,
  `login_id` int(5) UNSIGNED NOT NULL,
  `server_address` varchar(15) NOT NULL,
  `server_name` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`history_id`, `login_id`, `server_address`, `server_name`, `created_at`) VALUES
(87, 24, '::1', 'localhost', '2024-03-26 03:00:47'),
(88, 1, '::1', 'localhost', '2024-03-26 03:01:58'),
(89, 1, '::1', 'localhost', '2024-03-27 09:40:44'),
(90, 1, '::1', 'localhost', '2024-03-27 06:01:18'),
(91, 1, '::1', 'localhost', '2024-03-29 03:41:47'),
(93, 1, '::1', 'localhost', '2024-04-01 01:17:23'),
(94, 1, '::1', 'localhost', '2024-04-01 05:38:46'),
(95, 1, '::1', 'localhost', '2024-04-01 05:39:21'),
(96, 1, '::1', 'localhost', '2024-04-02 10:36:09'),
(97, 1, '::1', 'localhost', '2024-04-03 12:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(30) UNSIGNED NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` int(5) UNSIGNED NOT NULL,
  `state` int(10) UNSIGNED NOT NULL,
  `landmark` varchar(80) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `member_status` enum('0','1','2') NOT NULL COMMENT '0=Deleted By Member 1=Active Status 2=Deactivated by Admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `img`, `email`, `pwd`, `verify_token`, `name`, `contact_no`, `gender`, `dob`, `address`, `city`, `state`, `landmark`, `pincode`, `member_status`, `created_at`) VALUES
(43, 'Screenshot 2024-01-19 134139.png', 'bansarisorathiya74@gmail.com', 'kpopstan', '72e1d0bfbcaa88d19dc8a23b972f6295', 'Bansari Sorathiya', '1234554321', 'Female', '1999-01-27', '4, Puna Gam Rd, Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Surat, Gujarat 395010, India', 21, 5, 'Polaris Mall', '645010', '1', '2024-02-14 04:11:24'),
(47, '', 'aarush@gmail.com', 'Kpopstan217251^', '016dd9c88d6c69f01d0e826d0c1e3250', 'Aarush Shah', '1234554321', 'Male', '2006-03-02', '4, Puna Gam Rd, Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Surat, Gujarat 395010, India', 12, 3, 'ACD Mall', '395010', '1', '2024-03-26 03:03:44'),
(48, 'Screenshot 2024-01-24 004626.png', 'aaryapatel@gmail.com', 'Kpop251$', 'ae65d279e9a19aaa87d9d0e47088d01d', 'Arya Patel', '2222222222', 'Female', '2006-03-02', '4, Puna Gam Rd, Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Surat, Gujarat 395010, India', 4, 1, 'Polaris Mall', '395010', '0', '2024-03-26 03:08:55'),
(49, 'Screenshot 2024-01-24 004626.png', 'sorathiyashruti9@gmail.com', 'Shruti123^', 'e2feafa36de785711a9f0598664f788a', 'Shruti Sorathiya', '9374881397', 'Female', '2006-03-01', '4, Puna Gam Rd, Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Dayaramnagar Society, Gandhi Nagar, Punagam, Varachha Surat, Gujarat 395010, India', 26, 6, 'Polaris Mall', '395010', '1', '2024-04-26 03:42:49'),
(54, 'Screenshot 2024-01-24 004411.png', 'trusharakholiya9@gmail.com', 'Trusha123!', 'bca46e1d4b1fdb922cde66fda91cc2c2', 'Trusha Rakholiya', '6353183135', 'Female', '2003-09-02', '4, Tikuji Ni Wadi Rd, Happy Valley, Manpada, Thane West, Thane, Maharashtra 400607', 11, 3, 'Chikuji ni vadi', '400607', '1', '2024-03-29 03:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `requester`
--

CREATE TABLE `requester` (
  `request_id` int(5) UNSIGNED NOT NULL,
  `member_id` int(30) UNSIGNED NOT NULL,
  `patient_name` varchar(40) NOT NULL,
  `blood_id` mediumint(3) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requester`
--

INSERT INTO `requester` (`request_id`, `member_id`, `patient_name`, `blood_id`, `created_at`) VALUES
(80, 47, 'Smriti Patel', 43, '2024-04-03 12:40:06'),
(84, 49, 'Kridha', 45, '2024-05-03 01:01:11'),
(85, 54, 'Aroha Milly', 39, '2024-04-06 01:07:50'),
(86, 43, 'Ruhan Hami', 27, '2024-04-04 12:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(10) UNSIGNED NOT NULL,
  `state_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`) VALUES
(1, 'Rajasthan'),
(2, 'Madhya Pradesh'),
(3, 'Maharashtra'),
(4, 'Goa'),
(5, 'Punjab'),
(6, 'Gujarat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`camp_id`),
  ADD KEY `camp_ibfk_1` (`member_id`),
  ADD KEY `camp_ibfk_2` (`state_id`),
  ADD KEY `camp_ibfk_3` (`city_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contactus_id`);

--
-- Indexes for table `deleted_request`
--
ALTER TABLE `deleted_request`
  ADD PRIMARY KEY (`delete_id`),
  ADD KEY `member_id` (`member_id`) USING BTREE,
  ADD KEY `rid` (`request_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `donors_ibfk_1` (`member_id`);

--
-- Indexes for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD PRIMARY KEY (`eligible_id`),
  ADD KEY `eligibility_ibfk_1` (`member_id`),
  ADD KEY `eligibility_ibfk_2` (`blood_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `mid` (`member_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `mmid` (`member_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `login_id_2` (`login_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `city` (`city`),
  ADD KEY `state` (`state`);

--
-- Indexes for table `requester`
--
ALTER TABLE `requester`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `blood_id` (`blood_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `login_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `blood_id` mediumint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `camp`
--
ALTER TABLE `camp`
  MODIFY `camp_id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contactus_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `deleted_request`
--
ALTER TABLE `deleted_request`
  MODIFY `delete_id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eligibility`
--
ALTER TABLE `eligibility`
  MODIFY `eligible_id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `history_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `requester`
--
ALTER TABLE `requester`
  MODIFY `request_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `camp`
--
ALTER TABLE `camp`
  ADD CONSTRAINT `camp_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `camp_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`state_id`),
  ADD CONSTRAINT `camp_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `state_id` FOREIGN KEY (`state_id`) REFERENCES `states` (`state_id`) ON UPDATE CASCADE;

--
-- Constraints for table `deleted_request`
--
ALTER TABLE `deleted_request`
  ADD CONSTRAINT `mmid` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON UPDATE CASCADE;

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `donors_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON UPDATE CASCADE;

--
-- Constraints for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD CONSTRAINT `eligibility_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `eligibility_ibfk_2` FOREIGN KEY (`blood_id`) REFERENCES `blood_group` (`blood_id`) ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `mid` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON UPDATE CASCADE;

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_id` FOREIGN KEY (`login_id`) REFERENCES `admin_login` (`login_id`) ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `city_id` FOREIGN KEY (`city`) REFERENCES `city` (`city_id`) ON UPDATE CASCADE;

--
-- Constraints for table `requester`
--
ALTER TABLE `requester`
  ADD CONSTRAINT `blood_id` FOREIGN KEY (`blood_id`) REFERENCES `blood_group` (`blood_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
