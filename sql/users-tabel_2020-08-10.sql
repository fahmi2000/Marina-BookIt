-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2020 at 02:01 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `emailVerify` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userType`, `userName`, `userEmail`, `userPwd`, `fName`, `lName`, `phoneNumber`, `userGender`, `emailVerify`) VALUES
(1, '1', 'aliff', 'fahmialiff00@gmail.com', '$2y$12$Gj8Z4W1BT1XsxKyASkAJYuxn4HNCFq3umCIM5QpSKkKeny7Uct4Iu', 'Muhamad', 'Aliff', '0182329739', 'maleGender', ''),
(2, '2', 'fahmi', 'alifffahmi00@gmail.com', '$2y$10$wl9SdRqoZC7xOxHTBBQ.YePtV68Dl.E36z9chvKZtkiaVLqOM2zQi', 'Fahmi', 'Aliff', NULL, 'femaleGender', ''),
(3, '3', 'adam', 'adam@gmail.com', '$2y$10$pdmWwyQw6hh3IkiMOliIVeSnq5i9BVoSuiiwDYRT0nibCOXQHPrc6', 'Adam', 'Shah', '0383123456', 'shyGender', ''),
(4, '3', 'Redzuan', 'ahmdredzuan@gmail.com', '$2y$10$.2SeESXCEZ.s7SodjXWd9.pitnTRQurZtVQl.I0KWbWFuTFmMAY2G', 'Ahmad', 'Redzuan', '0179893160', 'maleGender', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
