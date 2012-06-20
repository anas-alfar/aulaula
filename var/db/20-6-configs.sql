CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `group_key` varchar(1024) NOT NULL,
  `option_title` varchar(1024) NOT NULL,
  `option_hint` varchar(255) DEFAULT NULL,
  `option_description` varchar(1024) DEFAULT NULL,
  `option_value` varchar(1024) NOT NULL,
  `locale_id` int(10) unsigned NOT NULL,
  `permission_level_id` int(10) unsigned NOT NULL,
  `option_status` tinyint(3) unsigned NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`,`locale_id`,`permission_level_id`,`option_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1