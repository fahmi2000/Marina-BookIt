-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2020 at 05:22 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `b_userID` int(255) NOT NULL,
  `b_facilityName` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `b_durationDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `b_grand ball room 1`
--

CREATE TABLE `b_grand ball room 1` (
  `ID` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `b_userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `b_grand ball room 1`
--

INSERT INTO `b_grand ball room 1` (`ID`, `date`, `b_userID`) VALUES
(0, '2020-01-01', NULL),
(100, '2020-04-10', NULL),
(200, '2020-07-19', NULL),
(300, '2020-10-27', NULL),
(1, '2020-01-02', NULL),
(101, '2020-04-11', NULL),
(201, '2020-07-20', NULL),
(301, '2020-10-28', NULL),
(2, '2020-01-03', NULL),
(102, '2020-04-12', NULL),
(202, '2020-07-21', NULL),
(302, '2020-10-29', NULL),
(3, '2020-01-04', NULL),
(103, '2020-04-13', NULL),
(203, '2020-07-22', NULL),
(303, '2020-10-30', NULL),
(4, '2020-01-05', NULL),
(104, '2020-04-14', NULL),
(204, '2020-07-23', NULL),
(304, '2020-10-31', NULL),
(5, '2020-01-06', NULL),
(105, '2020-04-15', NULL),
(205, '2020-07-24', NULL),
(305, '2020-11-01', NULL),
(6, '2020-01-07', NULL),
(106, '2020-04-16', NULL),
(206, '2020-07-25', NULL),
(306, '2020-11-02', NULL),
(7, '2020-01-08', NULL),
(107, '2020-04-17', NULL),
(207, '2020-07-26', NULL),
(307, '2020-11-03', NULL),
(8, '2020-01-09', NULL),
(108, '2020-04-18', NULL),
(208, '2020-07-27', NULL),
(308, '2020-11-04', NULL),
(9, '2020-01-10', NULL),
(109, '2020-04-19', NULL),
(209, '2020-07-28', NULL),
(309, '2020-11-05', NULL),
(10, '2020-01-11', NULL),
(110, '2020-04-20', NULL),
(210, '2020-07-29', NULL),
(310, '2020-11-06', NULL),
(11, '2020-01-12', NULL),
(111, '2020-04-21', NULL),
(211, '2020-07-30', NULL),
(311, '2020-11-07', NULL),
(12, '2020-01-13', NULL),
(112, '2020-04-22', NULL),
(212, '2020-07-31', NULL),
(312, '2020-11-08', NULL),
(13, '2020-01-14', NULL),
(113, '2020-04-23', NULL),
(213, '2020-08-01', NULL),
(313, '2020-11-09', NULL),
(14, '2020-01-15', NULL),
(114, '2020-04-24', NULL),
(214, '2020-08-02', NULL),
(314, '2020-11-10', NULL),
(15, '2020-01-16', NULL),
(115, '2020-04-25', NULL),
(215, '2020-08-03', NULL),
(315, '2020-11-11', NULL),
(16, '2020-01-17', NULL),
(116, '2020-04-26', NULL),
(216, '2020-08-04', NULL),
(316, '2020-11-12', NULL),
(17, '2020-01-18', NULL),
(117, '2020-04-27', NULL),
(217, '2020-08-05', NULL),
(317, '2020-11-13', NULL),
(18, '2020-01-19', NULL),
(118, '2020-04-28', NULL),
(218, '2020-08-06', NULL),
(318, '2020-11-14', NULL),
(19, '2020-01-20', NULL),
(119, '2020-04-29', NULL),
(219, '2020-08-07', NULL),
(319, '2020-11-15', NULL),
(20, '2020-01-21', NULL),
(120, '2020-04-30', NULL),
(220, '2020-08-08', NULL),
(320, '2020-11-16', NULL),
(21, '2020-01-22', NULL),
(121, '2020-05-01', NULL),
(221, '2020-08-09', NULL),
(321, '2020-11-17', NULL),
(22, '2020-01-23', NULL),
(122, '2020-05-02', NULL),
(222, '2020-08-10', NULL),
(322, '2020-11-18', NULL),
(23, '2020-01-24', NULL),
(123, '2020-05-03', NULL),
(223, '2020-08-11', NULL),
(323, '2020-11-19', NULL),
(24, '2020-01-25', NULL),
(124, '2020-05-04', NULL),
(224, '2020-08-12', NULL),
(324, '2020-11-20', NULL),
(25, '2020-01-26', NULL),
(125, '2020-05-05', NULL),
(225, '2020-08-13', NULL),
(325, '2020-11-21', NULL),
(26, '2020-01-27', NULL),
(126, '2020-05-06', NULL),
(226, '2020-08-14', NULL),
(326, '2020-11-22', NULL),
(27, '2020-01-28', NULL),
(127, '2020-05-07', NULL),
(227, '2020-08-15', NULL),
(327, '2020-11-23', NULL),
(28, '2020-01-29', NULL),
(128, '2020-05-08', NULL),
(228, '2020-08-16', NULL),
(328, '2020-11-24', NULL),
(29, '2020-01-30', NULL),
(129, '2020-05-09', NULL),
(229, '2020-08-17', NULL),
(329, '2020-11-25', NULL),
(30, '2020-01-31', NULL),
(130, '2020-05-10', NULL),
(230, '2020-08-18', NULL),
(330, '2020-11-26', NULL),
(31, '2020-02-01', NULL),
(131, '2020-05-11', NULL),
(231, '2020-08-19', NULL),
(331, '2020-11-27', NULL),
(32, '2020-02-02', NULL),
(132, '2020-05-12', NULL),
(232, '2020-08-20', NULL),
(332, '2020-11-28', NULL),
(33, '2020-02-03', NULL),
(133, '2020-05-13', NULL),
(233, '2020-08-21', NULL),
(333, '2020-11-29', NULL),
(34, '2020-02-04', NULL),
(134, '2020-05-14', NULL),
(234, '2020-08-22', NULL),
(334, '2020-11-30', NULL),
(35, '2020-02-05', NULL),
(135, '2020-05-15', NULL),
(235, '2020-08-23', NULL),
(335, '2020-12-01', NULL),
(36, '2020-02-06', NULL),
(136, '2020-05-16', NULL),
(236, '2020-08-24', NULL),
(336, '2020-12-02', NULL),
(37, '2020-02-07', NULL),
(137, '2020-05-17', NULL),
(237, '2020-08-25', NULL),
(337, '2020-12-03', NULL),
(38, '2020-02-08', NULL),
(138, '2020-05-18', NULL),
(238, '2020-08-26', NULL),
(338, '2020-12-04', NULL),
(39, '2020-02-09', NULL),
(139, '2020-05-19', NULL),
(239, '2020-08-27', NULL),
(339, '2020-12-05', NULL),
(40, '2020-02-10', NULL),
(140, '2020-05-20', NULL),
(240, '2020-08-28', NULL),
(340, '2020-12-06', NULL),
(41, '2020-02-11', NULL),
(141, '2020-05-21', NULL),
(241, '2020-08-29', NULL),
(341, '2020-12-07', NULL),
(42, '2020-02-12', NULL),
(142, '2020-05-22', NULL),
(242, '2020-08-30', NULL),
(342, '2020-12-08', NULL),
(43, '2020-02-13', NULL),
(143, '2020-05-23', NULL),
(243, '2020-08-31', NULL),
(343, '2020-12-09', NULL),
(44, '2020-02-14', NULL),
(144, '2020-05-24', NULL),
(244, '2020-09-01', NULL),
(344, '2020-12-10', NULL),
(45, '2020-02-15', NULL),
(145, '2020-05-25', NULL),
(245, '2020-09-02', NULL),
(345, '2020-12-11', NULL),
(46, '2020-02-16', NULL),
(146, '2020-05-26', NULL),
(246, '2020-09-03', NULL),
(346, '2020-12-12', NULL),
(47, '2020-02-17', NULL),
(147, '2020-05-27', NULL),
(247, '2020-09-04', NULL),
(347, '2020-12-13', NULL),
(48, '2020-02-18', NULL),
(148, '2020-05-28', NULL),
(248, '2020-09-05', NULL),
(348, '2020-12-14', NULL),
(49, '2020-02-19', NULL),
(149, '2020-05-29', NULL),
(249, '2020-09-06', NULL),
(349, '2020-12-15', NULL),
(50, '2020-02-20', NULL),
(150, '2020-05-30', NULL),
(250, '2020-09-07', NULL),
(350, '2020-12-16', NULL),
(51, '2020-02-21', NULL),
(151, '2020-05-31', NULL),
(251, '2020-09-08', NULL),
(351, '2020-12-17', NULL),
(52, '2020-02-22', NULL),
(152, '2020-06-01', NULL),
(252, '2020-09-09', NULL),
(352, '2020-12-18', NULL),
(53, '2020-02-23', NULL),
(153, '2020-06-02', NULL),
(253, '2020-09-10', NULL),
(353, '2020-12-19', NULL),
(54, '2020-02-24', NULL),
(154, '2020-06-03', NULL),
(254, '2020-09-11', NULL),
(354, '2020-12-20', NULL),
(55, '2020-02-25', NULL),
(155, '2020-06-04', NULL),
(255, '2020-09-12', NULL),
(355, '2020-12-21', NULL),
(56, '2020-02-26', NULL),
(156, '2020-06-05', NULL),
(256, '2020-09-13', NULL),
(356, '2020-12-22', NULL),
(57, '2020-02-27', NULL),
(157, '2020-06-06', NULL),
(257, '2020-09-14', NULL),
(357, '2020-12-23', NULL),
(58, '2020-02-28', NULL),
(158, '2020-06-07', NULL),
(258, '2020-09-15', NULL),
(358, '2020-12-24', NULL),
(59, '2020-02-29', NULL),
(159, '2020-06-08', NULL),
(259, '2020-09-16', NULL),
(359, '2020-12-25', NULL),
(60, '2020-03-01', NULL),
(160, '2020-06-09', NULL),
(260, '2020-09-17', NULL),
(360, '2020-12-26', NULL),
(61, '2020-03-02', NULL),
(161, '2020-06-10', NULL),
(261, '2020-09-18', NULL),
(361, '2020-12-27', NULL),
(62, '2020-03-03', NULL),
(162, '2020-06-11', NULL),
(262, '2020-09-19', NULL),
(362, '2020-12-28', NULL),
(63, '2020-03-04', NULL),
(163, '2020-06-12', NULL),
(263, '2020-09-20', NULL),
(363, '2020-12-29', NULL),
(64, '2020-03-05', NULL),
(164, '2020-06-13', NULL),
(264, '2020-09-21', NULL),
(364, '2020-12-30', NULL),
(65, '2020-03-06', NULL),
(165, '2020-06-14', NULL),
(265, '2020-09-22', NULL),
(365, '2020-12-31', NULL),
(66, '2020-03-07', NULL),
(166, '2020-06-15', NULL),
(266, '2020-09-23', NULL),
(67, '2020-03-08', NULL),
(167, '2020-06-16', NULL),
(267, '2020-09-24', NULL),
(68, '2020-03-09', NULL),
(168, '2020-06-17', NULL),
(268, '2020-09-25', NULL),
(69, '2020-03-10', NULL),
(169, '2020-06-18', NULL),
(269, '2020-09-26', NULL),
(70, '2020-03-11', NULL),
(170, '2020-06-19', NULL),
(270, '2020-09-27', NULL),
(71, '2020-03-12', NULL),
(171, '2020-06-20', NULL),
(271, '2020-09-28', NULL),
(72, '2020-03-13', NULL),
(172, '2020-06-21', NULL),
(272, '2020-09-29', NULL),
(73, '2020-03-14', NULL),
(173, '2020-06-22', NULL),
(273, '2020-09-30', NULL),
(74, '2020-03-15', NULL),
(174, '2020-06-23', NULL),
(274, '2020-10-01', NULL),
(75, '2020-03-16', NULL),
(175, '2020-06-24', NULL),
(275, '2020-10-02', NULL),
(76, '2020-03-17', NULL),
(176, '2020-06-25', NULL),
(276, '2020-10-03', NULL),
(77, '2020-03-18', NULL),
(177, '2020-06-26', NULL),
(277, '2020-10-04', NULL),
(78, '2020-03-19', NULL),
(178, '2020-06-27', NULL),
(278, '2020-10-05', NULL),
(79, '2020-03-20', NULL),
(179, '2020-06-28', NULL),
(279, '2020-10-06', NULL),
(80, '2020-03-21', NULL),
(180, '2020-06-29', NULL),
(280, '2020-10-07', NULL),
(81, '2020-03-22', NULL),
(181, '2020-06-30', NULL),
(281, '2020-10-08', NULL),
(82, '2020-03-23', NULL),
(182, '2020-07-01', NULL),
(282, '2020-10-09', NULL),
(83, '2020-03-24', NULL),
(183, '2020-07-02', NULL),
(283, '2020-10-10', NULL),
(84, '2020-03-25', NULL),
(184, '2020-07-03', NULL),
(284, '2020-10-11', NULL),
(85, '2020-03-26', NULL),
(185, '2020-07-04', NULL),
(285, '2020-10-12', NULL),
(86, '2020-03-27', NULL),
(186, '2020-07-05', NULL),
(286, '2020-10-13', NULL),
(87, '2020-03-28', NULL),
(187, '2020-07-06', NULL),
(287, '2020-10-14', NULL),
(88, '2020-03-29', NULL),
(188, '2020-07-07', NULL),
(288, '2020-10-15', NULL),
(89, '2020-03-30', NULL),
(189, '2020-07-08', NULL),
(289, '2020-10-16', NULL),
(90, '2020-03-31', NULL),
(190, '2020-07-09', NULL),
(290, '2020-10-17', NULL),
(91, '2020-04-01', NULL),
(191, '2020-07-10', NULL),
(291, '2020-10-18', NULL),
(92, '2020-04-02', NULL),
(192, '2020-07-11', NULL),
(292, '2020-10-19', NULL),
(93, '2020-04-03', NULL),
(193, '2020-07-12', NULL),
(293, '2020-10-20', NULL),
(94, '2020-04-04', NULL),
(194, '2020-07-13', NULL),
(294, '2020-10-21', NULL),
(95, '2020-04-05', NULL),
(195, '2020-07-14', NULL),
(295, '2020-10-22', NULL),
(96, '2020-04-06', NULL),
(196, '2020-07-15', NULL),
(296, '2020-10-23', NULL),
(97, '2020-04-07', NULL),
(197, '2020-07-16', NULL),
(297, '2020-10-24', NULL),
(98, '2020-04-08', NULL),
(198, '2020-07-17', NULL),
(298, '2020-10-25', NULL),
(99, '2020-04-09', NULL),
(199, '2020-07-18', NULL),
(299, '2020-10-26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facilityID` int(255) NOT NULL,
  `facilityName` varchar(100) NOT NULL,
  `facilityCapacity` varchar(255) NOT NULL,
  `facilityRate` varchar(255) NOT NULL,
  `facilityDescription` longtext NOT NULL,
  `facilityAmenities` longtext NOT NULL,
  `facilityStatus` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `facilityType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityID`, `facilityName`, `facilityCapacity`, `facilityRate`, `facilityDescription`, `facilityAmenities`, `facilityStatus`, `facilityType`) VALUES
(2, 'SWIMMING POOL', '10', '100', 'At 500m above sea-level, our place in the hills is 5-6 degrees cooler than and only 40 minutes away from the Klang Valley.                 The treehouse, crafted from recycled materials, nestles among some trees on the site with beautiful views of the adjacent valley.                 Enjoy a restful night among the sound of trees swaying in the breeze, reminiscent of a wooden boat on the seas.                 Advantageous location for bird watching, relaxing, reading, spending time with your special loved-one or writing your next masterpiece.', 'Pool · Seat · Table · PA · AC', '1', 'Sports'),
(7, 'MEETING3', '3', '3', '', '3', '1', ''),
(8, 'MEETING4', '4', '4', '', '4', '1', ''),
(9, 'MEETING5', '23', '1', '', '12', '1', ''),
(10, 'MEETING6', '6', '6', '', '6', '1', ''),
(11, 'MEETING7', '7', '7', '', '7', '1', ''),
(12, 'MEETING8', '8', '8', '', '8', '1', ''),
(13, 'MEETING9', '9', '9', '', '9', '1', ''),
(14, 'MEETING0', '10', '10', '', '10', '1', ''),
(15, 'TEST2', 'TEST3', '4', '', '4', '1', ''),
(16, 'TEST2', 'TEST3', '4', '', '4', '1', ''),
(17, 'TEST3', '3', '3', '', '3', '1', ''),
(18, 'TEST4', '4', '4', '', '4', '1', ''),
(19, 'TEST5', '5', '5', '', '5', '1', ''),
(20, 'TEST6', '6', '6', '', '6', '1', ''),
(21, 'TEST7', '7', '7', '', '7', '1', ''),
(22, 'TEST8', '8', '8', '', '8', '1', ''),
(23, 'TEST9', '9', '9', '', '9', '1', ''),
(24, 'TEST11', '11', '11', '', 'Array', '1', ''),
(25, 'TEST12', '12', '121', '', 'Array', '1', ''),
(26, 'TEST13', '13', '13', '', 'Array', '1', ''),
(27, 'TEST14', '14', '14', '', 'Array', '1', ''),
(28, 'TEST15', '15', '15', '', 'Array', '1', ''),
(29, 'TEST16', '16', '16', '', 'Array', '1', ''),
(30, 'TEST17', '17', '17', '', 'POOL,SEAT,TABLE,PA,AIRCOND', '1', ''),
(31, 'TEST18', '18', '18', '', 'Pool · Seat · Table', '1', ''),
(32, 'GRAND BALL ROOM 1', '10', '10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Seat · Table · Pa · AIRCOND', '1', 'Formal');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(7, 'adelaidemeyrin12343@gmail.com', 'ec9770b6543ed6e2', '$2y$10$KuLfE5Sc0FhBrWWYuZADE.CuLc8yfnkZ8bTbw4Z1hjXPhUWHS1EWO', '1597410571');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(255) NOT NULL,
  `userType` varchar(20) NOT NULL,
  `userName` tinytext NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPwd` longtext NOT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `userGender` varchar(50) DEFAULT NULL,
  `emailVerify` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
  `forgotPwd` varchar(5) NOT NULL DEFAULT '0',
  `oneTimePwd` longtext CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userType`, `userName`, `userEmail`, `userPwd`, `fName`, `lName`, `phoneNumber`, `userGender`, `emailVerify`, `forgotPwd`, `oneTimePwd`) VALUES
(1, '1', 'aliff', 'fahmialiff00@gmail.com', '$2y$10$yTykICKf7MoIF1YQpzw2u.rBRB2C6JG/TTStQ/3XTTJAhlZGdg.Za', 'Muhamad', 'Fahmi', '123213213123', 'maleGender', '', '0', NULL),
(5, '3', 'qwertyqaz', 'qwertyqaz12343@gmail.com', '$2y$10$TpGJIP2O.BPjORwkNiztLer75t4NHTqxZ7NvTSDKsZ2UpLjSzt6Fi', NULL, NULL, NULL, NULL, '0', '0', ''),
(12, '2', 'adam', 'adamzshah9600@gmail.com', '$2y$10$07JAQa6/nsceUth8BoQr3O/KLcQkOWQ7BjMGbzM0gNwffRqoFxQxC', 'Adam', 'Adam', '1212112', 'maleGender', '0', '0', NULL),
(14, '3', 'meyrin', 'adelaidemeyrin12343@gmail.com', '$2y$10$xybfXvzoqp8Dt56GE9t5EeMfYDBkjuk6EgmKKNBSvxJM81iOOFjhW', 'meyrin', 'meyrin', '112344123', 'maleGender', '1', '0', '0'),
(15, '1', 'test', 'test@gmail.com', '$2y$10$3IWnAJy4h.CkoQ74T.HWf.e1CXMPFPWrMIsGMOgg9J//i9BH0RWtq', 'mr test', 'test', NULL, 'maleGender', '0', '0', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facilityID`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facilityID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
