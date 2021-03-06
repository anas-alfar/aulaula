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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-26 14:10:05
