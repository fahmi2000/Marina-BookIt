-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2020 at 04:26 PM
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
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, '2', 'fahmi', 'alifffahmi00@gmail.com', '$2y$10$wl9SdRqoZC7xOxHTBBQ.YePtV68Dl.E36z9chvKZtkiaVLqOM2zQi', 'Fahmi', 'Aliff', NULL, 'femaleGender', '', '0', NULL),
(3, '3', 'adam', 'adam@gmail.com', '$2y$10$pdmWwyQw6hh3IkiMOliIVeSnq5i9BVoSuiiwDYRT0nibCOXQHPrc6', 'Adam', 'Shah', '0383123456', 'shyGender', '', '0', NULL),
(5, '3', 'qwertyqaz', 'qwertyqaz12343@gmail.com', '$2y$10$TpGJIP2O.BPjORwkNiztLer75t4NHTqxZ7NvTSDKsZ2UpLjSzt6Fi', NULL, NULL, NULL, NULL, '0', '0', ''),
(9, '3', 'meyrin', 'adelaidemeyrin12343@gmail.com', '$2y$10$KGVKgXBa.SeAlUoM.I2jT.Nfznn8NmZUIZYb3Jaku08Jl2ecmHeJq', NULL, NULL, NULL, NULL, '1', '0', '$2y$10$/BTNtL1Xvg0d0nUuoMQ8r.k1WFYYNTFAGcSnWwoygFno4mn9FA57O');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
