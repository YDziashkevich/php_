/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.5.37-log : Database - forum_st
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`forum_st` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `forum_st`;

/*Table structure for table `st_messages` */

DROP TABLE IF EXISTS `st_messages`;

CREATE TABLE `st_messages` (
  `messagesId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `topicId` int(10) unsigned NOT NULL,
  `themeId` int(10) unsigned NOT NULL,
  `messageDate` datetime NOT NULL,
  `messageAuthor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`messagesId`),
  KEY `topicMessage` (`topicId`),
  KEY `themeMessage` (`themeId`),
  KEY `authorMessage` (`messageAuthor`),
  CONSTRAINT `authorMessage` FOREIGN KEY (`messageAuthor`) REFERENCES `st_users` (`userId`),
  CONSTRAINT `themeMessage` FOREIGN KEY (`themeId`) REFERENCES `st_themes` (`themeId`),
  CONSTRAINT `topicMessage` FOREIGN KEY (`topicId`) REFERENCES `st_topic` (`topicId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_messages` */

/*Table structure for table `st_themes` */

DROP TABLE IF EXISTS `st_themes`;

CREATE TABLE `st_themes` (
  `themeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themeAuthor` int(10) unsigned NOT NULL,
  `themeTitle` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `themeDate` datetime NOT NULL,
  PRIMARY KEY (`themeId`),
  KEY `authorTheme` (`themeAuthor`),
  CONSTRAINT `authorTheme` FOREIGN KEY (`themeAuthor`) REFERENCES `st_users` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_themes` */

/*Table structure for table `st_topic` */

DROP TABLE IF EXISTS `st_topic`;

CREATE TABLE `st_topic` (
  `topicId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themeId` int(10) unsigned NOT NULL,
  `topicAuthor` int(10) unsigned NOT NULL,
  `topicStatus` enum('open') NOT NULL,
  `topicName` varchar(100) NOT NULL,
  `topicDate` datetime NOT NULL,
  PRIMARY KEY (`topicId`),
  KEY `themeTopic` (`themeId`),
  KEY `authorTopic` (`topicAuthor`),
  CONSTRAINT `authorTopic` FOREIGN KEY (`topicAuthor`) REFERENCES `st_users` (`userId`),
  CONSTRAINT `themeTopic` FOREIGN KEY (`themeId`) REFERENCES `st_themes` (`themeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_topic` */

/*Table structure for table `st_users` */

DROP TABLE IF EXISTS `st_users`;

CREATE TABLE `st_users` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `status` enum('admin','user') NOT NULL,
  `userDate` datetime NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
