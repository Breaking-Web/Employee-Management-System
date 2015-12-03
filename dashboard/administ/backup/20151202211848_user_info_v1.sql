--
-- MySQL database dump
-- Created by DbManage class, Power By yanue. 
-- My 662 Database Project 
--
-- Host: mysql1.cs.clemson.edu
-- generated date: 12 / 02 / 2015 /  21:18
-- MySQL Version: 5.5.41-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.21

--
-- database: `My662Project`
--

-- -------------------------------------------------------

--
-- structureuser_info
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `userid` char(9) NOT NULL COMMENT '9 bits user id',
  `username` varchar(50) NOT NULL DEFAULT 'noname' COMMENT 'user name(at most 50 chars) unique',
  `userpwd` varchar(20) NOT NULL DEFAULT '123456' COMMENT 'user password (at most 20 chars)',
  `name` varchar(100) DEFAULT NULL COMMENT 'This is man''s true name',
  `phone` varchar(15) DEFAULT NULL COMMENT 'phone number at most 15 char can be none',
  `email` varchar(50) NOT NULL DEFAULT 'hh@g.clemson.edu' COMMENT 'user email at most 50 chars',
  `address` varchar(100) NOT NULL DEFAULT 'Old Central Rd,Apt #4' COMMENT 'user address at most 100 chars unique',
  `position` enum('staff','leader','warden','admin') NOT NULL DEFAULT 'staff',
  `typeid` int(11) NOT NULL DEFAULT '2',
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `typeid` (`typeid`),
  KEY `group` (`groupid`),
  CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `usertype` (`typeid`),
  CONSTRAINT `user_info_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `group_info` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- resave the result of table user_info
--

REPLACE INTO `user_info` VALUES('C00000000','admin','Admin','yuqi','8649576456','yuqi2@g.clemson.edu','Old Central Rd,Apt #4','admin','1','0');
REPLACE INTO `user_info` VALUES('C00000001','Northon','aA','','8646243344','Northon@g.clemson.edu','Clemson Jail','warden','2','0');
REPLACE INTO `user_info` VALUES('C00000002','dyz','aA','','1234567890','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000003','Sheldon','aA','','8645597684','Sheldon@g.clemson.edu','Old Central Rd,Apt #4','leader','3','1');
REPLACE INTO `user_info` VALUES('C00000004','Handsome_Guy','aA','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000005','Handsome_Boy','aA','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000006','jingyaoma','aA','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000007','Pretty_Boy','aA','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000008','Nauty_Girl','aA','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000009','eHarmony','aA','','8646243344','sdfsd@g.clemson.edu','Campus Dr sdga  lksadjfklsajfg ','staff','4','0');
REPLACE INTO `user_info` VALUES('C00000010','Soldier','aA','','8649975846','soldier@g.clemson.edu','every where in star war','staff','4','1');
REPLACE INTO `user_info` VALUES('C00000011','Amy','aA','','8456321542','Amy@clemson.edu','Old Central Rd,Apt #4','leader','3','2');
REPLACE INTO `user_info` VALUES('C00000012','C00000012','123456','noname','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000013','C00000013','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000014','C00000014','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000015','C00000015','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000016','C00000016','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000017','C00000017','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000018','C00000018','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000019','C00000019','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000020','C00000020','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','2');
REPLACE INTO `user_info` VALUES('C00000021','Leonard','aA','','8646243344','Leonard@g.clemson.edu','Old Central Rd,Apt #4','leader','3','3');
REPLACE INTO `user_info` VALUES('C00000022','test22','aA','','8646243344','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000023','C00000023','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000024','C00000024','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000025','C00000025','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000026','C00000026','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000027','C00000027','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000028','C00000028','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000029','C00000029','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000030','C00000030','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','3');
REPLACE INTO `user_info` VALUES('C00000031','C00000031','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000032','C00000032','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000033','C00000033','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000034','C00000034','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000035','Penny','aA','','8641234567','hh@g.clemson.edu','Old Central Rd,Apt #4','leader','3','4');
REPLACE INTO `user_info` VALUES('C00000036','C00000036','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000037','C00000037','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000038','C00000038','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000039','C00000039','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000040','C00000040','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','4');
REPLACE INTO `user_info` VALUES('C00000041','Howard','aA','','8643154135','HowardW@clemson.edu','Old Central Rd,Apt #4','leader','3','5');
REPLACE INTO `user_info` VALUES('C00000042','C00000042','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000043','C00000043','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000044','C00000044','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000045','C00000045','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000046','C00000046','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000047','C00000047','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000048','C00000048','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000049','C00000049','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00000050','C00000050','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00001002','Chewbacca ','aA','','8647598465','chewbacca@g.clemson.edu','Chewbacca Rd, 2014','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001003','R2 D2','aA','','8643529999','r2-d2@g.clemson.edu','Central Rd,Nabau','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001004','Amidala','aA','','8643338645','amidala@g.clemson.edu','Apailana Queen','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001005','Anakin','aA','','8649753584','anakin@g.clemson.edu','Old Central Rd,Apt #4','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001006','Dooku','aA','','8643292777','dooku@g.clemson.edu','123A Count Rd, Serenno','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001007','Darth','aA','','8646243344','darth@g.clemson.edu','kindom 59D, clemson , SC','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001008','Yoda','aA','','8643328579','yoda@g.clemson.edu','campus Dr. 215 C, central ','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001009','Vida','aA','','1234567890','vida@g.clemson.edu','deadstar rd 123D central SC','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001010','Raj','aA','','4524591567','RajK@g.clemson.edu','Old Central Rd,Apt #4','leader','3','7');
REPLACE INTO `user_info` VALUES('C00001011','Stuart','123456A','','8649586635','Stuart@g.clemson.edu','Clemson central 14','leader','3','6');
REPLACE INTO `user_info` VALUES('C00001013','testman','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','7');
REPLACE INTO `user_info` VALUES('C00001014','testman','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','7');
REPLACE INTO `user_info` VALUES('C00001015','testman','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','7');
REPLACE INTO `user_info` VALUES('C00001016','testman','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','7');
REPLACE INTO `user_info` VALUES('C00001017','MR.Right','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','7');
REPLACE INTO `user_info` VALUES('C00001018','luke','aA','','8645552139','luke@g.clemson.edu','clemson dead star','staff','4','1');
REPLACE INTO `user_info` VALUES('C00001019','LouJie','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
REPLACE INTO `user_info` VALUES('C00001020','LouJie2','123456','','','hh@g.clemson.edu','Old Central Rd,Apt #4','staff','4','5');
