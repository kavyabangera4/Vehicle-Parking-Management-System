-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 01:11 PM
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
-- Database: `vpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply` varchar(200) NOT NULL,
  `status` enum('Unread','Read') DEFAULT 'Unread',
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `reply`, `status`, `UserID`) VALUES
(1, 'kavya', 'kavya21@gmail.com', 'Provide a space', 'space is available', 'Read', NULL),
(2, 'jenitha', 'jenitha21@gmail.com', 'What are the services available?', 'Please check our home page', 'Read', NULL),
(3, 'Ajay', 'ajay21@gmail.com', 'How much you charge for bike?', 'space is available', 'Read', NULL),
(4, 'Ajay', 'ajay21@gmail.com', 'PLeasee', 'What', 'Read', NULL),
(5, 'Ajay', 'ajay21@gmail.com', 'Charge', 'it is based on category', 'Read', 5),
(6, 'kavya', 'kavya21@gmail.com', 'Is there space available', 'space is available', 'Read', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spaceslot`
--

CREATE TABLE `spaceslot` (
  `spaceslotID` int(10) NOT NULL,
  `category` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spaceslot`
--

INSERT INTO `spaceslot` (`spaceslotID`, `category`, `status`) VALUES
(1, 'Bike', 'Occupied'),
(2, 'Bike', 'Available'),
(3, 'Car', 'Occupied'),
(4, 'Car', 'Available'),
(5, 'Truck', 'Occupied'),
(6, 'Bike', 'Occupied'),
(8, 'Bike', 'Available'),
(9, 'Bike', 'Occupied'),
(10, 'Truck', 'Occupied'),
(11, 'Truck', 'Occupied'),
(12, 'Bike', 'Occupied'),
(13, 'Truck', 'Occupied'),
(14, 'Bike', 'Occupied'),
(15, 'Bike', 'Occupied'),
(16, 'Bike', 'Occupied'),
(17, 'Bike', 'Available'),
(18, 'Car', 'Occupied'),
(19, 'Bike', 'Available'),
(20, 'Truck', 'Available'),
(21, 'Bike', 'Available'),
(22, 'Truck', 'Available'),
(23, 'Bike', 'Available'),
(24, 'Bike', 'Available'),
(25, 'Car', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(100) DEFAULT NULL,
  `UserName` varchar(50) NOT NULL,
  `MobileNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`) VALUES
(1, 'Admin', 'admin', '7898799798', 'tester1@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `RatePerHour` decimal(10,2) NOT NULL DEFAULT 50.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `RatePerHour`) VALUES
(1, 'Bike', '50.00'),
(2, 'Car', '100.00'),
(3, 'Truck', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`ID`, `FullName`, `UserName`, `Email`, `Password`) VALUES
(1, 'Anuj ', 'anuj', 'anuj@123', 'anuj123'),
(2, 'Kavya', 'kavya12', 'kavya21@gmail.com', 'kavya123'),
(3, 'Shivani', 'shivani12', 'shivani@123', 'shivani123'),
(4, 'Jenitha', 'jenitha', 'jenitha21@gmail.com', 'jenitha21'),
(5, 'Ajay', 'ajay', 'ajay21@gmail.com', 'ajay123');

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicle`
--

CREATE TABLE `tblvehicle` (
  `ID` int(11) NOT NULL,
  `VehicleNumber` varchar(20) NOT NULL,
  `OwnerName` varchar(100) NOT NULL,
  `MobileNumber` varchar(15) NOT NULL,
  `VehicleCategory` varchar(50) NOT NULL,
  `EntryTime` datetime DEFAULT current_timestamp(),
  `ExitTime` datetime DEFAULT current_timestamp(),
  `charge` decimal(10,2),
  `ParkingSlot` varchar(10) DEFAULT NULL,
  `Status` enum('Incoming','Outgoing') DEFAULT 'Incoming',
  `slotID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblvehicle`
--

INSERT INTO `tblvehicle` (`ID`, `VehicleNumber`, `OwnerName`, `MobileNumber`, `VehicleCategory`, `EntryTime`, `ExitTime`, `charge`, `ParkingSlot`, `Status`, `slotID`, `UserID`) VALUES
(61, 'KA231545122211', 'Jaya', '8765432190', 'Bike', '2025-03-08 15:32:48', '2025-03-08 15:41:52', '50.00', NULL, 'Outgoing', 17, 2),
(62, 'KA23154509999', 'Jay', '8765432190', 'Car', '2025-03-08 15:40:00', '2025-03-08 15:41:38', '100.00', NULL, 'Outgoing', NULL, 2),
(63, 'KA231111', 'Jay', '8765432190', 'Bike', '2025-03-08 15:43:30', '2025-03-08 16:12:30', '50.00', NULL, 'Outgoing', 1, 2),
(64, 'KA101', 'Jay', '8765432190', 'Car', '2025-03-08 16:00:40', '2025-03-08 16:12:34', '100.00', NULL, 'Outgoing', 3, 2),
(65, 'KA23112111', 'Jaya', '8765432190', 'Bike', '2025-03-08 16:07:06', '2025-03-08 16:12:37', '50.00', NULL, 'Outgoing', 2, 4),
(66, 'KA23154500111', 'Kavya', '8765432190', 'Bike', '2025-03-08 16:13:49', '2025-03-08 16:13:49', '50.00', NULL, 'Incoming', 1, 2),
(67, 'KA2315450987', 'Ajay', '8765432190', 'Car', '2025-03-08 16:56:28', '2025-03-08 16:56:28', '100.00', NULL, 'Incoming', 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact` (`UserID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `spaceslot`
--
ALTER TABLE `spaceslot`
  ADD PRIMARY KEY (`spaceslotID`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `VehicleNumber` (`VehicleNumber`),
  ADD KEY `fk_user_vehicle` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spaceslot`
--
ALTER TABLE `spaceslot`
  MODIFY `spaceslotID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact` FOREIGN KEY (`UserID`) REFERENCES `tblusers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblvehicle`
--
ALTER TABLE `tblvehicle`
  ADD CONSTRAINT `fk_user_vehicle` FOREIGN KEY (`UserID`) REFERENCES `tblusers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
