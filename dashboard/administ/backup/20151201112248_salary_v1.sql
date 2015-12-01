--
-- MySQL database dump
-- Created by DbManage class, Power By yanue. 
-- My 662 Database Project 
--
-- Host: mysql1.cs.clemson.edu
-- generated date: 12 / 01 / 2015 /  11:22
-- MySQL Version: 5.5.41-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.21

--
-- database: `My662Project`
--

-- -------------------------------------------------------

--
-- structuresalary
--

DROP TABLE IF EXISTS `salary`;
CREATE TABLE `salary` (
  `salaryid` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(4) NOT NULL,
  `worktime` datetime NOT NULL,
  `evaluation` varchar(20) NOT NULL,
  `salary` float NOT NULL,
  `userid` char(9) NOT NULL,
  PRIMARY KEY (`salaryid`),
  KEY `userid` (`userid`),
  CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_info` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- resave the result of table salary
--

