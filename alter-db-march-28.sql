ALTER TABLE `banner` DROP KEY `area_id`;
ALTER TABLE `banner` CHANGE `area_id` `banner_area_id` int(11) unsigned NOT NULL;
ALTER TABLE `banner` ADD INDEX (`banner_area_id`);

ALTER TABLE `category` DROP KEY `type_id`;
ALTER TABLE `category` CHANGE `type_id` `category_type_id` int(11) unsigned NOT NULL;
ALTER TABLE `category` ADD INDEX (`category_type_id`);

ALTER TABLE `menu` DROP KEY `type_id`;
ALTER TABLE `menu` DROP KEY `menu_id_2`;
ALTER TABLE `menu` DROP KEY `type_id_2`;
ALTER TABLE `menu` DROP KEY `parent_id_2`;
ALTER TABLE `menu` DROP KEY `package_id_2`;
ALTER TABLE `menu` DROP KEY `published_2`;
ALTER TABLE `menu` CHANGE `type_id` `menu_type_id` int(11) unsigned NOT NULL;
ALTER TABLE `menu` ADD INDEX (`menu_type_id`);

ALTER TABLE `menu_info` DROP KEY `menu_id_2`;

ALTER TABLE `object` DROP KEY `source_id`;
ALTER TABLE `object` CHANGE `source_id` `object_source_id` int(11) unsigned NOT NULL;
ALTER TABLE `object` ADD INDEX (`object_source_id`);

ALTER TABLE `object` DROP KEY `type_id`;
ALTER TABLE `object` CHANGE `type_id` `object_type_id` int(11) unsigned NOT NULL;
ALTER TABLE `object` ADD INDEX (`object_type_id`);

ALTER TABLE `object_abuse` DROP KEY `type_id`;
ALTER TABLE `object_abuse` CHANGE `type_id` `object_abuse_type_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_abuse` ADD INDEX (`object_abuse_type_id`);

ALTER TABLE `object_article` DROP KEY `source_id`;
ALTER TABLE `object_article` CHANGE `source_id` `object_source_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_article` ADD INDEX (`object_source_id`);

ALTER TABLE `object_file` DROP KEY `folder_id`;
ALTER TABLE `object_file` CHANGE `folder_id` `object_directory_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_file` ADD INDEX (`object_directory_id`);

ALTER TABLE `object_info` DROP KEY `layout_id`;
ALTER TABLE `object_info` CHANGE `layout_id` `theme_layout_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_info` ADD INDEX (`theme_layout_id`);

ALTER TABLE `object_info` DROP KEY `template_id`;
ALTER TABLE `object_info` CHANGE `template_id` `theme_template_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_info` ADD INDEX (`theme_template_id`);

ALTER TABLE `object_info` DROP KEY `skin_id`;
ALTER TABLE `object_info` CHANGE `skin_id` `theme_skin_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_info` ADD INDEX (`theme_skin_id`);

ALTER TABLE `object_source_info` DROP KEY `source_id`;
ALTER TABLE `object_source_info` CHANGE `source_id` `object_source_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_source_info` ADD INDEX (`object_source_id`);

ALTER TABLE `object_photo` DROP KEY `source_id`;
ALTER TABLE `object_photo` CHANGE `source_id` `object_source_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_photo` ADD INDEX (`object_source_id`);

ALTER TABLE `object_type_info` DROP KEY `type_id`;
ALTER TABLE `object_type_info` CHANGE `type_id` `object_type_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_type_info` ADD INDEX (`object_type_id`);

ALTER TABLE `object_url` DROP KEY `source_id`;
ALTER TABLE `object_url` CHANGE `source_id` `object_source_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_url` ADD INDEX (`object_source_id`);

ALTER TABLE `object_video` DROP KEY `source_id`;
ALTER TABLE `object_video` CHANGE `source_id` `object_source_id` int(11) unsigned NOT NULL;
ALTER TABLE `object_video` ADD INDEX (`object_source_id`);

ALTER TABLE `package` DROP KEY `prerequisite_id`;
ALTER TABLE `package` CHANGE `prerequisite_id` `reference_id` int(11) unsigned NOT NULL;
ALTER TABLE `package` ADD INDEX (`reference_id`);

ALTER TABLE `package_action` DROP KEY `class_id`;
ALTER TABLE `package_action` CHANGE `class_id` `package_class_id` int(11) unsigned NOT NULL;
ALTER TABLE `package_action` ADD INDEX (`package_class_id`);

ALTER TABLE `poll_vote` DROP KEY `answer_id`;
ALTER TABLE `poll_vote` CHANGE `answer_id` `poll_answer_id` int(11) unsigned NOT NULL;
ALTER TABLE `poll_vote` ADD INDEX (`poll_answer_id`);

ALTER TABLE `theme` DROP KEY `layout_id`;
ALTER TABLE `theme` CHANGE `layout_id` `theme_layout_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme` ADD INDEX (`theme_layout_id`);

ALTER TABLE `theme` DROP KEY `template_id`;
ALTER TABLE `theme` CHANGE `template_id` `theme_template_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme` ADD INDEX (`theme_template_id`);

ALTER TABLE `theme` DROP KEY `skin_id`;
ALTER TABLE `theme` CHANGE `skin_id` `theme_skin_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme` ADD INDEX (`theme_skin_id`);

ALTER TABLE `theme` DROP KEY `class_id`;
ALTER TABLE `theme` CHANGE `class_id` `package_class_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme` ADD INDEX (`package_class_id`);

ALTER TABLE `theme` DROP KEY `action_id`;
ALTER TABLE `theme` CHANGE `action_id` `package_action_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme` ADD INDEX (`package_action_id`);

ALTER TABLE `theme_layout_info` DROP KEY `layout_id`;
ALTER TABLE `theme_layout_info` CHANGE `layout_id` `theme_layout_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme_layout_info` ADD INDEX (`theme_layout_id`);

ALTER TABLE `theme_skin` DROP KEY `layout_id`;
ALTER TABLE `theme_skin` CHANGE `layout_id` `theme_layout_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme_skin` ADD INDEX (`theme_layout_id`);

ALTER TABLE `theme_skin` DROP KEY `template_id`;
ALTER TABLE `theme_skin` CHANGE `template_id` `theme_template_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme_skin` ADD INDEX (`theme_template_id`);

ALTER TABLE `theme_skin_info` DROP KEY `skin_id`;
ALTER TABLE `theme_skin_info` CHANGE `skin_id` `theme_skin_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme_skin_info` ADD INDEX (`theme_skin_id`);

ALTER TABLE `theme_template_info` DROP KEY `template_id`;
ALTER TABLE `theme_template_info` CHANGE `template_id` `theme_template_id` int(11) unsigned NOT NULL;
ALTER TABLE `theme_template_info` ADD INDEX (`theme_template_id`);

ALTER TABLE `user_level_permission` DROP KEY `class_id`;
ALTER TABLE `user_level_permission` CHANGE `class_id` `package_class_id` int(11) unsigned NOT NULL;
ALTER TABLE `user_level_permission` ADD INDEX (`package_class_id`);

ALTER TABLE `user_level_permission` DROP KEY `action_id`;
ALTER TABLE `user_level_permission` CHANGE `action_id` `package_action_id` int(11) unsigned NOT NULL;
ALTER TABLE `user_level_permission` ADD INDEX (`package_action_id`);

