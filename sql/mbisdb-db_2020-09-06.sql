-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2020 at 08:38 PM
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
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facilityID` int(255) NOT NULL,
  `facilityName` varchar(100) NOT NULL,
  `facilityCapacity` varchar(255) NOT NULL,
  `facilityRate` varchar(255) NOT NULL,
  `facilityAmenities` longtext NOT NULL,
  `facilityStatus` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityID`, `facilityName`, `facilityCapacity`, `facilityRate`, `facilityAmenities`, `facilityStatus`) VALUES
(2, 'SWIMMING POOL', '25', '100', 'POOL', '2');

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
(1, '1', 'aliff', 'fahmialiff00@gmail.com', '$2y$12$Gj8Z4W1BT1XsxKyASkAJYuxn4HNCFq3umCIM5QpSKkKeny7Uct4Iu', 'Muhamad', 'Aliff', '123213213123', 'maleGender', '', '0', NULL),
(5, '3', 'qwertyqaz', 'qwertyqaz12343@gmail.com', '$2y$10$TpGJIP2O.BPjORwkNiztLer75t4NHTqxZ7NvTSDKsZ2UpLjSzt6Fi', NULL, NULL, NULL, NULL, '0', '0', ''),
(12, '2', 'adam', 'adamzshah9600@gmail.com', '$2y$10$07JAQa6/nsceUth8BoQr3O/KLcQkOWQ7BjMGbzM0gNwffRqoFxQxC', 'Adam', 'Adam', '1212112', 'maleGender', '0', '0', NULL),
(14, '2', 'meyrin', 'adelaidemeyrin12343@gmail.com', '$2y$10$Uz6JN4LkAI0bMUvTC5HM6uTKJxOYuOHKH3tY1wkilBOtbFQ2EJqf2', 'meyrin', 'meyrin', '112344123', 'maleGender', '1', '0', '0'),
(15, '1', 'test', 'test@gmail.com', '$2y$10$3IWnAJy4h.CkoQ74T.HWf.e1CXMPFPWrMIsGMOgg9J//i9BH0RWtq', 'mr test', 'test', NULL, 'maleGender', '0', '0', NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facilityID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
