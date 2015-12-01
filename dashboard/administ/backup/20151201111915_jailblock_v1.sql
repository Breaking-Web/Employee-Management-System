--
-- MySQL database dump
-- Created by DbManage class, Power By yanue. 
-- My 662 Database Project 
--
-- Host: mysql1.cs.clemson.edu
-- generated date: 12 / 01 / 2015 /  11:19
-- MySQL Version: 5.5.41-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.21

--
-- database: `My662Project`
--

-- -------------------------------------------------------

--
-- structurejailblock
--

DROP TABLE IF EXISTS `jailblock`;
CREATE TABLE `jailblock` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `jname` varchar(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`jid`),
  KEY `groupid` (`groupid`),
  KEY `groupid_2` (`groupid`),
  CONSTRAINT `jailblock_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group_info` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- resave the result of table jailblock
--

