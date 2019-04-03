-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2019 at 04:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipd16`
--
CREATE DATABASE IF NOT EXISTS `ipd16` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ipd16`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `editor` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `editor`, `description`) VALUES
(2, 'The Lord of the Rings', 'J. R. R. Tolkien', 1954, 'Allen & Unwin', 'Good and evil wage all out war over a piece of jewelry.'),
(3, 'Bad', 'Wzl', 2017, 'Dr', 'ladgk');

-- --------------------------------------------------------

--
-- Table structure for table `mad_lib`
--

CREATE TABLE `mad_lib` (
  `ID` int(11) NOT NULL,
  `person_1` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `noun_1` varchar(30) NOT NULL,
  `food` varchar(30) NOT NULL,
  `plural_noun` varchar(30) NOT NULL,
  `holiday` varchar(30) NOT NULL,
  `noun_2` varchar(30) NOT NULL,
  `number` int(3) NOT NULL,
  `person_2` varchar(30) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `time_made` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mad_lib`
--

INSERT INTO `mad_lib` (`ID`, `person_1`, `color`, `noun_1`, `food`, `plural_noun`, `holiday`, `noun_2`, `number`, `person_2`, `occupation`, `time_made`) VALUES
(1, 'Wzl', 'red', 'Cat', 'Cake', 'socks', 'Valentine\'s Day', 'truck', 23, 'Bob', 'Butcher', '2019-03-19 14:52:08'),
(2, 'John', 'blue', 'Dog', 'Pie', 'gloves', 'Valentine\'s Day', 'boat', 12, 'Bily', 'Prayer', '2019-03-19 14:55:29'),
(3, 'Smith', 'purple', 'Plane', 'Milk', 'balls', 'Valentine\'s Day', 'Salmon', 23, 'Mary', 'Designer', '2019-03-19 15:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `todo_items`
--

CREATE TABLE `todo_items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `completed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 or 1 to identify if a task has been completed',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'timestamp of when the task was created',
  `ip_address` varchar(15) NOT NULL COMMENT 'IP address of whoever created the task'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo_items`
--

INSERT INTO `todo_items` (`id`, `name`, `description`, `completed`, `date_added`, `ip_address`) VALUES
(1, 'Go to sleep early', 'Big day tomorrow, need to catch some ZZZs', 1, '2019-03-25 11:03:04', '18.203.27.43'),
(2, 'Pick up groceries', 'Missing ingredients for breakfast', 0, '2019-03-25 10:57:29', '18.203.27.43'),
(3, 'Go to school', 'Show up on time cause of the exam today', 1, '2019-03-26 13:37:13', '41.44.205.171'),
(5, 'test2', 'haha', 0, '2019-03-28 16:13:10', ''),
(7, 'test3', 'sldkjaf', 0, '2019-03-28 17:19:07', ''),
(10, 'tes6 ', '6 ip', 0, '2019-03-28 17:24:56', '::1'),
(11, 'tes6 8', 'lasdkfj', 0, '2019-03-28 17:35:56', '::1'),
(12, 'test 9', 'lsdkjf', 1, '2019-03-28 17:36:14', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `todo_users`
--

CREATE TABLE `todo_users` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo_users`
--

INSERT INTO `todo_users` (`id`, `username`, `display_name`, `password`, `email`) VALUES
(1, 'liz', 'Queen Elizabath', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(2, 'charles', 'Prince Charles', '81dc9bdb52d04dc20036dbd8313ed055', 'charles@futureking.com'),
(3, 'price', 'Carey Price', '202cb962ac59075b964b07152d234b70', 'price@habs.ca'),
(4, 'stu', 'Stewart Little', '202cb962ac59075b964b07152d234b70', NULL),
(5, 'will', 'Prince William', '81dc9bdb52d04dc20036dbd8313ed055', 'will@futureking.com'),
(6, 'albert', 'Albert Einstein', '202cb962ac59075b964b07152d234b70', 'e@mc.2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(5) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `last_login`) VALUES
(1, 'wzl', 'admin', '7363a0d0604902af7b70b271a0b96480', 'admin', '2019-03-27 16:51:49'),
(2, 'John', 'johnmail', '7363a0d0604902af7b70b271a0b96480', '', '2019-03-27 16:51:51'),
(3, 'Peter', 'pmail', '30cd2f99101cdd52cc5fda1e996ee137', '', '2019-03-27 16:51:37'),
(4, 'Smith', 'smail', '7363a0d0604902af7b70b271a0b96480', '', '2019-03-27 16:48:14'),
(5, 'Karl', 'kmail', '1cc39ffd758234422e1f75beadfc5fb2', '', '2019-03-27 16:51:47'),
(6, 'Steph', 'smail', 'd9b1d7db4cd6e70935368a1efb10e377', '', '2019-03-27 17:00:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mad_lib`
--
ALTER TABLE `mad_lib`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `todo_items`
--
ALTER TABLE `todo_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo_users`
--
ALTER TABLE `todo_users`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mad_lib`
--
ALTER TABLE `mad_lib`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `todo_items`
--
ALTER TABLE `todo_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `todo_users`
--
ALTER TABLE `todo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
