# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.21)
# Database: mad
# Generation Time: 2019-03-09 09:05:11 +0000
# ************************************************************


# Dump of table mad_lib
# ------------------------------------------------------------

CREATE TABLE `mad_lib` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
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
  `time_made` timestamp NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


