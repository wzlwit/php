-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2018 at 11:32 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `requestID` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`requestID`, `firstName`, `lastName`, `email`, `subject`, `message`) VALUES
(1, 'asdsa', 'Hiwatig', 'hiawa@yahoads.cxa', 'sad', 'asdsadasd'),
(2, 'weimin', 'yu', 'yuweimin496@gmail.com', 'dddddd', 'adsfadfadfadsfasdfafdadfa');

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

CREATE TABLE `tblitem` (
  `ItemID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TotalQty` int(11) NOT NULL DEFAULT '0',
  `TotalPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `PaymentMethod` varchar(20) NOT NULL,
  `IsPayed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `OrderID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `ProID` int(11) NOT NULL,
  `UnitPrice` decimal(10,2) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ProID` int(11) NOT NULL,
  `ProName` varchar(30) NOT NULL,
  `ProDesc` varchar(2000) NOT NULL,
  `ProImg` varchar(100) NOT NULL,
  `ProPrice` varchar(20) NOT NULL,
  `InvQty` varchar(20) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `ProCategory` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`ProID`, `ProName`, `ProDesc`, `ProImg`, `ProPrice`, `InvQty`, `Active`, `ProCategory`) VALUES
(3, 'Dell laptop', 'Dell laptop muct change it', 'images/WeiminNew.jpg', '800', '10', 1, 'Laptop'),
(4, 'IBM laptop', 'IBM Laptop is not bad!', 'images/Carnew.jpg', '700', '10', 1, 'Laptop'),
(5, 'Java Server Programming', 'Professional Java Server Programming J2EE 1.3 Edition a!', 'images/Java books.jpg', '100', '10', 1, 'Books'),
(6, 'Dell insprion15R', 'Dell Insprion 15R Description', 'images/wwww.jpg', '1500', '10', 0, 'Laptop'),
(9, 'BookC', 'wwwww', 'images/BookC.jpg', '500', '20', 1, 'Books'),
(10, 'Dell laptop', 'Dell laptop muct change it', 'images/WeiminNew.jpg', '800', '10', 1, 'Laptop'),
(11, 'IBM laptop', 'IBM Laptop is not bad!', 'images/Carnew.jpg', '700', '10', 1, 'Laptop'),
(12, 'Dell laptop', 'Dell laptop muct change it', 'images/WeiminNew.jpg', '800', '10', 1, 'Laptop'),
(13, 'IBM laptop', 'IBM Laptop is not bad!', 'images/Carnew.jpg', '700', '10', 1, 'Laptop'),
(14, 'Dell insprion15R', 'Dell Insprion 15R Description', 'images/wwww.jpg', '1500', '10', 0, 'Laptop'),
(15, 'Dell laptop', 'Dell laptop muct change it', 'images/WeiminNew.jpg', '800', '10', 1, 'Laptop'),
(16, 'FIFA10', 'FIFA IS GOOD', 'images/FIFA10.jpg', '50', '10', 1, 'Games'),
(17, 'FIFA10', 'FIFA IS GOOD', 'images/FIFA11.jpg', '50', '10', 1, 'Games'),
(18, 'FIFA10', 'FIFA IS GOOD', 'images/FIFA10.jpg', '50', '10', 1, 'Games'),
(19, 'FIFA10', 'FIFA IS GOOD', 'images/FIFA11.jpg', '50', '10', 1, 'Games'),
(20, 'Java Server Programming', 'Professional Java Server Programming J2EE 1.3 Edition a!', 'images/Java books.jpg', '100', '10', 1, 'Books'),
(21, 'BookC', 'wwwww', 'images/BookC.jpg', '500', '20', 1, 'Books');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` char(2) NOT NULL,
  `Zip` char(10) NOT NULL,
  `Country` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`UserID`, `FirstName`, `LastName`, `email`, `Password`, `Address`, `City`, `State`, `Zip`, `Country`) VALUES
(1, 'Yu', 'Weimin', 'yuweimin496@gmail.co', '81dc9bdb52d04dc20036dbd8313ed055', 'ddddddddd, appt 21appt 21', 'Montreal', 'QC', 'H7K2P4', 'Canada'),
(2, 'John', 'Wolloe', 'johnwolloe@gmail.com', '202cb962ac59075b964b07152d234b70', 'ddddddddd, appt 21, appt 21appt 21', 'Montreal', 'QC', 'H7K2P4', 'Canada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `fk_tblItem_tblUser` (`UserID`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `fk_tblOrder_tblItem` (`ItemID`),
  ADD KEY `fk_tblOrder_tblProduct` (`ProID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ProID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblitem`
--
ALTER TABLE `tblitem`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ProID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD CONSTRAINT `fk_tblItem_tblUser` FOREIGN KEY (`UserID`) REFERENCES `tbluser` (`UserID`);

--
-- Constraints for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `fk_tblOrder_tblItem` FOREIGN KEY (`ItemID`) REFERENCES `tblitem` (`ItemID`),
  ADD CONSTRAINT `fk_tblOrder_tblProduct` FOREIGN KEY (`ProID`) REFERENCES `tblproduct` (`ProID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
