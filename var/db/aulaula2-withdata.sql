-- MySQL dump 10.13  Distrib 5.5.22, for Linux (x86_64)
--
-- Host: localhost    Database: aulaula
-- ------------------------------------------------------
-- Server version	5.5.22

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
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `banner_area_id` int(11) unsigned NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `label` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` enum('image url','image file','swf file','swf object','javascript code') CHARACTER SET utf8 NOT NULL DEFAULT 'image file',
  `mime_type` varchar(200) CHARACTER SET utf8 NOT NULL,
  `size` int(11) NOT NULL,
  `extension` varchar(10) CHARACTER SET utf8 NOT NULL,
  `source` mediumtext CHARACTER SET utf8 NOT NULL,
  `target` varchar(255) DEFAULT NULL,
  `context` text CHARACTER SET utf8 NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `author_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) NOT NULL,
  `locked_time` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_time` datetime NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_from` datetime NOT NULL,
  `publish_to` datetime DEFAULT NULL,
  `comments` text CHARACTER SET utf8 NOT NULL,
  `options` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `published` (`published`,`approved`),
  KEY `banner_area_id` (`banner_area_id`),
  KEY `banner_area_id_2` (`banner_area_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (1,18,'111bbbbb','11hhhhh','javascript code','',0,'','',NULL,'alert(&#39;hi&#39;)','Yes','Yes',3532,0,'0000-00-00 00:00:00',3532,'2012-05-03 06:48:07','2012-05-03 03:23:57','2012-05-10 00:00:00','2012-05-17 00:00:00','cccc','\"vvv\"'),(2,17,'Title 2','Label 2','image file','',0,'','',NULL,'','Yes','Yes',3532,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-03 03:26:42','0000-00-00 00:00:00','0000-00-00 00:00:00','','\"\"');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner_area`
--

DROP TABLE IF EXISTS `banner_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `label` varchar(255) CHARACTER SET utf8 NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `author_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) NOT NULL,
  `locked_time` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_time` datetime NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_from` datetime NOT NULL,
  `publish_to` datetime DEFAULT NULL,
  `comments` text CHARACTER SET utf8 NOT NULL,
  `options` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_area`
--

LOCK TABLES `banner_area` WRITE;
/*!40000 ALTER TABLE `banner_area` DISABLE KEYS */;
INSERT INTO `banner_area` VALUES (16,'Title','Label','Yes','Yes',3532,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 22:15:45','2012-05-10 00:00:00','2012-05-15 00:00:00','comments','\"options\"'),(17,'Title2','Label2','No','Yes',3532,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 22:18:33','2012-05-05 00:00:00','2012-05-12 00:00:00','111111','\"222222\"'),(18,'Title333','Label333','No','No',3532,0,'0000-00-00 00:00:00',3532,'2012-05-03 06:19:18','2012-05-02 22:19:48','2009-11-24 00:00:00','2011-11-26 00:00:00','222222','\"333333\"'),(19,'XXXXXXXXX','XXXXXXXXX','Yes','Yes',3532,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-04 15:16:50','0000-00-00 00:00:00','0000-00-00 00:00:00','','\"\"'),(20,'XXXXXX','XXXXXX','Yes','Yes',3532,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-04 15:17:08','0000-00-00 00:00:00','0000-00-00 00:00:00','','\"\"');
/*!40000 ALTER TABLE `banner_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_type_id` int(11) unsigned NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `show_in_menu` enum('Yes','No') NOT NULL DEFAULT 'No',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `parent_id` (`parent_id`),
  KEY `package_id` (`package_id`),
  KEY `published` (`published`,`approved`),
  KEY `show_in_menu` (`show_in_menu`,`published`,`approved`),
  KEY `category_type_id` (`category_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (28,'title','label','description',2,3532,0,0,'Yes','Yes','Yes',15,'2012-04-26 05:04:04'),(29,'title2','label2','description2',3,3532,0,0,'Yes','No','Yes',13,'2012-04-26 05:14:31'),(30,'111222','3223','444444',3,3532,0,0,'No','Yes','No',9,'2012-04-26 05:27:28'),(31,'4444','333','2222',2,3532,0,0,'No','Yes','No',12,'2012-04-26 05:28:50'),(32,'assadsad','asdasd','sdfsdf',2,3532,31,0,'Yes','No','No',6,'2012-04-26 18:45:08'),(33,'asdasd','asdasd','asdasd',2,3532,28,0,'No','No','No',7,'2012-04-28 12:36:44'),(34,'@#$\\','@#$@#$','@#$@#$',0,3532,0,0,'Yes','No','No',1,'2012-04-28 12:39:24');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_info`
--

DROP TABLE IF EXISTS `category_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `subcat_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `direct_object_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `indirect_object_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `page_title` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_key` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_data` text NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_info`
--

LOCK TABLES `category_info` WRITE;
/*!40000 ALTER TABLE `category_info` DISABLE KEYS */;
INSERT INTO `category_info` VALUES (28,28,0,0,0,'page title','meta title','meta keywords','meta description','meta data',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-27 00:00:00','2012-04-30 00:00:00','2012-04-26 05:04:04','','\"options\"'),(29,29,0,0,0,'lololo','dddd','fffff','gggggg','',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-04 00:00:00','2012-04-18 00:00:00','2012-04-26 05:14:31','comments','\"options:1; option2:2\"'),(30,30,0,0,0,'','','','','',0,'0000-00-00 00:00:00',3532,'2012-04-26 15:08:11','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-04-26 05:27:28','','\"\"'),(31,31,0,0,0,'11','22','33','44','55',0,'0000-00-00 00:00:00',3532,'2012-04-26 15:12:54','2000-11-01 00:00:00','2000-11-05 00:00:00','2012-04-26 05:28:50','comments','\"options\"'),(32,32,0,0,0,'','','','','',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-26 18:45:08','','\"\"'),(33,33,0,0,0,'','','','','',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-28 12:36:44','','\"\"'),(34,34,0,0,0,'','','','','',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-28 12:39:24','','\"\"');
/*!40000 ALTER TABLE `category_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_type`
--

DROP TABLE IF EXISTS `category_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `show_in_menu` enum('Yes','No') NOT NULL DEFAULT 'No',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `package_id` (`package_id`),
  KEY `published` (`published`,`approved`),
  KEY `show_in_menu` (`show_in_menu`,`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_type`
--

LOCK TABLES `category_type` WRITE;
/*!40000 ALTER TABLE `category_type` DISABLE KEYS */;
INSERT INTO `category_type` VALUES (2,'category_type_title2','llllabel','ddddescription',3532,0,'No','No','No',2,'2012-04-26 01:52:41'),(3,'category_type_title3','label2','description2',3532,0,'Yes','No','Yes',5,'2012-04-26 01:54:22');
/*!40000 ALTER TABLE `category_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_type_info`
--

DROP TABLE IF EXISTS `category_type_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_type_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_type_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `direct_cat_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `indirect_cat_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `category_type_id` (`category_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_type_info`
--

LOCK TABLES `category_type_info` WRITE;
/*!40000 ALTER TABLE `category_type_info` DISABLE KEYS */;
INSERT INTO `category_type_info` VALUES (2,2,0,'0000-00-00 00:00:00',3532,'2012-04-26 05:32:39',0,0,'2012-04-26 01:52:41','cemmmmmments','\"optttttions\"'),(3,3,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'2012-04-26 01:54:22','comments2','\"options2\"');
/*!40000 ALTER TABLE `category_type_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_air_condition`
--

DROP TABLE IF EXISTS `estate_air_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_air_condition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_air_condition`
--

LOCK TABLES `estate_air_condition` WRITE;
/*!40000 ALTER TABLE `estate_air_condition` DISABLE KEYS */;
INSERT INTO `estate_air_condition` VALUES (3,'2En AirCondition title','2En AirCondition description',1,'cf1c46bce374dde03a850ef1025fd70a','2012-05-25 13:43:35','2en com','\"2en op\"'),(4,'1Ar AirCondition title','1Ar AirCondition description',2,'cf1c46bce374dde03a850ef1025fd70a','2012-05-25 13:43:35','1ar com','\"1ar op\"');
/*!40000 ALTER TABLE `estate_air_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_livenear_1`
--

DROP TABLE IF EXISTS `estate_livenear_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_livenear_1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_livenear_1`
--

LOCK TABLES `estate_livenear_1` WRITE;
/*!40000 ALTER TABLE `estate_livenear_1` DISABLE KEYS */;
INSERT INTO `estate_livenear_1` VALUES (1,'en Livenear1 title','en Livenear1 desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 14:00:52','en com','\"em opp\"'),(2,'1ar Livenear1 title','1ar Livenear1 description',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 14:00:52','1ar com','\"1ar opp\"');
/*!40000 ALTER TABLE `estate_livenear_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_livenear_2`
--

DROP TABLE IF EXISTS `estate_livenear_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_livenear_2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_livenear_2`
--

LOCK TABLES `estate_livenear_2` WRITE;
/*!40000 ALTER TABLE `estate_livenear_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `estate_livenear_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_livenear_3`
--

DROP TABLE IF EXISTS `estate_livenear_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_livenear_3` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_livenear_3`
--

LOCK TABLES `estate_livenear_3` WRITE;
/*!40000 ALTER TABLE `estate_livenear_3` DISABLE KEYS */;
/*!40000 ALTER TABLE `estate_livenear_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_livenear_4`
--

DROP TABLE IF EXISTS `estate_livenear_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_livenear_4` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_livenear_4`
--

LOCK TABLES `estate_livenear_4` WRITE;
/*!40000 ALTER TABLE `estate_livenear_4` DISABLE KEYS */;
/*!40000 ALTER TABLE `estate_livenear_4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_location`
--

DROP TABLE IF EXISTS `estate_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_location`
--

LOCK TABLES `estate_location` WRITE;
/*!40000 ALTER TABLE `estate_location` DISABLE KEYS */;
INSERT INTO `estate_location` VALUES (1,'11mmmmmm','111oooooooo',2,'','2012-05-09 07:12:58','','\"\"'),(2,'dddd','ddd',1,'','2012-05-09 07:13:49','','\"\"'),(3,'www','www',2,'','2012-05-09 07:15:31','','\"\"'),(4,'ee','rr',1,'','2012-05-09 07:28:56','','\"\"'),(5,'ee','r',2,'','2012-05-09 07:29:32','','\"\"'),(8,'dddd','vvvvv',1,'','2012-05-15 00:04:47','','\"\"');
/*!40000 ALTER TABLE `estate_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_outdoor_amenities`
--

DROP TABLE IF EXISTS `estate_outdoor_amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_outdoor_amenities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_outdoor_amenities`
--

LOCK TABLES `estate_outdoor_amenities` WRITE;
/*!40000 ALTER TABLE `estate_outdoor_amenities` DISABLE KEYS */;
/*!40000 ALTER TABLE `estate_outdoor_amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_provence`
--

DROP TABLE IF EXISTS `estate_provence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_provence` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `estate_location_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `estate_location_id` (`estate_location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_provence`
--

LOCK TABLES `estate_provence` WRITE;
/*!40000 ALTER TABLE `estate_provence` DISABLE KEYS */;
INSERT INTO `estate_provence` VALUES (4,8,'221en Provence title','221en Provence desc',1,'9e250d966ea45cd1f177a62e3fc885f7','2012-05-25 17:20:05','22en comm','\"22en opp\"'),(5,1,'11ar Provence title','11ar Provence desc',2,'9e250d966ea45cd1f177a62e3fc885f7','2012-05-25 17:20:05','11ar comm','\"11ar opp\"');
/*!40000 ALTER TABLE `estate_provence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_type`
--

DROP TABLE IF EXISTS `estate_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_type`
--

LOCK TABLES `estate_type` WRITE;
/*!40000 ALTER TABLE `estate_type` DISABLE KEYS */;
INSERT INTO `estate_type` VALUES (10,'en type title','en type desc',1,'2ad75808026fefde03cf0ae516852eda','2012-05-25 19:37:32','en com','\"en op\"'),(11,'1ar type title','1ar type desc',2,'2ad75808026fefde03cf0ae516852eda','2012-05-25 19:37:33','1ar comm','\"1ar opp\"');
/*!40000 ALTER TABLE `estate_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_ancillary_buildings`
--

DROP TABLE IF EXISTS `landlots_ancillary_buildings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_ancillary_buildings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_ancillary_buildings`
--

LOCK TABLES `landlots_ancillary_buildings` WRITE;
/*!40000 ALTER TABLE `landlots_ancillary_buildings` DISABLE KEYS */;
/*!40000 ALTER TABLE `landlots_ancillary_buildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_for`
--

DROP TABLE IF EXISTS `landlots_for`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_for` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_for`
--

LOCK TABLES `landlots_for` WRITE;
/*!40000 ALTER TABLE `landlots_for` DISABLE KEYS */;
/*!40000 ALTER TABLE `landlots_for` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_livenear_1`
--

DROP TABLE IF EXISTS `landlots_livenear_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_livenear_1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_livenear_1`
--

LOCK TABLES `landlots_livenear_1` WRITE;
/*!40000 ALTER TABLE `landlots_livenear_1` DISABLE KEYS */;
INSERT INTO `landlots_livenear_1` VALUES (2,'wwww','ddddd',1,'','2012-05-14 23:52:19','aaaa','eeeee');
/*!40000 ALTER TABLE `landlots_livenear_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_livenear_2`
--

DROP TABLE IF EXISTS `landlots_livenear_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_livenear_2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_livenear_2`
--

LOCK TABLES `landlots_livenear_2` WRITE;
/*!40000 ALTER TABLE `landlots_livenear_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `landlots_livenear_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_livenear_3`
--

DROP TABLE IF EXISTS `landlots_livenear_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_livenear_3` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_livenear_3`
--

LOCK TABLES `landlots_livenear_3` WRITE;
/*!40000 ALTER TABLE `landlots_livenear_3` DISABLE KEYS */;
/*!40000 ALTER TABLE `landlots_livenear_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_livenear_4`
--

DROP TABLE IF EXISTS `landlots_livenear_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_livenear_4` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_livenear_4`
--

LOCK TABLES `landlots_livenear_4` WRITE;
/*!40000 ALTER TABLE `landlots_livenear_4` DISABLE KEYS */;
/*!40000 ALTER TABLE `landlots_livenear_4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_location`
--

DROP TABLE IF EXISTS `landlots_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_location`
--

LOCK TABLES `landlots_location` WRITE;
/*!40000 ALTER TABLE `landlots_location` DISABLE KEYS */;
INSERT INTO `landlots_location` VALUES (1,'en Location title','en Location desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 18:39:27','en comm','\"en opp\"'),(2,'1ar Location title','1ar Location desc',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 18:39:27','','\"\"');
/*!40000 ALTER TABLE `landlots_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_provence`
--

DROP TABLE IF EXISTS `landlots_provence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_provence` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `landlots_location_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `landlots_location_id` (`landlots_location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_provence`
--

LOCK TABLES `landlots_provence` WRITE;
/*!40000 ALTER TABLE `landlots_provence` DISABLE KEYS */;
INSERT INTO `landlots_provence` VALUES (1,1,'en Provence title','en Provence desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 18:41:38','en comm','\"en opp\"'),(2,2,'ar Provence title','ar Provence desc',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 18:41:38','ar comm','\"ar opp\"');
/*!40000 ALTER TABLE `landlots_provence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landlots_type`
--

DROP TABLE IF EXISTS `landlots_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landlots_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_type`
--

LOCK TABLES `landlots_type` WRITE;
/*!40000 ALTER TABLE `landlots_type` DISABLE KEYS */;
INSERT INTO `landlots_type` VALUES (2,'type 1','desc1',0,'','2012-05-14 17:21:56','comm1','\"\"\"opt1\"\"\"'),(3,'title2','description2',0,'','2012-05-14 17:22:21','comments2','\"\"\"option2\"\"\"'),(4,'title3','description3',0,'','2012-05-14 17:22:38','','\"\"\"\"\"\"'),(5,'titleee 4','descriptionnnn 4',0,'','2012-05-14 17:23:07','commmm4','\"\"\"opttttttt4\"\"\"');
/*!40000 ALTER TABLE `landlots_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locale`
--

DROP TABLE IF EXISTS `locale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `locale_title` varchar(255) DEFAULT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`approved`),
  KEY `published_2` (`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locale`
--

LOCK TABLES `locale` WRITE;
/*!40000 ALTER TABLE `locale` DISABLE KEYS */;
INSERT INTO `locale` VALUES (1,'En','English','English Language','Yes','Yes',1,'2012-05-19 22:20:09','qqqq'),(2,'Ar','Arabic','Arabic Language','Yes','Yes',2,'2012-05-19 22:20:39','wwww'),(3,'Fr','Franci','France Language','No','No',3,'2012-05-21 06:26:42','commmm commmm'),(4,'xxx','yyy','zzz','No','No',4,'2012-05-21 06:32:41','rrrrr');
/*!40000 ALTER TABLE `locale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `link` mediumtext NOT NULL,
  `menu_type_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) unsigned DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `package_id` (`package_id`),
  KEY `published` (`published`,`approved`),
  KEY `menu_type_id` (`menu_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (2,'left-menu-item-2','http://www.anas.al-far.com',1,0,0,0,'No','Yes',25,'2012-02-20 15:37:15'),(3,'left-menu-item-3','http://www.anas.al-far.com',1,0,0,0,'Yes','Yes',31,'2012-02-20 15:37:37'),(4,'top-menu-item-1','http://www.anas.al-far.com',2,0,0,0,'Yes','No',38,'2012-02-20 15:37:57'),(5,'top-menu-item-2','http://www.anas.al-far.com',2,0,0,0,'Yes','Yes',41,'2012-02-20 15:38:06'),(6,'top-menu-item-3','http://www.anas.al-far.com',2,0,0,0,'No','Yes',42,'2012-02-20 15:38:18'),(7,'top-menu-item-4','http://www.anas.al-far.com',2,0,0,0,'Yes','Yes',43,'2012-02-20 15:38:27'),(101,'dassfdsf','http://www.yahoo.cmo/',0,0,0,0,'Yes','Yes',23,'2012-04-24 16:44:21'),(102,'anas','http://www.yahoo.com',2,0,0,2,'No','No',21,'2012-04-24 16:44:42'),(100,'mohammad','http://www.yahoooo.com',1,0,0,99,'Yes','Yes',60,'2012-04-24 03:42:17'),(109,'mohammad2','http://www.mutashabih.clean/admin/handle/pkg/menu/action/add',1,100,0,0,'Yes','Yes',105,'2012-04-25 17:37:40'),(110,'mohammad3','http://www.mutashabih.clean/admin/handle/pkg/menu/action/add',2,102,0,0,'Yes','Yes',59,'2012-04-25 17:39:34'),(111,'234324','3434234',1,3,0,0,'No','No',4,'2012-04-28 12:29:10'),(112,'asdasd','asdsad@adsad.com',0,0,0,0,'No','No',3,'2012-04-28 12:36:07');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_info`
--

DROP TABLE IF EXISTS `menu_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_info`
--

LOCK TABLES `menu_info` WRITE;
/*!40000 ALTER TABLE `menu_info` DISABLE KEYS */;
INSERT INTO `menu_info` VALUES (2,2,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-02-20 15:37:15','',''),(3,3,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-02-20 15:37:37','',''),(4,4,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-02-20 15:37:57','',''),(5,5,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-02-20 15:38:06','',''),(6,6,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-02-20 15:38:18','',''),(7,7,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-02-20 15:38:27','',''),(32,112,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-28 12:36:07','','\"\"'),(31,111,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-28 12:29:10','','\"\"'),(21,101,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-24 16:44:21',NULL,NULL),(22,102,0,'0000-00-00 00:00:00',3532,'2012-04-24 19:46:55','2012-04-24 00:00:00','2000-11-30 00:00:00','2012-04-24 16:44:42','ccccccccccccc','aaaaaaaaaaaa'),(20,100,0,'0000-00-00 00:00:00',3532,'2012-04-24 06:46:16','2012-05-01 00:00:00','2012-05-30 00:00:00','2012-04-24 03:42:17','Ù…Ù„Ø§Ø­Ø¸Ø§Ø§Ø§Ø§Ø§Øª 2','Ø®ÙŠØ§Ø±Ø§Ø§Ø§Ø§Ø§Ø§Ø§Ø§Ø§Øª 2'),(30,110,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-25 17:39:34','',''),(29,109,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-25 17:37:40','','');
/*!40000 ALTER TABLE `menu_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_type`
--

DROP TABLE IF EXISTS `menu_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_type`
--

LOCK TABLES `menu_type` WRITE;
/*!40000 ALTER TABLE `menu_type` DISABLE KEYS */;
INSERT INTO `menu_type` VALUES (1,'left-menu-title','left-menu-short','left-menu-dec',3540,'Yes','Yes',19,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-02-20 15:36:29','',''),(2,'top-menu-title','top-menu-short','top-menu-desc',3540,'Yes','Yes',19,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-02-20 15:36:50','',''),(5,'11','22','33',3532,'Yes','No',13,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-25 23:54:31','bbbbb','\"ccccc\"'),(4,'loooool title','looooool label','looooooool desc',3532,'No','Yes',15,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-25 23:52:32','rrrrrrrrrrr','\"oooooooooo yyyyyyyy\"'),(6,'444444','555','6666666666',3532,'No','No',35,0,0,'0000-00-00 00:00:00',3532,'2012-04-26 03:32:41','2012-04-25 23:56:27','nooooooooo','\"yeeeeeeeeeees\"'),(7,'aaaaaaaaaaaaa','sssssssssssss','sssssssssssss desc',3532,'Yes','Yes',4,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-26 17:25:42','','\"\"'),(8,'s','sss','ssss',3532,'No','No',3,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-27 16:24:28','','\"\"');
/*!40000 ALTER TABLE `menu_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object`
--

DROP TABLE IF EXISTS `object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `object_source_id` int(11) unsigned NOT NULL,
  `tags` text NOT NULL,
  `page_title` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_key` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_data` text NOT NULL,
  `object_type_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `guid_url` mediumtext NOT NULL,
  `original_author` varchar(255) NOT NULL DEFAULT '',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `show_in_list` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `parent_id` (`parent_id`),
  KEY `category_id` (`category_id`),
  KEY `original_author` (`original_author`),
  KEY `published` (`published`,`approved`),
  KEY `show_in_list` (`show_in_list`,`published`,`approved`),
  KEY `object_source_id` (`object_source_id`),
  KEY `object_type_id` (`object_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object`
--

LOCK TABLES `object` WRITE;
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` VALUES (1,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-04-30 02:39:45'),(2,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-04-30 02:40:59'),(3,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',7,'No','No','No','2012-04-30 02:55:13'),(4,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','No','No','2012-04-30 03:39:27'),(5,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-04-30 03:42:05'),(6,'test 2','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-04-30 03:42:30'),(7,'test3333','2000-11-29 00:00:00',3532,2,'nnnnnnnnn','111','222','333','444','555',2,31,1,'bbbbbbbbbbb','Anas',6,'Yes','Yes','Yes','2012-04-30 03:43:51'),(8,'looooong','2012-04-30 00:00:00',3532,1,'mmmm','123','321','456','654','666',1,28,1,'ddd','fffffffffffff',1,'Yes','Yes','Yes','2012-04-30 05:21:33'),(9,'ttttttttt','2012-04-30 00:00:00',3532,1,'ttttt','123','321','456','654','666',0,28,1,'ggggg','anas',6,'Yes','Yes','Yes','2012-04-30 05:23:45'),(10,'dddddd','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-01 12:18:38'),(11,'dddddd','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-01 12:20:19'),(12,'test','2012-05-31 00:00:00',3532,1,'vvvvvv','','','','','',1,28,1,'','',6,'No','Yes','Yes','2012-05-01 12:50:42'),(13,'test','2012-05-31 00:00:00',3532,1,'vvvvvv','','','','','',1,28,1,'','',6,'No','Yes','Yes','2012-05-01 12:51:52'),(14,'test','2012-05-31 00:00:00',3532,1,'vvvvvv','','','','','',1,28,1,'','',6,'No','Yes','Yes','2012-05-01 12:53:00'),(15,'test111','2012-05-31 00:00:00',3532,1,'vvvvvv','999','888','777','666','000',1,31,1,'5555','6666',5,'Yes','Yes','Yes','2012-05-01 12:53:50'),(16,'Test Object Video','2012-05-31 00:00:00',3532,2,'a,b,c','page title','meta title','meta keyword','mets description','meta data',2,34,1,'GUID','Mohammad',11,'Yes','Yes','Yes','2012-05-01 13:00:02'),(17,'Test Title Video2','2012-06-10 00:00:00',3532,2,'aa,bb,cc,dd','Page Title','Metaaaa Title','Metaaaa Keywords','Metaaaa Description','Metaaaaa Data',2,28,1,'Fvml2rtw4','Mutashabih',1,'Yes','Yes','Yes','2012-05-01 14:30:25'),(18,'Test Title Video2','2012-06-10 00:00:00',3532,2,'aa,bb,cc,dd','Page Title','Metaaaa Title','Metaaaa Keywords','Metaaaa Description','Metaaaaa Data',2,28,1,'Fvml2rtw4','Mutashabih',1,'Yes','Yes','Yes','2012-05-01 14:32:02'),(19,'Test Title Video2','2012-06-10 00:00:00',3532,2,'aa,bb,cc,dd','Page Title','Metaaaa Title','Metaaaa Keywords','Metaaaa Description','Metaaaaa Data',2,28,1,'Fvml2rtw4','Mutashabih',1,'Yes','Yes','Yes','2012-05-01 14:34:11'),(20,'Article Title1','2012-05-24 00:00:00',3532,1,'aa,cc,ee','123','321','456','654','777',1,28,1,'GUID','Mohammad',6,'Yes','Yes','Yes','2012-05-01 20:07:31'),(21,'title 22','2012-05-31 00:00:00',3532,2,'','','','mmmmmm','','',2,30,1,'','Anas',0,'No','No','Yes','2012-05-01 20:16:40'),(22,'URL Title 11','2012-05-03 00:00:00',3532,1,'aa,mmmmm11','aa111','aa222','aa333','aa444','aa555',1,32,1,'GUID11','Mohammad11',1,'Yes','No','No','2012-05-01 22:46:58'),(23,'Static Title 1','2012-05-01 00:00:00',3532,1,'fofo,momo','11','22','33','44','55',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-05-01 23:44:14'),(24,'Static Title 1111','2012-05-06 00:00:00',3532,2,'fofo,momo11','aa11','aa22','aa33','aa44','aa55',2,29,1,'GUID11','Mohammad11',21,'No','No','No','2012-05-01 23:46:40'),(25,'Title Directory','2012-05-01 00:00:00',3532,1,'aaaaaaaaaaaaa','11','22','33','44','55',1,28,1,'guid','Mohammad',0,'Yes','Yes','Yes','2012-05-02 01:00:25'),(26,'1Title Directory','2012-05-02 00:00:00',3532,2,'1aaaaaaaaaaaaa','a11','2a2','a33','a44','a55',2,29,1,'1guid','1Mohammad',21,'No','No','No','2012-05-02 01:02:21'),(27,'Title Directory2','0000-00-00 00:00:00',3532,1,'','','','','','',2,28,1,'','',0,'Yes','Yes','Yes','2012-05-02 01:43:54'),(28,'1File Title','2012-05-31 00:00:00',3532,2,'1hhhhhhhhhhhh','a1','a2','a3','a4','a5',1,29,1,'1guid','1mmmmm',25,'No','No','No','2012-05-02 02:29:28'),(29,'tttttt','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','Yes','2012-05-02 02:46:14'),(30,'test','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-05 00:08:57'),(31,'sssss','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-06 03:00:36'),(32,'aaaaaaaaa','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-06 03:03:09');
/*!40000 ALTER TABLE `object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_abuse`
--

DROP TABLE IF EXISTS `object_abuse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_abuse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text,
  `object_abuse_type_id` int(11) unsigned NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `is_abuse` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `user_id` (`user_id`),
  KEY `object_abuse_type_id` (`object_abuse_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_abuse`
--

LOCK TABLES `object_abuse` WRITE;
/*!40000 ALTER TABLE `object_abuse` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_abuse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_abuse_type`
--

DROP TABLE IF EXISTS `object_abuse_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_abuse_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `published` (`published`,`approved`),
  KEY `package_id` (`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_abuse_type`
--

LOCK TABLES `object_abuse_type` WRITE;
/*!40000 ALTER TABLE `object_abuse_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_abuse_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_article`
--

DROP TABLE IF EXISTS `object_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `intro_text` varchar(1024) DEFAULT NULL,
  `full_text` text NOT NULL,
  `created_date` datetime NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `object_source_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `show_in_object` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` varchar(512) DEFAULT NULL,
  `options` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `published` (`published`,`approved`),
  KEY `show_in_object` (`show_in_object`,`published`,`approved`),
  KEY `cat_id_idx` (`category_id`,`id`),
  KEY `date_id_idx` (`date_added`,`id`),
  KEY `auth_id_idx` (`author_id`,`id`),
  KEY `date_added` (`date_added`),
  KEY `category_id_2` (`category_id`,`date_added`),
  KEY `object_source_id` (`object_source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_article`
--

LOCK TABLES `object_article` WRITE;
/*!40000 ALTER TABLE `object_article` DISABLE KEYS */;
INSERT INTO `object_article` VALUES (1,'Article Alias 1','bllllllllllllllllllllllllllllo w 2shrb maito','la la la Mohammad Riad Adli  Comic this font','0000-00-00 00:00:00',3532,0,20,0,'Yes','No','No',5,0,'0000-00-00 00:00:00',3532,'2012-05-02 00:13:54','2012-05-10 00:00:00','2012-05-20 00:00:00','2012-05-01 20:07:31',NULL,NULL),(2,'alias 22','nobtha 22','Ø³Ø¬Ù„ Ø§Ù†Ø§ Ø¹Ø±Ø¨ÙŠ','2012-05-31 00:00:00',3532,0,21,0,'No','No','No',2,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-22 00:00:00','2012-05-01 20:16:41',NULL,NULL),(3,'another test','','vvvvvvvvvvvvvvvvvvvvvvvvv','0000-00-00 00:00:00',3532,0,30,0,'No','No','No',2,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-05 00:08:57',NULL,NULL);
/*!40000 ALTER TABLE `object_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_article_special`
--

DROP TABLE IF EXISTS `object_article_special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_article_special` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL,
  `object_article_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_id` (`object_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_article_special`
--

LOCK TABLES `object_article_special` WRITE;
/*!40000 ALTER TABLE `object_article_special` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_article_special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_comment`
--

DROP TABLE IF EXISTS `object_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `nesting_level` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(150) DEFAULT NULL,
  `content` text NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `webpage` mediumtext,
  `locale_id` int(11) unsigned NOT NULL,
  `country_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_like` int(11) NOT NULL DEFAULT '0',
  `total_dislike` int(11) NOT NULL DEFAULT '0',
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `email` (`email`),
  KEY `country_id` (`country_id`),
  KEY `published` (`published`,`approved`),
  KEY `date_id_idx` (`date_added`,`id`),
  KEY `date_idx` (`date_added`),
  KEY `date_object_id_idx` (`date_added`,`object_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3490137 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_comment`
--

LOCK TABLES `object_comment` WRITE;
/*!40000 ALTER TABLE `object_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_directory`
--

DROP TABLE IF EXISTS `object_directory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_directory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `author_id` varchar(255) NOT NULL,
  `size` int(11) unsigned NOT NULL,
  `files_count` int(11) unsigned NOT NULL,
  `full_path` mediumtext NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `show_in_object` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `author_id` (`author_id`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_directory`
--

LOCK TABLES `object_directory` WRITE;
/*!40000 ALTER TABLE `object_directory` DISABLE KEYS */;
INSERT INTO `object_directory` VALUES (1,'1Name','1Label','1Description',0,'3532',1500,6,'/var',26,0,'No','No','No',0,'0000-00-00 00:00:00',3532,'2012-05-02 04:42:08','2012-05-02 01:02:21',NULL,NULL),(2,'Name2','Label2','desc2',1,'3532',5,5,'var/www/html/',27,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 01:43:55',NULL,NULL);
/*!40000 ALTER TABLE `object_directory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_file`
--

DROP TABLE IF EXISTS `object_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `object_directory_id` int(11) unsigned NOT NULL,
  `author_id` varchar(255) NOT NULL,
  `mime_type` varchar(200) NOT NULL,
  `size` int(11) unsigned NOT NULL,
  `extension` varchar(10) NOT NULL,
  `full_path` mediumtext NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `show_in_object` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `published` (`published`,`approved`),
  KEY `object_directory_id` (`object_directory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_file`
--

LOCK TABLES `object_file` WRITE;
/*!40000 ALTER TABLE `object_file` DISABLE KEYS */;
INSERT INTO `object_file` VALUES (1,'1File Name','1File Label','bbbbbbbbbb1',2,'1mohammad','',0,'','/1var/www/htm',28,0,'No','No','No',0,'0000-00-00 00:00:00',3532,'2012-05-02 05:45:17','2012-05-02 02:29:28',NULL,NULL),(2,'nnnnn','lllllll','dddddd',1,'mohammad','',0,'','/',29,0,'No','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 02:46:14',NULL,NULL);
/*!40000 ALTER TABLE `object_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_info`
--

DROP TABLE IF EXISTS `object_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL,
  `total_views` int(11) unsigned NOT NULL DEFAULT '0',
  `total_comments` int(11) unsigned NOT NULL DEFAULT '0',
  `total_rating` int(11) unsigned NOT NULL DEFAULT '0',
  `theme_layout_id` int(11) unsigned NOT NULL,
  `theme_template_id` int(11) unsigned NOT NULL,
  `theme_skin_id` int(11) unsigned NOT NULL,
  `theme_publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `theme_publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` varchar(512) DEFAULT NULL,
  `options` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `total_views` (`total_views`),
  KEY `total_comments` (`total_comments`),
  KEY `total_rating` (`total_rating`),
  KEY `theme_layout_id` (`theme_layout_id`),
  KEY `theme_template_id` (`theme_template_id`),
  KEY `theme_skin_id` (`theme_skin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_info`
--

LOCK TABLES `object_info` WRITE;
/*!40000 ALTER TABLE `object_info` DISABLE KEYS */;
INSERT INTO `object_info` VALUES (1,2,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 02:40:59','comments','\"options\"'),(2,0,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 02:55:13','comments','\"options\"'),(3,0,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:39:27','comments','\"options\"'),(4,5,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:42:05','comments','\"options\"'),(5,6,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:42:30','','\"\"'),(6,7,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:43:51','mmmmmmmmm','\"ooooooo\"'),(7,8,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 05:21:33','cccccc','\"ooooo\"'),(8,9,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 05:23:45','ccccc','\"oooo\"'),(9,12,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:50:42','','\"\"'),(10,13,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:51:52','','\"\"'),(11,14,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:53:00','','\"\"'),(12,15,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:53:50','7777','\"8888\"'),(13,16,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 13:00:02','comments','\"options\"'),(14,20,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 20:07:31','comments','\"options\"'),(15,21,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 20:16:41','','\"\"'),(16,22,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 22:46:58','comments11','\"options11\"'),(17,23,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 23:44:14','comm','\"optionnnnn\"'),(18,24,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 23:46:40','comm11','\"optionnnnn11\"'),(19,25,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 01:00:25','comments','\"options\"'),(20,26,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 01:02:21','1comments','\"1options\"'),(21,27,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 01:43:55','','\"\"'),(22,28,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 02:29:28','1cccccc','\"1ooooo\"'),(23,29,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 02:46:14','','\"\"'),(24,30,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-05 00:08:57','','\"\"'),(25,31,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:00:36','','\"\"'),(26,32,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:03:09','','\"\"');
/*!40000 ALTER TABLE `object_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_photo`
--

DROP TABLE IF EXISTS `object_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_photo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `object_source_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `size` int(11) unsigned NOT NULL,
  `height` int(11) unsigned NOT NULL,
  `width` int(11) unsigned NOT NULL,
  `extension` varchar(5) NOT NULL,
  `taken_date` datetime NOT NULL,
  `taken_location` varchar(255) NOT NULL,
  `meta_data` text NOT NULL,
  `show_in_object` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `published` (`published`,`approved`),
  KEY `show_in_object` (`show_in_object`,`published`,`approved`),
  KEY `object_source_id` (`object_source_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67324 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_photo`
--

LOCK TABLES `object_photo` WRITE;
/*!40000 ALTER TABLE `object_photo` DISABLE KEYS */;
INSERT INTO `object_photo` VALUES (67314,'Array','bla blaaaaa',3532,0,2,0,4835,128,172,'.jpg','2012-04-30 08:11:40','Amman','','Yes','Yes','No',27,0,'0000-00-00 00:00:00',3532,'2012-04-30 08:11:40','2012-05-05 00:00:00','2012-05-06 00:00:00','2012-04-30 02:40:59',NULL,NULL),(67315,'alternative1','bla blaaaaa',3532,0,0,0,4835,128,172,'.jpg','2012-04-30 07:56:22','Amman','','No','No','No',25,0,'0000-00-00 00:00:00',3532,'2012-04-30 07:56:22','2012-05-05 00:00:00','2012-05-06 00:00:00','2012-04-30 02:55:13',NULL,NULL),(67316,'alternative1','bla blaaaaa',3532,0,0,0,4835,128,172,'.jpg','2012-04-30 08:10:48','Amman','','Yes','No','No',23,0,'0000-00-00 00:00:00',3532,'2012-04-30 08:10:48','2012-05-05 00:00:00','2012-05-06 00:00:00','2012-04-30 03:39:27',NULL,NULL),(67317,'alternative1','bla blaaaaa',3532,0,5,0,17929,175,250,'.jpg','2012-04-30 00:00:00','Amman','','Yes','No','No',21,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-05 00:00:00','2012-05-06 00:00:00','2012-04-30 03:42:05',NULL,NULL),(67318,'ttttttest333333','aaaa',3532,0,7,0,1623,65,86,'.jpg','2012-04-04 00:00:00','Zarqa','','Yes','No','No',17,0,'0000-00-00 00:00:00',3532,'2012-04-30 08:18:37','2000-11-28 00:00:00','2000-11-27 00:00:00','2012-04-30 03:43:51',NULL,NULL),(67319,'aaaaa','mmmmmm',3532,0,9,0,4835,128,172,'.jpg','2012-04-05 00:00:00','KSA','','Yes','No','No',9,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-01 00:00:00','2012-05-02 00:00:00','2012-04-30 05:23:45',NULL,NULL),(67320,'aaaaaa','aaaaaa',3532,0,11,0,4835,128,172,'.jpg','2012-05-01 15:20:19','','','No','No','No',6,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:20:19',NULL,NULL),(67321,'Test Alternative Title Video2','bla bla bla',3532,0,17,0,116599,870,600,'.jpg','2012-05-01 00:00:00','UAE','','Yes','No','No',7,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 00:00:00','2012-05-10 00:00:00','2012-05-01 14:30:25',NULL,NULL),(67322,'Test Alternative Title Video2','bla bla bla',3532,0,18,0,116599,870,600,'.jpg','2012-05-01 00:00:00','UAE','','Yes','No','No',5,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 00:00:00','2012-05-10 00:00:00','2012-05-01 14:32:02',NULL,NULL),(67323,'Test Alternative Title Video2','bla bla bla',3532,0,19,0,116599,870,600,'.jpg','2012-05-01 00:00:00','UAE','','Yes','No','No',3,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-02 00:00:00','2012-05-10 00:00:00','2012-05-01 14:34:11',NULL,NULL);
/*!40000 ALTER TABLE `object_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_rating`
--

DROP TABLE IF EXISTS `object_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_rating` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `last_ip` varchar(50) NOT NULL,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_total` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `last_ip` (`last_ip`),
  KEY `object_id` (`object_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_rating`
--

LOCK TABLES `object_rating` WRITE;
/*!40000 ALTER TABLE `object_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_source`
--

DROP TABLE IF EXISTS `object_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_source` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `source_type` varchar(32) NOT NULL,
  `url` mediumtext NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `time_delay` int(11) unsigned NOT NULL DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `package_id` (`package_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_source`
--

LOCK TABLES `object_source` WRITE;
/*!40000 ALTER TABLE `object_source` DISABLE KEYS */;
INSERT INTO `object_source` VALUES (1,'name1','description1','news','http://www.yahoo.com',3532,1,0,22,'Yes','Yes',3,'2012-04-29 14:43:25'),(2,'name22','description22','sports2','http://www.aulaula.local/admin/handle/pkg/object-source11',3532,1,0,110,'Yes','Yes',11,'2012-04-29 14:48:29');
/*!40000 ALTER TABLE `object_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_source_info`
--

DROP TABLE IF EXISTS `object_source_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_source_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_source_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `object_source_id` (`object_source_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_source_info`
--

LOCK TABLES `object_source_info` WRITE;
/*!40000 ALTER TABLE `object_source_info` DISABLE KEYS */;
INSERT INTO `object_source_info` VALUES (1,1,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-20 00:00:00','2012-04-30 00:00:00','2012-04-29 14:43:25','comments1','\"options1\"'),(2,2,0,'0000-00-00 00:00:00',3532,'2012-04-29 18:21:24','2012-04-18 00:00:00','2012-04-19 00:00:00','2012-04-29 14:48:29','aaaaaa','\"bbbbbb\"');
/*!40000 ALTER TABLE `object_source_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_static`
--

DROP TABLE IF EXISTS `object_static`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_static` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `url` mediumtext NOT NULL,
  `intro_text` text NOT NULL,
  `full_text` text NOT NULL,
  `created_date` datetime NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_static`
--

LOCK TABLES `object_static` WRITE;
/*!40000 ALTER TABLE `object_static` DISABLE KEYS */;
INSERT INTO `object_static` VALUES (1,'Alternative Alias 111','http://www.aulaula.local/admin/handle/pkg/object-static/action/add111','bla blooooooo111','First Of All Secound  Third1111','0000-00-00 00:00:00',3532,24,0,'No','No',0,'0000-00-00 00:00:00',3532,'2012-05-02 03:05:41','2012-05-13 00:00:00','2012-05-20 00:00:00','2012-05-01 23:46:40',NULL,NULL);
/*!40000 ALTER TABLE `object_static` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_tag`
--

DROP TABLE IF EXISTS `object_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_tag`
--

LOCK TABLES `object_tag` WRITE;
/*!40000 ALTER TABLE `object_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_type`
--

DROP TABLE IF EXISTS `object_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `package_id` (`package_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_type`
--

LOCK TABLES `object_type` WRITE;
/*!40000 ALTER TABLE `object_type` DISABLE KEYS */;
INSERT INTO `object_type` VALUES (1,'title 1','label 1','wasf',0,0,'Yes','Yes','2012-04-29 12:16:50'),(2,'title 22','label 22','description 22',3532,0,'No','Yes','2012-04-29 12:25:18');
/*!40000 ALTER TABLE `object_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_type_info`
--

DROP TABLE IF EXISTS `object_type_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_type_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_type_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `object_type_id` (`object_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_type_info`
--

LOCK TABLES `object_type_info` WRITE;
/*!40000 ALTER TABLE `object_type_info` DISABLE KEYS */;
INSERT INTO `object_type_info` VALUES (1,1,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-30 00:00:00','2012-05-10 00:00:00','2012-04-29 12:16:50','comments','\"options\"'),(2,2,0,'0000-00-00 00:00:00',3532,'2012-04-29 15:46:25','2012-04-23 00:00:00','2012-04-26 00:00:00','2012-04-29 12:25:18','comment22','\"option22\"');
/*!40000 ALTER TABLE `object_type_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_url`
--

DROP TABLE IF EXISTS `object_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `url` mediumtext NOT NULL,
  `style` mediumtext NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `object_source_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `show_in_object` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `url_type` enum('Link','Iframe','YouTube') NOT NULL DEFAULT 'Link',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`,`order`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `show_in_object` (`show_in_object`,`published`,`approved`),
  KEY `published` (`published`,`approved`),
  KEY `object_source_id` (`object_source_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_url`
--

LOCK TABLES `object_url` WRITE;
/*!40000 ALTER TABLE `object_url` DISABLE KEYS */;
INSERT INTO `object_url` VALUES (1,'URL Alternative 11','bla bla blaaaa11','http://www.aulaula.local/admin/handle/pkg/object-url','color:red;text-decoration:none',3532,0,22,0,'Yes','No','No','Iframe',2,0,'0000-00-00 00:00:00',3532,'2012-05-02 01:59:41','2012-05-10 00:00:00','2012-05-17 00:00:00','2012-05-01 22:46:58',NULL,NULL);
/*!40000 ALTER TABLE `object_url` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_user_favourite`
--

DROP TABLE IF EXISTS `object_user_favourite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_user_favourite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_user_favourite`
--

LOCK TABLES `object_user_favourite` WRITE;
/*!40000 ALTER TABLE `object_user_favourite` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_user_favourite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_video`
--

DROP TABLE IF EXISTS `object_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `object_source_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `size` int(11) unsigned NOT NULL,
  `height` int(11) unsigned NOT NULL,
  `width` int(11) unsigned NOT NULL,
  `extension` varchar(5) NOT NULL,
  `taken_date` datetime NOT NULL,
  `taken_location` varchar(255) NOT NULL,
  `meta_data` text NOT NULL,
  `show_in_object` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `encoded` enum('Yes','No','Lock') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `object_id` (`object_id`),
  KEY `category_id` (`category_id`),
  KEY `show_in_object` (`show_in_object`,`published`,`approved`),
  KEY `published` (`published`,`approved`),
  KEY `object_source_id` (`object_source_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_video`
--

LOCK TABLES `object_video` WRITE;
/*!40000 ALTER TABLE `object_video` DISABLE KEYS */;
INSERT INTO `object_video` VALUES (1,'test222','1111',3532,0,16,0,669036,230,480,'video','2012-05-31 00:00:00','Amman444','','Yes','No','No','No',11,0,'0000-00-00 00:00:00',3532,'2012-05-01 18:58:46','2013-05-01 00:00:00','2013-05-31 00:00:00','2012-05-01 12:53:50',NULL,NULL),(2,'Test Object Video2222','bla bla bla3333',3532,0,15,0,129444,230,480,'video','2012-05-16 00:00:00','KSA','','Yes','No','No','No',17,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2013-05-21 00:00:00','2013-05-20 00:00:00','2012-05-01 13:00:02',NULL,NULL),(3,'dddddddd','',3532,0,31,0,0,0,0,'NULL','0000-00-00 00:00:00','','','No','No','No','No',16,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:00:36',NULL,NULL),(4,'aaaaaaaaaaaaa','',3532,0,32,0,0,0,0,'NULL','0000-00-00 00:00:00','','','No','No','No','No',7,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:03:09',NULL,NULL);
/*!40000 ALTER TABLE `object_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL DEFAULT '',
  `show_in_menu` enum('Yes','No') NOT NULL DEFAULT 'No',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `type` enum('Core','Module','Plugin') NOT NULL DEFAULT 'Module',
  `reference_id` int(11) unsigned NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`approved`),
  KEY `reference_id` (`reference_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_action`
--

DROP TABLE IF EXISTS `package_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action_title` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL,
  `action_description` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `package_id` int(11) unsigned NOT NULL,
  `package_class_id` int(11) unsigned NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`),
  KEY `package_class_id` (`package_class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_action`
--

LOCK TABLES `package_action` WRITE;
/*!40000 ALTER TABLE `package_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_class`
--

DROP TABLE IF EXISTS `package_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `package_id` int(11) unsigned NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_class`
--

LOCK TABLES `package_class` WRITE;
/*!40000 ALTER TABLE `package_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_info`
--

DROP TABLE IF EXISTS `package_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(11) unsigned NOT NULL,
  `default_action_title` varchar(255) NOT NULL DEFAULT '',
  `default_action_name` varchar(255) NOT NULL DEFAULT '',
  `version` varchar(15) NOT NULL DEFAULT '1.0',
  `locked_by` int(11) unsigned NOT NULL,
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_info`
--

LOCK TABLES `package_info` WRITE;
/*!40000 ALTER TABLE `package_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll`
--

DROP TABLE IF EXISTS `poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `label` varchar(255) CHARACTER SET utf8 NOT NULL,
  `votes_count` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') CHARACTER SET utf8 NOT NULL DEFAULT 'No',
  `author_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) NOT NULL,
  `locked_time` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_time` datetime NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_from` datetime NOT NULL,
  `publish_to` datetime DEFAULT NULL,
  `comments` text CHARACTER SET utf8 NOT NULL,
  `options` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `published` (`published`,`approved`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll`
--

LOCK TABLES `poll` WRITE;
/*!40000 ALTER TABLE `poll` DISABLE KEYS */;
/*!40000 ALTER TABLE `poll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_answer`
--

DROP TABLE IF EXISTS `poll_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_answer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL,
  `votes_count` int(11) unsigned NOT NULL DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `author_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `FK_POLL_PARENT` (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_answer`
--

LOCK TABLES `poll_answer` WRITE;
/*!40000 ALTER TABLE `poll_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `poll_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_vote`
--

DROP TABLE IF EXISTS `poll_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_vote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_answer_id` int(11) unsigned NOT NULL,
  `ip_address` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `FK_POLL_ANSWER` (`poll_answer_id`),
  KEY `poll_answer_id` (`poll_answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_vote`
--

LOCK TABLES `poll_vote` WRITE;
/*!40000 ALTER TABLE `poll_vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `poll_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_log`
--

DROP TABLE IF EXISTS `search_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_log` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_log`
--

LOCK TABLES `search_log` WRITE;
/*!40000 ALTER TABLE `search_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_layout_id` int(11) unsigned NOT NULL,
  `theme_template_id` int(11) unsigned NOT NULL,
  `theme_skin_id` int(11) unsigned NOT NULL,
  `package_id` int(11) unsigned NOT NULL DEFAULT '0',
  `package_class_id` int(11) unsigned NOT NULL,
  `package_action_id` int(11) unsigned NOT NULL,
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `theme_layout_id` (`theme_layout_id`),
  KEY `theme_template_id` (`theme_template_id`),
  KEY `theme_skin_id` (`theme_skin_id`),
  KEY `package_class_id` (`package_class_id`),
  KEY `package_action_id` (`package_action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_layout`
--

DROP TABLE IF EXISTS `theme_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_layout` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `direction` enum('ltr','rtl') NOT NULL DEFAULT 'ltr',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `default` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_layout`
--

LOCK TABLES `theme_layout` WRITE;
/*!40000 ALTER TABLE `theme_layout` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_layout_info`
--

DROP TABLE IF EXISTS `theme_layout_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_layout_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_layout_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `theme_layout_id` (`theme_layout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_layout_info`
--

LOCK TABLES `theme_layout_info` WRITE;
/*!40000 ALTER TABLE `theme_layout_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_layout_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_skin`
--

DROP TABLE IF EXISTS `theme_skin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_skin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_layout_id` int(11) unsigned NOT NULL,
  `theme_template_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `default` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `theme_layout_id` (`theme_layout_id`),
  KEY `theme_template_id` (`theme_template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_skin`
--

LOCK TABLES `theme_skin` WRITE;
/*!40000 ALTER TABLE `theme_skin` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_skin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_skin_info`
--

DROP TABLE IF EXISTS `theme_skin_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_skin_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_skin_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `theme_skin_id` (`theme_skin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_skin_info`
--

LOCK TABLES `theme_skin_info` WRITE;
/*!40000 ALTER TABLE `theme_skin_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_skin_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_template`
--

DROP TABLE IF EXISTS `theme_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `default` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_template`
--

LOCK TABLES `theme_template` WRITE;
/*!40000 ALTER TABLE `theme_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_template_info`
--

DROP TABLE IF EXISTS `theme_template_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_template_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_template_id` int(11) unsigned NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `theme_template_id` (`theme_template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_template_info`
--

LOCK TABLES `theme_template_info` WRITE;
/*!40000 ALTER TABLE `theme_template_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_template_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation`
--

DROP TABLE IF EXISTS `translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varbinary(255) NOT NULL,
  `translation` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label_locale_id` (`label`,`locale_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation`
--

LOCK TABLES `translation` WRITE;
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
INSERT INTO `translation` VALUES (1,'en label','en translation',1,'a5c56f65f9a34cd8cdc91f781df01809',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 21:02:26','en comm'),(2,'11ar label','11ar translation',2,'a5c56f65f9a34cd8cdc91f781df01809',0,'0000-00-00 00:00:00',3532,'2012-05-26 00:08:14','2012-05-25 21:02:26','11ar comments'),(3,'11en label','11',1,'cf1c46bce374dde03a850ef1025fd70a',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 21:44:01',''),(4,'En label','wwww',1,'9e250d966ea45cd1f177a62e3fc885f7',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 21:45:17',''),(5,'ar label','tttt',2,'9e250d966ea45cd1f177a62e3fc885f7',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 21:45:17',''),(6,'En Label','ddd',1,'783a76c76ce5f8fa754a5538c79eaa7b',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 21:46:25',''),(7,'fgege w ddw','ee',1,'89962da8ce6e80ee783827b422a0dab2',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 22:47:00',''),(8,'ee','eee',2,'89962da8ce6e80ee783827b422a0dab2',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-25 22:47:00','');
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_level_id` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `user_level_id` (`user_level_id`),
  KEY `username` (`username`,`password`),
  KEY `usr_lvl_id_idx` (`user_level_id`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3533 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3532,'anas','212c35964b5f0e476b53c59d448ab835','Anas K. Al-Far','anas@al-far.com',1,'2012-02-20 17:36:48');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `registration_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `company` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `home_phone` varchar(17) NOT NULL,
  `work_phone` varchar(17) NOT NULL,
  `work_fax` varchar(17) NOT NULL,
  `mobile` varchar(17) NOT NULL,
  `blocked` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `confirmed` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `blocked` (`blocked`),
  KEY `approved` (`approved`),
  KEY `confirmed` (`confirmed`),
  KEY `blocked_2` (`blocked`,`approved`,`confirmed`)
) ENGINE=MyISAM AUTO_INCREMENT=8984 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (8983,3532,'2012-02-01 00:00:00','2012-02-01 00:00:00','2012-02-01 00:00:00','','','','','','','','No','Yes','Yes',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-02-20 17:37:38',NULL,NULL);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locked_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` VALUES (1,'Admin','Admin','Admin',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-14 09:14:40',NULL,NULL);
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level_permission`
--

DROP TABLE IF EXISTS `user_level_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) unsigned NOT NULL,
  `package_class_id` int(11) unsigned NOT NULL,
  `package_action_id` int(11) unsigned NOT NULL,
  `permission` int(11) unsigned NOT NULL,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `user_level_id` (`user_level_id`),
  KEY `package_class_id` (`package_class_id`),
  KEY `package_action_id` (`package_action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level_permission`
--

LOCK TABLES `user_level_permission` WRITE;
/*!40000 ALTER TABLE `user_level_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_level_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_body_color`
--

DROP TABLE IF EXISTS `vehicle_body_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_body_color` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_body_color`
--

LOCK TABLES `vehicle_body_color` WRITE;
/*!40000 ALTER TABLE `vehicle_body_color` DISABLE KEYS */;
INSERT INTO `vehicle_body_color` VALUES (1,'eeetttSS','eeedddAA',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-21 02:38:51','eeecccZZ','\"eeeoooVV\"'),(2,'2aaatttSS','2aaadddAA',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-21 02:38:51','2aaacccZZ','\"2aaaoooVV\"'),(3,'English bc titSS','English bc desAA',1,'cf1c46bce374dde03a850ef1025fd70a','2012-05-21 02:41:03','En bc comZZ','\"VV\"'),(4,'Arabic bc titSS','Arabic bc desAA',2,'cf1c46bce374dde03a850ef1025fd70a','2012-05-21 02:41:03','ZZ','\"Ar bc oppVV\"'),(5,'English bc titSS','English bc desAA',1,'04cad1512375a8c1822ecc30b0b467b2','2012-05-21 04:42:02','En bc comZZ','\"VV\"'),(6,'Arabic bc titSS','Arabic bc desAA',2,'04cad1512375a8c1822ecc30b0b467b2','2012-05-21 04:42:02','ZZ','\"Ar bc oppVV\"'),(7,'11en en title','11en en description',1,'89962da8ce6e80ee783827b422a0dab2','2012-05-23 05:03:02','22','\"22\"'),(8,'22ar ar title','22ar ar description',2,'89962da8ce6e80ee783827b422a0dab2','2012-05-23 05:03:02','22','\"22\"');
/*!40000 ALTER TABLE `vehicle_body_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_drag_system`
--

DROP TABLE IF EXISTS `vehicle_drag_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_drag_system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_drag_system`
--

LOCK TABLES `vehicle_drag_system` WRITE;
/*!40000 ALTER TABLE `vehicle_drag_system` DISABLE KEYS */;
INSERT INTO `vehicle_drag_system` VALUES (1,'en title','en desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-23 05:09:38','','\"\"'),(2,'ar title','ar desc',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-23 05:09:38','','\"\"'),(3,'22tttt en','22dddd en',1,'cf1c46bce374dde03a850ef1025fd70a','2012-05-23 05:10:44','22comm en','\"22opp en\"'),(4,'11tttt ar','111dddd ar',2,'cf1c46bce374dde03a850ef1025fd70a','2012-05-23 05:10:44','11comm ar','\"11opp ar\"');
/*!40000 ALTER TABLE `vehicle_drag_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_inside_color`
--

DROP TABLE IF EXISTS `vehicle_inside_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_inside_color` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_inside_color`
--

LOCK TABLES `vehicle_inside_color` WRITE;
/*!40000 ALTER TABLE `vehicle_inside_color` DISABLE KEYS */;
INSERT INTO `vehicle_inside_color` VALUES (1,'test title','test descrtiption',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-20 16:21:37','test comment','\"\"'),(2,'Ø¹Ù†ÙˆØ§Ù† ØªØ¬Ø±ÙŠØ¨ÙŠ','ÙˆØµÙ ØªØ¬Ø±ÙŠØ¨ÙŠ2',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-20 16:21:37','Ø³Ù„Ø§Ù…','\"\"'),(3,'eeee','rrrr',0,'cf1c46bce374dde03a850ef1025fd70a','2012-05-21 02:01:46',NULL,'null'),(4,'11tt en','11dd en',1,'9e250d966ea45cd1f177a62e3fc885f7','2012-05-23 05:15:48','11','\"11\"'),(5,'tt ar','dd ar',2,'9e250d966ea45cd1f177a62e3fc885f7','2012-05-23 05:15:48','','\"\"');
/*!40000 ALTER TABLE `vehicle_inside_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_insurance_type`
--

DROP TABLE IF EXISTS `vehicle_insurance_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_insurance_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_insurance_type`
--

LOCK TABLES `vehicle_insurance_type` WRITE;
/*!40000 ALTER TABLE `vehicle_insurance_type` DISABLE KEYS */;
INSERT INTO `vehicle_insurance_type` VALUES (1,'2121','1111',1,'','2012-05-09 06:04:30','eee','\"www\"');
/*!40000 ALTER TABLE `vehicle_insurance_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_make`
--

DROP TABLE IF EXISTS `vehicle_make`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_make` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_type_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `vehicle_type_id` (`vehicle_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_make`
--

LOCK TABLES `vehicle_make` WRITE;
/*!40000 ALTER TABLE `vehicle_make` DISABLE KEYS */;
INSERT INTO `vehicle_make` VALUES (1,1,'make title','make description',2,'','2012-05-09 02:11:36','comments','\"options\"'),(2,3,'make title1','make description1',2,'','2012-05-09 02:14:07','nooo','\"yeees\"'),(4,0,'qq','ww',1,'','2012-05-09 07:18:52','','\"\"'),(5,1,'vm_title1','vm_description1',2,'','2012-05-20 22:39:43','vm_comments1','vm_options1'),(6,2,'vm_title2','vm_description2',2,'','2012-05-20 22:39:43','vm_comments2','vm_options2'),(7,3,'vm_title3','vm_description3',1,'','2012-05-20 22:39:43','vm_comments3','vm_options3'),(8,4,'vm_title4','vm_description4',2,'','2012-05-20 22:39:43','vm_comments4','vm_options4'),(9,3,'11en title','11en desc',1,'644b718f9ea2842ed9be34879d6f162b','2012-05-23 07:12:50','11www','\"11qqq\"'),(10,5,'111ar ttttt','111ar desc',2,'644b718f9ea2842ed9be34879d6f162b','2012-05-23 07:12:50','11ccc','\"11xxx\"');
/*!40000 ALTER TABLE `vehicle_make` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_model`
--

DROP TABLE IF EXISTS `vehicle_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_make_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `vehicle_make_id` (`vehicle_make_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_model`
--

LOCK TABLES `vehicle_model` WRITE;
/*!40000 ALTER TABLE `vehicle_model` DISABLE KEYS */;
INSERT INTO `vehicle_model` VALUES (7,7,'en title','en desc',1,'89962da8ce6e80ee783827b422a0dab2','2012-05-23 06:06:19','','\"\"'),(8,10,'ar title','ar desc',2,'89962da8ce6e80ee783827b422a0dab2','2012-05-23 06:06:19','','\"\"');
/*!40000 ALTER TABLE `vehicle_model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_type`
--

DROP TABLE IF EXISTS `vehicle_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_type`
--

LOCK TABLES `vehicle_type` WRITE;
/*!40000 ALTER TABLE `vehicle_type` DISABLE KEYS */;
INSERT INTO `vehicle_type` VALUES (1,'title1','description1',1,'','2012-05-09 00:09:23','comments','\"options\"'),(3,'title2','description2',1,'','2012-05-09 01:11:49','comments2','\"options2\"'),(4,'vt_title1','vt_description1',2,'','2012-05-20 22:36:48','vt_comments1','vt_options1'),(5,'vt_title2','vt_description2',2,'','2012-05-20 22:36:48','vt_comments2','vt_options2'),(6,'vt_title3','vt_description3',1,'','2012-05-20 22:36:48','vt_comments3','vt_options3'),(7,'vt_title4','vt_description4',1,'','2012-05-20 22:36:50','vt_comments4','vt_options4');
/*!40000 ALTER TABLE `vehicle_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_year`
--

DROP TABLE IF EXISTS `vehicle_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_year` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_year`
--

LOCK TABLES `vehicle_year` WRITE;
/*!40000 ALTER TABLE `vehicle_year` DISABLE KEYS */;
INSERT INTO `vehicle_year` VALUES (1,'year title','year description',1,'','2012-05-09 04:41:39','coommm','\"oppttt\"');
/*!40000 ALTER TABLE `vehicle_year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waseet_category`
--

DROP TABLE IF EXISTS `waseet_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `waseet_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `locale_id` int(11) unsigned NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `options` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waseet_category`
--

LOCK TABLES `waseet_category` WRITE;
/*!40000 ALTER TABLE `waseet_category` DISABLE KEYS */;
INSERT INTO `waseet_category` VALUES (1,'en waseet title','en waseet desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 20:12:04','en commmmm','\"en oppppp\"'),(2,'1ar waseet title','1ar waseet desc',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-25 20:12:04','ar commmm','\"1ar oppppp\"');
/*!40000 ALTER TABLE `waseet_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-26  3:55:21
