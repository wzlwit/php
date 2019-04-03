-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-03-24 14:42:25
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `ipd16`
--

-- --------------------------------------------------------

--
-- 表的结构 `account`
--

CREATE TABLE `account` (
  `id` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type` varchar(8) NOT NULL,
  `regtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogintime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store info of accounts';

--
-- 转存表中的数据 `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `type`, `regtime`, `lastlogintime`) VALUES
(2, 'yangyang', '1234567', 'yangyang@gmail.com', 'admin', '0000-00-00 00:00:00', NULL),
(3, 'jailing', '1234567', 'jialing@gmail.com', 'admin', '0000-00-00 00:00:00', NULL),
(4, 'jialing', '1234567', 'jialing1@gmail.com', 'freeuser', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `channel`
--

CREATE TABLE `channel` (
  `ch_id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `location` varchar(30) NOT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `channel`
--

INSERT INTO `channel` (`ch_id`, `name`, `url`, `location`, `icon`, `category`) VALUES
(1, 'xinhua', './images/xinhua', 'china', 'xinhua', NULL),
(2, 'abc', './test', 'usa', 'ABCus', NULL),
(3, 'yay', 'def', 'american', 'ansa', NULL),
(4, 'daf', 'fadf', 'china', 'time', 'daffa');

-- --------------------------------------------------------

--
-- 表的结构 `history`
--

CREATE TABLE `history` (
  `id` int(4) NOT NULL,
  `ch_id` int(4) NOT NULL,
  `createtime` datetime NOT NULL,
  `closetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To store history info';

-- --------------------------------------------------------

--
-- 表的结构 `subscript`
--

CREATE TABLE `subscript` (
  `id` int(4) NOT NULL,
  `ch_id` int(4) NOT NULL,
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To store subscript info';

--
-- 转储表的索引
--

--
-- 表的索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`ch_id`);

--
-- 表的索引 `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`,`ch_id`,`createtime`);

--
-- 表的索引 `subscript`
--
ALTER TABLE `subscript`
  ADD PRIMARY KEY (`id`,`ch_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `channel`
--
ALTER TABLE `channel`
  MODIFY `ch_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
