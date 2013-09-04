-- MySQL dump 10.13  Distrib 5.6.13, for osx10.7 (x86_64)
--
-- Host: localhost    Database: twii_db
-- ------------------------------------------------------
-- Server version	5.6.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `twii_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `twii_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `twii_db`;

--
-- Table structure for table `twii_follower`
--

DROP TABLE IF EXISTS `twii_follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `twii_follower` (
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`follower_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twii_follower`
--

LOCK TABLES `twii_follower` WRITE;
/*!40000 ALTER TABLE `twii_follower` DISABLE KEYS */;
INSERT INTO `twii_follower` VALUES (1,2),(1,3),(1,4),(1,5),(2,3),(2,4),(2,5);
/*!40000 ALTER TABLE `twii_follower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `twii_post`
--

DROP TABLE IF EXISTS `twii_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `twii_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `body` varchar(140) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twii_post`
--

LOCK TABLES `twii_post` WRITE;
/*!40000 ALTER TABLE `twii_post` DISABLE KEYS */;
INSERT INTO `twii_post` VALUES (1,1,'this is a sample post','2013-09-03 22:54:48'),(2,1,'yet another tweet','2013-09-03 23:45:17'),(3,1,'it is a beautiful day','2013-09-03 23:45:31'),(4,2,'Saw rainbow today','2013-09-03 23:45:47'),(5,3,'tiring trip to berkley adn return back. Took 3 hours','2013-09-03 23:46:15'),(6,3,'Fedrer loses USOPEN chance','2013-09-03 23:46:40'),(7,4,'Fedrer loses USOPEN chance','2013-09-03 23:46:46'),(8,5,'Fedrer loses USOPEN chance','2013-09-03 23:46:51'),(9,5,'Awesome weather in seattle today','2013-09-03 23:47:05'),(10,2,'Looking forward to thursday night football','2013-09-03 23:47:30');
/*!40000 ALTER TABLE `twii_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `twii_user`
--

DROP TABLE IF EXISTS `twii_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `twii_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `twii_user`
--

LOCK TABLES `twii_user` WRITE;
/*!40000 ALTER TABLE `twii_user` DISABLE KEYS */;
INSERT INTO `twii_user` VALUES (1,'user1','user1@twii.com','password'),(2,'user2','user2@twii.com','password'),(3,'user3','user3@twii.com','password'),(4,'user4','user4@twii.com','password'),(5,'user5','user5@twii.com','password');
/*!40000 ALTER TABLE `twii_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-04  0:09:23
