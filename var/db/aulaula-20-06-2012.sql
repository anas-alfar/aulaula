-- MySQL dump 10.13  Distrib 5.5.23, for Linux (x86_64)
--
-- Host: localhost    Database: aulaula
-- ------------------------------------------------------
-- Server version	5.5.23

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
INSERT INTO `category` VALUES (28,'title','label','description',2,3532,0,0,'Yes','Yes','Yes',15,'2012-04-26 05:04:04'),(29,'title2','label2','description2',3,3532,0,0,'Yes','No','Yes',13,'2012-04-26 05:14:31'),(30,'111222','3223','444444',3,3532,0,0,'No','Yes','No',9,'2012-04-26 05:27:28'),(31,'4444','333','2222',2,3532,0,0,'No','Yes','No',12,'2012-04-26 05:28:50'),(32,'assadsad','asdasd','sdfsdf',2,3532,31,0,'Yes','No','No',6,'2012-04-26 18:45:08'),(33,'asdasd','asdasd','asdasd',2,3532,28,0,'Yes','Yes','Yes',7,'2012-04-28 12:36:44'),(34,'@#$\\','@#$@#$','@#$@#$',0,3532,0,0,'Yes','No','No',1,'2012-04-28 12:39:24');
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
INSERT INTO `category_type` VALUES (2,'category_type_title2','llllabel','ddddescription',3532,0,'Yes','Yes','Yes',2,'2012-04-26 01:52:41'),(3,'category_type_title3','label2','description2',3532,0,'Yes','Yes','Yes',5,'2012-04-26 01:54:22');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_location`
--

LOCK TABLES `estate_location` WRITE;
/*!40000 ALTER TABLE `estate_location` DISABLE KEYS */;
INSERT INTO `estate_location` VALUES (1,'en title','en desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 20:09:03','','\"\"'),(2,'ar title','ar desc',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 20:09:04','','\"\"');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_outdoor_amenities`
--

LOCK TABLES `estate_outdoor_amenities` WRITE;
/*!40000 ALTER TABLE `estate_outdoor_amenities` DISABLE KEYS */;
INSERT INTO `estate_outdoor_amenities` VALUES (1,'en111','222 en',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 20:18:41','','\"\"'),(2,'222 ar','222 ar',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 20:18:41','','\"\"');
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
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`),
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_for`
--

LOCK TABLES `landlots_for` WRITE;
/*!40000 ALTER TABLE `landlots_for` DISABLE KEYS */;
INSERT INTO `landlots_for` VALUES (1,'en title','en description',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 19:40:54','','\"\"'),(2,'ar title','ar description',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 19:40:54','','\"\"');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`),
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landlots_type`
--

LOCK TABLES `landlots_type` WRITE;
/*!40000 ALTER TABLE `landlots_type` DISABLE KEYS */;
INSERT INTO `landlots_type` VALUES (1,'en title','en desc',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 19:15:17','','\"\"'),(2,'ar title','ar desc',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 19:15:17','','\"\"');
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
INSERT INTO `locale` VALUES (1,'En','English','English Language','Yes','Yes',1,'2012-05-19 22:20:09','qqqq'),(2,'Ar','Arabic','Arabic Language','Yes','Yes',2,'2012-05-19 22:20:39','wwww'),(3,'Fr','Franci','France Language','No','No',3,'2012-05-21 06:26:42','commmm commmm');
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'About us','object-static/view/name/aboutus',10,0,0,NULL,'Yes','Yes',14,'2012-06-15 21:48:30'),(2,'Mission','object-static/view/name/mission',10,0,0,NULL,'Yes','Yes',15,'2012-06-15 21:49:08'),(3,'Services','object-static/view/name/services',10,0,0,NULL,'Yes','Yes',16,'2012-06-15 21:49:37'),(4,'Home','/',11,0,0,0,'Yes','Yes',8,'2012-06-15 23:44:26'),(5,'Vehicle for sale','vehicle/default/for/sale',11,0,0,NULL,'Yes','Yes',9,'2012-06-15 23:47:43'),(6,'Vehicle for rent','vehicle/default/for/rent',11,0,0,NULL,'Yes','Yes',10,'2012-06-15 23:48:27'),(7,'Realestate','estate',11,0,0,0,'Yes','Yes',11,'2012-06-15 23:49:27'),(8,'Land lots','landlots',11,0,0,0,'Yes','Yes',12,'2012-06-15 23:49:56'),(9,'Mobile','mobile',11,0,0,0,'Yes','Yes',13,'2012-06-15 23:50:18'),(10,'Rent your home','default/home',11,4,0,NULL,'Yes','Yes',4,'2012-06-16 03:48:01'),(11,'House','default/home',11,4,0,0,'Yes','Yes',6,'2012-06-16 03:51:05'),(12,'Rent your car','default/vehicle/type/rent',11,4,0,0,'Yes','Yes',5,'2012-06-16 03:51:52'),(13,'Aaaaaaaa','aaaaaa/aaaaa',11,4,0,0,'Yes','Yes',7,'2012-06-16 03:52:32'),(14,'Bbbbbbbbbbbb','bbbb/bbbbb',11,5,0,0,'Yes','Yes',2,'2012-06-16 03:53:11'),(15,'Ccccccc','ccc/cccc',11,5,0,0,'Yes','Yes',3,'2012-06-16 03:53:45'),(16,'Rent you body','body/type/rent',11,6,0,0,'Yes','Yes',1,'2012-06-16 03:54:48');
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_info`
--

LOCK TABLES `menu_info` WRITE;
/*!40000 ALTER TABLE `menu_info` DISABLE KEYS */;
INSERT INTO `menu_info` VALUES (1,1,0,'0000-00-00 00:00:00',3532,'2012-06-16 03:54:34','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-15 21:48:30','','\"\"'),(2,2,0,'0000-00-00 00:00:00',3532,'2012-06-16 03:54:47','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-15 21:49:08','','\"\"'),(3,3,0,'0000-00-00 00:00:00',3532,'2012-06-16 03:54:56','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-15 21:49:37','','\"\"'),(4,4,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-15 23:44:26','','\"\"'),(5,5,0,'0000-00-00 00:00:00',3532,'2012-06-16 06:29:32','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-15 23:47:43','','\"\"'),(6,6,0,'0000-00-00 00:00:00',3532,'2012-06-16 06:29:44','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-15 23:48:27','','\"\"'),(7,7,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-15 23:49:27','','\"\"'),(8,8,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-15 23:49:56','','\"\"'),(9,9,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-15 23:50:18','','\"\"'),(10,10,0,'0000-00-00 00:00:00',3532,'2012-06-16 06:48:13','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-16 03:48:01','','\"\"'),(11,11,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-16 03:51:05','','\"\"'),(12,12,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-16 03:51:52','','\"\"'),(13,13,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-16 03:52:32','','\"\"'),(14,14,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-16 03:53:11','','\"\"'),(15,15,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-16 03:53:45','','\"\"'),(16,16,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-16 03:54:48','','\"\"');
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_type`
--

LOCK TABLES `menu_type` WRITE;
/*!40000 ALTER TABLE `menu_type` DISABLE KEYS */;
INSERT INTO `menu_type` VALUES (11,'menu_nav','main_menu','main_menu',3532,'Yes','Yes',4,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-15 21:40:11','','\"\"'),(10,'top_menu_nav','upper_menu','upper_menu',3532,'Yes','Yes',5,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-15 21:37:53','','\"\"');
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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object`
--

LOCK TABLES `object` WRITE;
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` VALUES (1,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-04-30 02:39:45'),(2,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-04-30 02:40:59'),(5,'title1','2012-05-01 00:00:00',3532,1,'photo,image','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø©','Meta Title','Meta Keywords','Meta Description','Meta Data',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-04-30 03:42:05'),(7,'test3333','2000-11-29 00:00:00',3532,2,'nnnnnnnnn','111','222','333','444','555',2,31,1,'bbbbbbbbbbb','Anas',6,'Yes','Yes','Yes','2012-04-30 03:43:51'),(8,'looooong','2012-04-30 00:00:00',3532,1,'mmmm','123','321','456','654','666',1,28,1,'ddd','fffffffffffff',1,'Yes','Yes','Yes','2012-04-30 05:21:33'),(9,'ttttttttt','2012-04-30 00:00:00',3532,1,'ttttt','123','321','456','654','666',0,28,1,'ggggg','anas',6,'Yes','Yes','Yes','2012-04-30 05:23:45'),(10,'dddddd','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-01 12:18:38'),(11,'dddddd','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-01 12:20:19'),(12,'test','2012-05-31 00:00:00',3532,1,'vvvvvv','','','','','',1,28,1,'','',6,'No','Yes','Yes','2012-05-01 12:50:42'),(13,'test','2012-05-31 00:00:00',3532,1,'vvvvvv','','','','','',1,28,1,'','',6,'No','Yes','Yes','2012-05-01 12:51:52'),(14,'test','2012-05-31 00:00:00',3532,1,'vvvvvv','','','','','',1,28,1,'','',6,'No','Yes','Yes','2012-05-01 12:53:00'),(15,'test111','2012-05-31 00:00:00',3532,1,'vvvvvv','999','888','777','666','000',1,31,1,'5555','6666',5,'Yes','Yes','Yes','2012-05-01 12:53:50'),(16,'Test Object Video','2012-05-31 00:00:00',3532,2,'a,b,c','page title','meta title','meta keyword','mets description','meta data',2,34,1,'GUID','Mohammad',11,'Yes','Yes','Yes','2012-05-01 13:00:02'),(17,'Test Title Video2','2012-06-10 00:00:00',3532,2,'aa,bb,cc,dd','Page Title','Metaaaa Title','Metaaaa Keywords','Metaaaa Description','Metaaaaa Data',2,28,1,'Fvml2rtw4','Mutashabih',1,'Yes','Yes','Yes','2012-05-01 14:30:25'),(18,'Test Title Video2','2012-06-10 00:00:00',3532,2,'aa,bb,cc,dd','Page Title','Metaaaa Title','Metaaaa Keywords','Metaaaa Description','Metaaaaa Data',2,28,1,'Fvml2rtw4','Mutashabih',1,'Yes','Yes','Yes','2012-05-01 14:32:02'),(19,'Test Title Video2','2012-06-10 00:00:00',3532,2,'aa,bb,cc,dd','Page Title','Metaaaa Title','Metaaaa Keywords','Metaaaa Description','Metaaaaa Data',2,28,1,'Fvml2rtw4','Mutashabih',1,'Yes','Yes','Yes','2012-05-01 14:34:11'),(20,'Article Title1','2012-05-24 00:00:00',3532,1,'aa,cc,ee','123','321','456','654','777',1,29,1,'GUID','Mohammad',6,'Yes','Yes','No','2012-05-01 20:07:31'),(21,'title 22','2012-05-31 00:00:00',3532,2,'','','','mmmmmm','','',2,30,1,'','Anas',0,'No','Yes','No','2012-05-01 20:16:40'),(22,'URL Title 11','2012-05-03 00:00:00',3532,1,'aa,mmmmm11','aa111','aa222','aa333','aa444','aa555',1,32,1,'GUID11','Mohammad11',1,'Yes','No','No','2012-05-01 22:46:58'),(23,'Static Title 1','2012-05-01 00:00:00',3532,1,'fofo,momo','11','22','33','44','55',1,28,1,'GUID','Mohammad',0,'Yes','Yes','Yes','2012-05-01 23:44:14'),(24,'Static Title','2012-05-06 00:00:00',3532,2,'fofo,momo11','aa11','aa22','aa33','aa44','aa55',2,29,1,'GUID11','Mohammad11',21,'No','No','No','2012-05-01 23:46:40'),(25,'Title Directory','2012-05-01 00:00:00',3532,1,'aaaaaaaaaaaaa','11','22','33','44','55',1,28,1,'guid','Mohammad',0,'Yes','Yes','Yes','2012-05-02 01:00:25'),(26,'1Title Directory','2012-05-02 00:00:00',3532,2,'1aaaaaaaaaaaaa','a11','2a2','a33','a44','a55',2,29,1,'1guid','1Mohammad',21,'No','No','No','2012-05-02 01:02:21'),(27,'Title Directory','2000-11-30 00:00:00',3532,1,'','','','','','',2,28,1,'','',0,'Yes','Yes','Yes','2012-05-02 01:43:54'),(28,'1File Title','2012-05-31 00:00:00',3532,2,'1hhhhhhhhhhhh','a1','a2','a3','a4','a5',1,29,1,'1guid','1mmmmm',25,'No','No','No','2012-05-02 02:29:28'),(29,'tttttt','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','Yes','2012-05-02 02:46:14'),(30,'test','0000-00-00 00:00:00',3532,0,'','','','','','',0,31,1,'','',0,'No','No','No','2012-05-05 00:08:57'),(31,'sssss','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-06 03:00:36'),(32,'aaaaaaaaa','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-06 03:03:09'),(61,'title','2000-11-30 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-05-27 16:39:58'),(62,'c1c1c1c1c1c1','2000-11-30 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-05-27 16:40:50'),(63,'mohammad','2000-11-30 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-05-27 16:43:12'),(64,'Test Object File','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-05-29 05:44:24'),(90,'Test Object File','0000-00-00 00:00:00',3532,0,'','','','','','',0,28,1,'','',0,'No','Yes','No','2012-05-29 06:45:21'),(91,'test','0000-00-00 00:00:00',3532,0,'','','','','','',0,29,1,'','',0,'No','No','Yes','2012-05-29 06:47:57'),(92,'test2','0000-00-00 00:00:00',3532,0,'','','','','','',0,30,1,'','',0,'No','No','Yes','2012-05-29 06:50:04'),(93,'test3','0000-00-00 00:00:00',3532,0,'','','','','','',0,31,1,'','',0,'No','Yes','No','2012-05-29 06:55:15'),(94,'flv title','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-05-30 12:38:31'),(95,'flv title','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-05-30 12:39:04'),(96,'flv title3','2000-11-30 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','No','No','2012-05-30 12:41:33'),(97,'anas test','0000-00-00 00:00:00',3532,0,'','','','','','',0,0,1,'','',0,'No','Yes','Yes','2012-06-02 15:18:33'),(106,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 10:18:41'),(107,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 10:19:11'),(108,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 10:24:37'),(109,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 10:25:06'),(110,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 10:28:49'),(111,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 13:47:04'),(112,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:26:12'),(113,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:26:59'),(114,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:27:25'),(115,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:28:30'),(116,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:28:49'),(117,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:28:59'),(118,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:29:21'),(119,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:32:43'),(120,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:39:19'),(121,'Object Title','2012-06-04 00:00:00',3532,1,'aa,bb,cc','Object Title','Object Meta Title','Object Meta Keywords','Object Description','Object Meta Data',1,28,1,'','Mohammad Object',5,'Yes','Yes','Yes','2012-06-03 14:40:20'),(122,'Media1','2012-06-01 00:00:00',3532,1,'aa,cc,','1111','22222','33333','44444','55555',1,28,1,'','',1,'Yes','Yes','Yes','2012-06-03 14:47:10'),(123,'Media1','2012-06-01 00:00:00',3532,1,'aa,cc,','1111','22222','33333','44444','55555',1,28,1,'','',1,'Yes','Yes','Yes','2012-06-03 14:48:28'),(124,'Final Media','2012-06-15 00:00:00',3532,1,'qq,ee,yy,oo','Ø¹Ù†ÙˆØ§Ù† Ø§Ù„ØµÙØ­Ø© 1','Meta Title 1','Meta Keywords 1','Meta Description 1','Meta Data 1',1,28,1,'','',2,'Yes','Yes','Yes','2012-06-03 14:56:22'),(125,'About us','2000-11-30 00:00:00',3532,0,'','About us','Car2Dar - About us','Car2Dar About us Keywords','Car2Dar About us Description','Car2Dar About us Meta Data',0,0,0,'GUIDHere','',0,'Yes','Yes','Yes','2012-06-13 22:45:56');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_article`
--

LOCK TABLES `object_article` WRITE;
/*!40000 ALTER TABLE `object_article` DISABLE KEYS */;
INSERT INTO `object_article` VALUES (1,'Article Alias 1','Article Intro_text 1','la la la Mohammad Riad Adli  Comic this font','0000-00-00 00:00:00',3532,0,20,0,'No','No','Yes',5,0,'0000-00-00 00:00:00',3532,'2012-05-28 16:42:58','2012-05-10 00:00:00','2012-05-20 00:00:00','2012-05-01 20:07:31',NULL,NULL),(2,'alias 22','nobtha 22','Ø³Ø¬Ù„ Ø§Ù†Ø§ Ø¹Ø±Ø¨ÙŠ','2012-05-31 00:00:00',3532,0,21,0,'No','No','No',2,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-22 00:00:00','2012-05-01 20:16:41',NULL,NULL),(3,'another test','','vvvvvvvvvvvvvvvvvvvvvvvvv','0000-00-00 00:00:00',3532,0,30,0,'Yes','No','Yes',2,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-05 00:08:57',NULL,NULL),(12,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,106,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:18:41',NULL,NULL),(13,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,107,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:19:11',NULL,NULL),(14,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,108,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:24:37',NULL,NULL),(15,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,109,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:25:06',NULL,NULL),(16,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,110,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:28:49',NULL,NULL),(17,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,111,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 13:47:04',NULL,NULL),(18,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,112,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:26:13',NULL,NULL),(19,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,113,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:26:59',NULL,NULL),(20,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,114,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:27:25',NULL,NULL),(21,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,115,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:30',NULL,NULL),(22,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,116,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:49',NULL,NULL),(23,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,117,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:59',NULL,NULL),(24,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,118,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:29:21',NULL,NULL),(25,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,119,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:32:43',NULL,NULL),(26,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,120,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:39:19',NULL,NULL),(27,'Article title','Article intro','Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article Article','0000-00-00 00:00:00',3532,0,121,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:40:20',NULL,NULL),(28,'Article title','','Article Article&nbsp;\r\nArticle Article&nbsp;\r\nArticle Article','0000-00-00 00:00:00',3532,0,122,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:47:10',NULL,NULL),(29,'Article title','','Article Article&nbsp;\r\nArticle Article&nbsp;\r\nArticle Article','0000-00-00 00:00:00',3532,0,123,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:48:28',NULL,NULL),(30,'Object Article Alias','','Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article Alias Object Article AliasObject Article AliasObject Article Alias Object Article AliasObject Article Alias','0000-00-00 00:00:00',3532,0,124,0,'Yes','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:56:23',NULL,NULL);
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
INSERT INTO `object_directory` VALUES (1,'1Name','1Label','1Description',0,'3532',1500,6,'/var',26,0,'No','No','Yes',0,'0000-00-00 00:00:00',3532,'2012-05-02 04:42:08','2012-05-02 01:02:21',NULL,NULL),(2,'Name','Label','desc',1,'3532',5,5,'var/www/html/',27,0,'Yes','Yes','No',0,'0000-00-00 00:00:00',3532,'2012-05-30 17:32:59','2012-05-02 01:43:55',NULL,NULL);
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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_file`
--

LOCK TABLES `object_file` WRITE;
/*!40000 ALTER TABLE `object_file` DISABLE KEYS */;
INSERT INTO `object_file` VALUES (1,'TestObjectFile','TOF','fffffffffffffffffffffffffffffffffffffffffffffffff',0,'Mohammad','text/plain',4945,'.txt','872t3gih/au9rm3l5/Sp6e2Kn8/a5c56f65f9a34cd8cdc91f781df01809.txt',90,0,'No','No','Yes',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-29 06:45:21',NULL,NULL),(2,'test','test','',2,'Mousa','application/vnd.openxmlformats-officedocument.wordprocessingml.document',25198,'.docx','872t3gih/au9rm3l5/Sp6e2Kn8/75bf8cd0fceabfacffe38a19711e5d44.docx',91,0,'Yes','Yes','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-29 06:47:57',NULL,NULL),(3,'test2','test2','test2',1,'Mouses','application/zip',4047,'.zip','872t3gih/au9rm3l5/Sp6e2Kn8/cf1c46bce374dde03a850ef1025fd70a.zip',92,0,'Yes','Yes','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-29 06:50:04',NULL,NULL),(4,'test3','test3','test3',0,'Mohammad','application/pdf',110838,'.pdf','872t3gih/au9rm3l5/Sp6e2Kn8/9e250d966ea45cd1f177a62e3fc885f7.pdf',93,0,'No','No','Yes',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-05-29 06:55:16',NULL,NULL),(5,'','','',0,'','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/04cad1512375a8c1822ecc30b0b467b2.zip',0,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 10:24:38',NULL,NULL),(6,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/783a76c76ce5f8fa754a5538c79eaa7b.zip',109,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 10:25:06',NULL,NULL),(7,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/89962da8ce6e80ee783827b422a0dab2.zip',110,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 10:28:49',NULL,NULL),(8,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/60095355767a7229401295a29f3b9eb1.zip',111,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 13:47:04',NULL,NULL),(9,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/644b718f9ea2842ed9be34879d6f162b.zip',112,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:26:13',NULL,NULL),(10,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/2ad75808026fefde03cf0ae516852eda.zip',113,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:26:59',NULL,NULL),(11,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/9d0271224d381df3e642f1abfa78515b.zip',114,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:27:25',NULL,NULL),(12,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/bd36dc1ce6c1dad53cc6c743926a29d1.zip',115,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:28:31',NULL,NULL),(13,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/21531d66a613c59aef2008286ffc975b.zip',116,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:28:49',NULL,NULL),(14,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/b106ee357a0fcfa96dba9fd16841ea8d.zip',117,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:28:59',NULL,NULL),(15,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/a7e6865ffba6b7f7967429be02c4b53a.zip',118,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:29:21',NULL,NULL),(16,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/b0ce2859613cb1589a99a51f706766ce.zip',119,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:32:43',NULL,NULL),(17,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/4d0f6af60e304ed9aa9260426c3cdbf7.zip',120,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:39:19',NULL,NULL),(18,'File Title','File Label','File Desc',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/564f201613adda4980ff361e92523d8c.zip',121,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:40:20',NULL,NULL),(19,'File name','File Alias','',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/7bcf9fd08a6f61bf42df6be5287dfed7.zip',122,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:47:10',NULL,NULL),(20,'File name','File Alias','',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/2ab4d8cd7ac6bb2aa574d0ed3c6e5926.zip',123,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:48:28',NULL,NULL),(21,'Object File Name','Object File Alias','',2,'Mohammad','application/zip',88546,'.zip','872t3gih/79g0f2bh/Sp6e2Kn8/bc3902af2d90db3ceec4e43bf78ee9bf.zip',124,0,'Yes','No','No',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 14:56:23',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_info`
--

LOCK TABLES `object_info` WRITE;
/*!40000 ALTER TABLE `object_info` DISABLE KEYS */;
INSERT INTO `object_info` VALUES (2,0,0,1,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 02:55:13','comments','\"options\"'),(3,0,0,1,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:39:27','comments','\"options\"'),(4,5,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:42:05','comments','\"options\"'),(6,7,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 03:43:51','mmmmmmmmm','\"ooooooo\"'),(7,8,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 05:21:33','cccccc','\"ooooo\"'),(8,9,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-04-30 05:23:45','ccccc','\"oooo\"'),(9,12,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:50:42','','\"\"'),(10,13,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:51:52','','\"\"'),(11,14,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:53:00','','\"\"'),(12,15,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 12:53:50','7777','\"8888\"'),(13,16,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 13:00:02','comments','\"options\"'),(14,20,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 20:07:31','comments','\"options\"'),(15,21,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 20:16:41','','\"\"'),(16,22,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 22:46:58','comments11','\"options11\"'),(17,23,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 23:44:14','comm','\"optionnnnn\"'),(18,24,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-01 23:46:40','comm11','\"optionnnnn11\"'),(19,25,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 01:00:25','comments','\"options\"'),(20,26,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 01:02:21','1comments','\"1options\"'),(21,27,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 01:43:55','','\"\"'),(22,28,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 02:29:28','1cccccc','\"1ooooo\"'),(23,29,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-02 02:46:14','','\"\"'),(24,30,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-05 00:08:57','','\"\"'),(25,31,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:00:36','','\"\"'),(26,32,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:03:09','','\"\"'),(55,61,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-27 16:39:58','','\"\"'),(56,62,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-27 16:40:50','','\"\"'),(57,63,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-27 16:43:12','','\"\"'),(58,64,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-29 05:44:24','','\"\"'),(84,90,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-29 06:45:21','','\"\"'),(85,91,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-29 06:47:57','','\"\"'),(86,92,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-29 06:50:04','','\"\"'),(87,93,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-29 06:55:15','','\"\"'),(88,94,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-30 12:38:31','','\"\"'),(89,95,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-30 12:39:05','','\"\"'),(90,96,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-30 12:41:33','','\"\"'),(91,97,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-02 15:18:33','','\"\"'),(100,106,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:18:41','Object Comments','\"Object Options\"'),(101,107,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:19:11','Object Comments','\"Object Options\"'),(102,108,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:24:37','Object Comments','\"Object Options\"'),(103,109,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:25:06','Object Comments','\"Object Options\"'),(104,110,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 10:28:49','Object Comments','\"Object Options\"'),(105,111,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 13:47:04','Object Comments','\"Object Options\"'),(106,112,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:26:13','Object Comments','\"Object Options\"'),(107,113,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:26:59','Object Comments','\"Object Options\"'),(108,114,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:27:25','Object Comments','\"Object Options\"'),(109,115,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:30','Object Comments','\"Object Options\"'),(110,116,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:49','Object Comments','\"Object Options\"'),(111,117,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:59','Object Comments','\"Object Options\"'),(112,118,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:29:21','Object Comments','\"Object Options\"'),(113,119,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:32:43','Object Comments','\"Object Options\"'),(114,120,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:39:19','Object Comments','\"Object Options\"'),(115,121,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:40:20','Object Comments','\"Object Options\"'),(116,122,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:47:10','object comments','\"object options\"'),(117,123,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:48:28','object comments','\"object options\"'),(118,124,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:56:22','Object Comments','\"Object Options\"'),(119,125,0,0,0,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-13 22:45:56','','\"\"');
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
) ENGINE=MyISAM AUTO_INCREMENT=67358 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_photo`
--

LOCK TABLES `object_photo` WRITE;
/*!40000 ALTER TABLE `object_photo` DISABLE KEYS */;
INSERT INTO `object_photo` VALUES (67357,'Object Photo 3','',3532,0,124,0,16986,267,720,'.jpg','2012-06-15 00:00:00','UAE','','Yes','No','No',44,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-22 00:00:00','2012-06-29 00:00:00','2012-06-03 14:56:23',NULL,NULL),(67356,'Object Photo 2','',3532,0,124,0,6034,180,180,'.jpg','2012-06-08 00:00:00','Syria','','Yes','No','No',56,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-15 00:00:00','2012-06-22 00:00:00','2012-06-03 14:56:23',NULL,NULL),(67355,'Object Photo 1','',3532,0,124,0,8875,210,320,'.jpg','2012-06-01 00:00:00','Jordan','','Yes','No','No',5,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-08 00:00:00','2012-06-03 14:56:23',NULL,NULL),(67353,'w1w1w1w1w1w1w1','bbbbbbbbbbbbbbb',3532,0,62,0,8875,210,320,'.jpg','2012-05-18 00:00:00','aaaaaaaaaa','','Yes','No','No',1,0,'0000-00-00 00:00:00',3532,'2012-05-30 13:33:11','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-05-27 16:40:50',NULL,NULL),(67354,'riad','mousa',3532,0,63,0,6034,180,180,'.jpg','2012-05-18 00:00:00','Amman','','Yes','Yes','No',0,0,'0000-00-00 00:00:00',3532,'2012-05-30 13:30:17','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-05-27 16:43:12',NULL,NULL);
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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_source`
--

LOCK TABLES `object_source` WRITE;
/*!40000 ALTER TABLE `object_source` DISABLE KEYS */;
INSERT INTO `object_source` VALUES (1,'name1','description1','news','http://www.yahoo.com',3532,1,0,22,'No','Yes',3,'2012-04-29 14:43:25'),(2,'name3','description22','sports2','http://www.aulaula.local/admin/handle/pkg/object-source11',3532,1,0,110,'No','No',38,'2012-04-29 14:48:29'),(3,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',30,'2012-06-03 09:55:05'),(4,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',29,'2012-06-03 09:55:34'),(5,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',28,'2012-06-03 09:58:22'),(6,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',27,'2012-06-03 10:00:29'),(7,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',26,'2012-06-03 10:00:44'),(8,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',25,'2012-06-03 10:01:20'),(9,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',24,'2012-06-03 10:01:54'),(10,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',23,'2012-06-03 10:01:57'),(11,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',22,'2012-06-03 10:18:41'),(12,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',21,'2012-06-03 10:19:11'),(13,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',20,'2012-06-03 10:24:38'),(14,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',19,'2012-06-03 10:25:06'),(15,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',18,'2012-06-03 10:28:49'),(16,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',17,'2012-06-03 13:47:04'),(17,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',16,'2012-06-03 14:26:13'),(18,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',15,'2012-06-03 14:26:59'),(19,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',14,'2012-06-03 14:27:25'),(20,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',13,'2012-06-03 14:28:31'),(21,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',12,'2012-06-03 14:28:49'),(22,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',11,'2012-06-03 14:28:59'),(23,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',10,'2012-06-03 14:29:21'),(24,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',9,'2012-06-03 14:32:43'),(25,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',8,'2012-06-03 14:39:19'),(26,'Source Title','Source Desc','Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,5,'Yes','Yes',7,'2012-06-03 14:40:20'),(27,'Source Title','Source Desc','source type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,12,'Yes','Yes',5,'2012-06-03 14:47:10'),(28,'Source Title','Source Desc','source type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,12,'Yes','Yes',4,'2012-06-03 14:48:28'),(29,'Object Source Title','Object Source Alias','Object Source Type','http://www.aulaula.local/admin/handle/pkg/object/action/add',3532,1,0,11,'Yes','Yes',33,'2012-06-03 14:56:23');
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_source_info`
--

LOCK TABLES `object_source_info` WRITE;
/*!40000 ALTER TABLE `object_source_info` DISABLE KEYS */;
INSERT INTO `object_source_info` VALUES (1,1,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-04-20 00:00:00','2012-04-30 00:00:00','2012-04-29 14:43:25','comments1','\"options1\"'),(2,2,0,'0000-00-00 00:00:00',3532,'2012-05-30 12:25:13','2012-04-18 00:00:00','2012-04-19 00:00:00','2012-04-29 14:48:29','aaaaaa','\"bbbbbb\"'),(3,5,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 09:58:22','Source Comments','\"Source Options\"'),(4,6,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:00:29','Source Comments','\"Source Options\"'),(5,7,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:00:44','Source Comments','\"Source Options\"'),(6,8,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:01:20','Source Comments','\"Source Options\"'),(7,9,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:01:54','Source Comments','\"Source Options\"'),(8,10,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:01:57','Source Comments','\"Source Options\"'),(9,11,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:18:41','Source Comments','\"Source Options\"'),(10,12,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:19:11','Source Comments','\"Source Options\"'),(11,13,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:24:38','Source Comments','\"Source Options\"'),(12,14,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:25:06','Source Comments','\"Source Options\"'),(13,15,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 10:28:49','Source Comments','\"Source Options\"'),(14,16,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 13:47:04','Source Comments','\"Source Options\"'),(15,17,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:26:13','Source Comments','\"Source Options\"'),(16,18,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:26:59','Source Comments','\"Source Options\"'),(17,19,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:27:25','Source Comments','\"Source Options\"'),(18,20,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:28:31','Source Comments','\"Source Options\"'),(19,21,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:28:49','Source Comments','\"Source Options\"'),(20,22,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:28:59','Source Comments','\"Source Options\"'),(21,23,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:29:21','Source Comments','\"Source Options\"'),(22,24,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:32:43','Source Comments','\"Source Options\"'),(23,25,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:39:19','Source Comments','\"Source Options\"'),(24,26,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-01 00:00:00','2012-06-30 00:00:00','2012-06-03 14:40:20','Source Comments','\"Source Options\"'),(25,27,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-07 00:00:00','2012-06-14 00:00:00','2012-06-03 14:47:10','source comments','\"source options\"'),(26,28,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-07 00:00:00','2012-06-14 00:00:00','2012-06-03 14:48:28','source comments','\"source options\"'),(27,29,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-03 00:00:00','2012-06-10 00:00:00','2012-06-03 14:56:23','Source comments','\"Source Options\"');
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_static`
--

LOCK TABLES `object_static` WRITE;
/*!40000 ALTER TABLE `object_static` DISABLE KEYS */;
INSERT INTO `object_static` VALUES (2,'About us here','aboutus','About us','About Us &nbsp; I want to thank you all for this effort and quality of work guys here, I dont know how bla bla bla eventhough bla bla bla bla bla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla bla bla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla bla bla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla bla.bla bla bla bla &nbsp; bla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla bla bla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla bla','0000-00-00 00:00:00',3532,125,0,'No','No',0,'0000-00-00 00:00:00',3532,'2012-06-16 03:44:11','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-06-13 22:45:56',NULL,NULL);
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
INSERT INTO `object_url` VALUES (1,'URL Alternative 11','bla bla blaaaa11','http://www.aulaula.local/admin/handle/pkg/object-url','color:red;text-decoration:none',3532,0,22,0,'Yes','Yes','Yes','Iframe',2,0,'0000-00-00 00:00:00',3532,'2012-05-02 01:59:41','2012-05-10 00:00:00','2012-05-17 00:00:00','2012-05-01 22:46:58',NULL,NULL);
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_video`
--

LOCK TABLES `object_video` WRITE;
/*!40000 ALTER TABLE `object_video` DISABLE KEYS */;
INSERT INTO `object_video` VALUES (1,'test222','1111',3532,0,16,0,669036,230,480,'video','2012-05-31 00:00:00','Amman444','','Yes','Yes','Yes','No',15,0,'0000-00-00 00:00:00',3532,'2012-05-01 18:58:46','2013-05-01 00:00:00','2013-05-31 00:00:00','2012-05-01 12:53:50',NULL,NULL),(2,'Test Object Video2222','bla bla bla3333',3532,0,15,0,129444,230,480,'video','2012-05-16 00:00:00','KSA','','Yes','No','No','No',21,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2013-05-21 00:00:00','2013-05-20 00:00:00','2012-05-01 13:00:02',NULL,NULL),(3,'dddddddd','',3532,0,31,0,0,0,0,'NULL','0000-00-00 00:00:00','','','No','No','No','No',20,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:00:36',NULL,NULL),(4,'aaaaaaaaaaaaa','',3532,0,32,0,0,0,0,'NULL','0000-00-00 00:00:00','','','No','No','No','No',11,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-06 03:03:09',NULL,NULL),(5,'flv alternative','flv intro',3532,0,94,0,669036,230,480,'.flv','2012-05-30 00:00:00','Amman','','No','No','No','No',3,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-30 12:38:31',NULL,NULL),(6,'flv alternative','flv intro',3532,0,95,0,669036,230,480,'.flv','2012-05-30 00:00:00','Amman','','No','No','No','No',2,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-05-30 12:39:05',NULL,NULL),(7,'flv alternative3','flv intro3',3532,0,96,0,669036,230,480,'.flv','2012-05-30 00:00:00','Amman','','Yes','Yes','Yes','No',1,0,'0000-00-00 00:00:00',3532,'2012-05-30 17:07:02','2000-11-30 00:00:00','2000-11-30 00:00:00','2012-05-30 12:41:33',NULL,NULL),(8,'anas test alter','anas desc',3532,0,97,0,669036,230,480,'.flv','2012-06-28 00:00:00','','','No','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-02 15:18:33',NULL,NULL),(9,'Video Title','Video intro',0,0,111,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 13:47:04',NULL,NULL),(10,'Video Title','Video intro',0,0,112,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:26:13',NULL,NULL),(11,'Video Title','Video intro',0,0,113,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:26:59',NULL,NULL),(12,'Video Title','Video intro',0,0,114,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:27:25',NULL,NULL),(13,'Video Title','Video intro',0,0,115,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:31',NULL,NULL),(14,'Video Title','Video intro',0,0,116,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:49',NULL,NULL),(15,'Video Title','Video intro',0,0,117,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:28:59',NULL,NULL),(16,'Video Title','Video intro',0,0,118,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:29:21',NULL,NULL),(17,'Video Title','Video intro',0,0,119,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:32:43',NULL,NULL),(18,'Video Title','Video intro',0,0,120,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:39:19',NULL,NULL),(19,'Video Title','Video intro',0,0,121,0,88722,230,480,'.flv','2012-06-29 00:00:00','Syria','','Yes','No','No','No',0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','2012-06-03 14:40:20',NULL,NULL),(20,'Video','',0,0,122,0,129444,230,480,'.flv','2012-06-14 00:00:00','UAE','','Yes','No','No','No',6,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-25 00:00:00','2012-06-30 00:00:00','2012-06-03 14:47:10',NULL,NULL),(21,'Video','',0,0,123,0,129444,230,480,'.flv','2012-06-14 00:00:00','UAE','','Yes','No','No','No',6,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-25 00:00:00','2012-06-30 00:00:00','2012-06-03 14:48:28',NULL,NULL),(22,'Object Video','',0,0,124,0,129444,230,480,'.flv','2012-06-22 00:00:00','KSA','','Yes','No','No','No',22,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2012-06-22 00:00:00','2012-06-29 00:00:00','2012-06-03 14:56:23',NULL,NULL);
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`),
  KEY `vehicle_type_id` (`vehicle_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_make`
--

LOCK TABLES `vehicle_make` WRITE;
/*!40000 ALTER TABLE `vehicle_make` DISABLE KEYS */;
INSERT INTO `vehicle_make` VALUES (1,1,'en make title','en make description',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 18:11:17','en comments','\"en options\"'),(2,4,'ar make title','ar make description',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 18:11:17','ar comments','\"ar options\"');
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
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`),
  KEY `vehicle_make_id` (`vehicle_make_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_model`
--

LOCK TABLES `vehicle_model` WRITE;
/*!40000 ALTER TABLE `vehicle_model` DISABLE KEYS */;
INSERT INTO `vehicle_model` VALUES (7,7,'en title','en desc',1,'89962da8ce6e80ee783827b422a0dab2','2012-05-23 06:06:19','','\"\"'),(8,10,'ar title','ar desc',2,'89962da8ce6e80ee783827b422a0dab2','2012-05-23 06:06:19','','\"\"'),(9,1,'en model title','en model description',1,'644b718f9ea2842ed9be34879d6f162b','2012-05-26 18:17:11','eee','\"vvvv\"'),(10,2,'ar model title','ar model description',2,'644b718f9ea2842ed9be34879d6f162b','2012-05-26 18:17:11','111111','\"222222\"');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_type`
--

LOCK TABLES `vehicle_type` WRITE;
/*!40000 ALTER TABLE `vehicle_type` DISABLE KEYS */;
INSERT INTO `vehicle_type` VALUES (1,'en type title','ar type title',1,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 18:06:14','','\"\"'),(2,'ar type title','ar type title',2,'a5c56f65f9a34cd8cdc91f781df01809','2012-05-26 18:06:15','','\"\"'),(3,'en type title','ar type title',1,'cf1c46bce374dde03a850ef1025fd70a','2012-05-26 18:07:27','','\"\"'),(4,'ar type title','ar type title',2,'cf1c46bce374dde03a850ef1025fd70a','2012-05-26 18:07:27','','\"\"');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_key_locale_id` (`hash_key`,`locale_id`)
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

-- Dump completed on 2012-06-20 13:52:54
